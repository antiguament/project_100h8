<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Obtener el contenido actual del carrito
     *
     * @return array
     */
    public function content()
    {
        return Session::get('cart', []);
    }

    /**
     * Obtener la cantidad total de ítems en el carrito
     * 
     * @return int
     */
    public function count()
    {
        return count($this->content());
    }

    /**
     * Obtener el total del carrito
     * 
     * @return float
     */
    public function total()
    {
        $total = 0;
        foreach ($this->content() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Agregar un producto al carrito
     * 
     * @param int $id
     * @param string $name
     * @param float $price
     * @param int $quantity
     * @param string $image
     * @param int $stock
     * @param string|null $preferences JSON con las preferencias del producto
     * @return void
     */
    public function add($id, $name, $price, $quantity, $image, $stock, $preferences = null)
    {
        $cart = $this->content();
        
        // Crear un ID único basado en el ID del producto y sus preferencias
        $uniqueId = $id;
        if ($preferences) {
            $uniqueId .= '_' . md5($preferences);
        }
        
        // Verificar si ya existe un producto idéntico (mismo ID y preferencias)
        $found = false;
        foreach ($cart as $key => $item) {
            if (str_starts_with($key, $id . '_') && isset($item['preferences']) && $item['preferences'] === $preferences) {
                $cart[$key]['quantity'] += $quantity;
                $found = true;
                break;
            } elseif ($key == $id && !isset($item['preferences']) && $preferences === null) {
                $cart[$key]['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $cart[$uniqueId] = [
                'id' => $id, // ID original del producto
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image_url' => $image,
                'stock' => $stock,
                'preferences' => $preferences ? json_decode($preferences, true) : null
            ];
        }
        
        Session::put('cart', $cart);
    }

    /**
     * Actualizar la cantidad de un producto en el carrito
     * 
     * @param int $id
     * @param int $quantity
     * @return void
     */
    public function update($id, $quantity)
    {
        $cart = $this->content();
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }
    }

    /**
     * Eliminar un producto del carrito
     * 
     * @param int $id
     * @return void
     */
    public function remove($id)
    {
        $cart = $this->content();
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    /**
     * Vaciar el carrito
     * 
     * @return void
     */
    public function clear()
    {
        Session::forget('cart');
    }
}
