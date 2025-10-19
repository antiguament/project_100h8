<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Facades\Cart;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::content();
        $total = Cart::total();
        
        // Depuración
        \Log::info('Contenido del carrito en index:', ['cart' => $cart, 'total' => $total]);
        
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Obtener la cantidad del request o usar 1 por defecto
            $quantity = $request->input('quantity', 1);
            
            // Validar que haya suficiente stock
            if ($product->stock < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay suficiente stock disponible',
                    'stock' => $product->stock
                ], 422);
            }
            
            // Obtener preferencias del request
            $preferences = [];
            
            // Obtener preferencias como arrays
            if ($product->preferencia_uno) {
                $prefsUno = $request->input('preferencia_uno', []);
                if (is_array($prefsUno) && !empty($prefsUno)) {
                    $preferences['preferencia_uno'] = $prefsUno;
                } elseif (is_string($prefsUno) && !empty($prefsUno)) {
                    $preferences['preferencia_uno'] = [$prefsUno];
                }
            }
            
            if ($product->preferencia_dos) {
                $prefsDos = $request->input('preferencia_dos', []);
                if (is_array($prefsDos) && !empty($prefsDos)) {
                    $preferences['preferencia_dos'] = $prefsDos;
                } elseif (is_string($prefsDos) && !empty($prefsDos)) {
                    $preferences['preferencia_dos'] = [$prefsDos];
                }
            }
            
            if ($product->preferencia_tres) {
                $prefsTres = $request->input('preferencia_tres', []);
                if (is_array($prefsTres) && !empty($prefsTres)) {
                    $preferences['preferencia_tres'] = $prefsTres;
                } elseif (is_string($prefsTres) && !empty($prefsTres)) {
                    $preferences['preferencia_tres'] = [$prefsTres];
                }
            }
            
            // Convertir preferencias a JSON para almacenamiento
            $preferencesJson = !empty($preferences) ? json_encode($preferences) : null;
            
            // Agregar al carrito con las preferencias
            Cart::add(
                $product->id,
                $product->name,
                $product->price,
                $quantity,
                $product->image_url,
                $product->stock,
                $preferencesJson
            );
            
            return response()->json([
                'success' => true, 
                'cart_count' => Cart::count(),
                'message' => 'Producto agregado al carrito'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error al agregar al carrito: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al agregar el producto al carrito',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            Cart::update($request->id, $request->quantity);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 400);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            Cart::remove($request->id);
            return response()->json([
                'success' => true, 
                'cart_count' => Cart::count()
            ]);
        }
        
        return response()->json(['success' => false], 400);
    }

    public function clear()
    {
        Cart::clear();
        return redirect()->back()->with('success', 'Carrito vaciado correctamente');
    }

    public function checkout()
    {
        $cart = Cart::content();
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }
        
        // Redirigir al carrito con el modal de WhatsApp abierto
        return redirect()->route('cart.index')->with('open_whatsapp_modal', true);
        $message .= "*Datos del Cliente*%0A";
        $message .= "Nombre: [Ingrese su nombre]%0A";
        $message .= "Teléfono: [Ingrese su teléfono]%0A";
        $message .= "Dirección: [Ingrese su dirección]";

        // Número de WhatsApp (reemplaza con tu número)
        $phone = '1234567890'; // Número de teléfono con código de país
        $url = "https://wa.me/{$phone}?text=" . $message;
        
        return redirect()->away($url);
    }
    
    /**
     * Obtener el conteo de productos en el carrito
     */
    public function count()
    {
        return response()->json([
            'count' => Cart::count(),
            'total' => Cart::total()
        ]);
    }
    
    /**
     * Obtener el contenido del mini carrito
     */
    public function mini()
    {
        $cart = Cart::content();
        $total = Cart::total();
        
        return view('cart.mini-cart-content', compact('cart', 'total'))->render();
    }
    
    /**
     * Enviar pedido por WhatsApp
     */
    public function sendToWhatsApp(Request $request)
    {
        $cart = Cart::content();
        $total = Cart::total();
        
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'El carrito está vacío'
            ]);
        }
        
        // Construir el mensaje de WhatsApp
        $message = "*NUEVO PEDIDO*\n\n";
        $message .= "*Cliente*: " . (auth()->check() ? auth()->user()->name : 'Cliente no registrado') . "\n";
        $message .= "*Fecha*: " . now()->format('d/m/Y H:i:s') . "\n\n";
        $message .= "*DETALLES DEL PEDIDO*\n";
        $message .= "══════════════════════\n\n";
        
        foreach ($cart as $id => $item) {
            $message .= "*" . $item['name'] . "*\n";
            $message .= "Cantidad: " . $item['quantity'] . " x $" . number_format($item['price'], 2) . " = *$" . number_format($item['price'] * $item['quantity'], 2) . "*\n";
            
            // Mostrar preferencias si existen
            if (!empty($item['preferences'])) {
                $message .= "*Preferencias:*\n";
                foreach ($item['preferences'] as $key => $value) {
                    if (!empty($value)) {
                        $prefName = ucwords(str_replace('_', ' ', $key));
                        if (is_array($value)) {
                            $message .= "- $prefName: " . implode(', ', $value) . "\n";
                        } else {
                            $message .= "- $prefName: $value\n";
                        }
                    }
                }
            }
            $message .= "\n";
        }
        
        $message .= "══════════════════════\n";
        $message .= "*TOTAL DEL PEDIDO: $" . number_format($total, 2) . "*\n\n";
        
        $message .= "*INFORMACIÓN DEL CLIENTE*\n";
        $message .= "══════════════════════\n";
        $message .= "📱 *Teléfono*: " . ($request->phone ?? 'No proporcionado') . "\n";
        $message .= "📝 *Notas*: " . ($request->notes ?? 'Ninguna') . "\n\n";
        
        $message .= "_Hora del pedido: " . now()->format('H:i:s') . "_";
        
        // Número de teléfono de destino (formato internacional sin signos)
        $phoneNumber = '573128658195'; // Número en formato internacional sin signos
        
        // Codificar el mensaje para URL
        $encodedMessage = rawurlencode($message);
        
        // Crear el enlace de WhatsApp
        $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";
        
        return response()->json([
            'success' => true,
            'redirect_url' => $whatsappUrl
        ]);
    }
}
