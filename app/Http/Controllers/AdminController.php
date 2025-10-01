<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Mostrar logs de pedidos
     */
    public function showOrderLogs(Request $request)
    {
        $filePath = storage_path('logs/pedidos.log');
        
        $orders = [];
        $totalOrders = 0;
        
        if (File::exists($filePath)) {
            $content = File::get($filePath);
            
            // Dividir el contenido en pedidos individuales
            $orderBlocks = explode('=== NUEVO PEDIDO ===', $content);
            
            foreach ($orderBlocks as $block) {
                if (trim($block) !== '') {
                    $parsedOrder = $this->parseOrderBlock($block);
                    if ($parsedOrder) {
                        $orders[] = $parsedOrder;
                        $totalOrders++;
                    }
                }
            }
            
            // Ordenar pedidos por fecha (más recientes primero)
            usort($orders, function($a, $b) {
                return strtotime($b['fecha_timestamp'] ?? '') - strtotime($a['fecha_timestamp'] ?? '');
            });
        }
        
        // Filtro de búsqueda
        $filter = $request->get('filter');
        if ($filter) {
            $orders = array_filter($orders, function($order) use ($filter) {
                return stripos($order['cliente'], $filter) !== false || 
                       stripos($order['telefono'], $filter) !== false ||
                       stripos($order['direccion'], $filter) !== false;
            });
        }
        
        // Filtro por días
        $daysFilter = $request->get('days_filter');
        $customRange = $request->get('custom_range');
        
        if ($daysFilter) {
            $days = $daysFilter === 'custom' ? $customRange : $daysFilter;
            
            if ($days && is_numeric($days) && $days > 0) {
                $cutoffDate = Carbon::now()->subDays($days);
                
                $orders = array_filter($orders, function($order) use ($cutoffDate) {
                    if (isset($order['fecha_timestamp'])) {
                        $orderDate = Carbon::createFromFormat('d/m/Y H:i:s', $order['fecha']);
                        return $orderDate >= $cutoffDate;
                    }
                    return true; // Si no hay fecha, mantener el pedido
                });
            }
        }
        
        // Reiniciar índices del array después de los filtros
        $orders = array_values($orders);
        
        return view('admin.order-logs', compact('orders', 'totalOrders', 'filter', 'daysFilter', 'customRange'));
    }
    
    /**
     * Parsear un bloque de pedido en un array legible
     */
    private function parseOrderBlock($block)
    {
        $lines = explode("\n", trim($block));
        $order = [
            'productos' => [],
            'cliente' => 'No especificado',
            'telefono' => 'No especificado',
            'direccion' => 'No especificada',
            'metodo_envio' => 'No seleccionado',
            'subtotal' => 0,
            'envio' => 0,
            'total' => 0,
            'fecha' => 'No disponible',
            'fecha_original' => 'No disponible',
            'fecha_timestamp' => null
        ];
        
        $currentProduct = null;
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            if (strpos($line, 'Fecha:') === 0) {
                $fechaTexto = str_replace('Fecha: ', '', $line);
                $order['fecha_original'] = $fechaTexto;
                $order['fecha'] = $this->formatDateForDisplay($fechaTexto);
                $order['fecha_timestamp'] = $this->parseDateToTimestamp($fechaTexto);
            } elseif (strpos($line, 'Cliente:') === 0) {
                $order['cliente'] = str_replace('Cliente: ', '', $line);
            } elseif (strpos($line, 'Teléfono:') === 0) {
                $order['telefono'] = str_replace('Teléfono: ', '', $line);
            } elseif (strpos($line, 'Dirección:') === 0) {
                $order['direccion'] = str_replace('Dirección: ', '', $line);
            } elseif (strpos($line, 'Método de envío:') === 0) {
                $order['metodo_envio'] = str_replace('Método de envío: ', '', $line);
            } elseif (strpos($line, 'Subtotal:') === 0) {
                $order['subtotal'] = floatval(str_replace('Subtotal: $', '', $line));
            } elseif (strpos($line, 'Envío:') === 0) {
                $order['envio'] = floatval(str_replace('Envío: $', '', $line));
            } elseif (strpos($line, 'Total:') === 0) {
                $order['total'] = floatval(str_replace('Total: $', '', $line));
            } elseif (strpos($line, '-') === 0 && strpos($line, '(Cantidad:') !== false) {
                // Línea de producto
                $currentProduct = [
                    'nombre' => trim(str_replace('-', '', $line)),
                    'detalles' => []
                ];
                $order['productos'][] = &$currentProduct;
            } elseif (isset($currentProduct) && strpos($line, '*') === 0) {
                // Detalles del producto (preferencias)
                $currentProduct['detalles'][] = str_replace('* ', '', $line);
            }
        }
        
        return $order;
    }

    /**
     * Formatear fecha para mostrar
     */
    private function formatDateForDisplay($dateString)
    {
        try {
            $date = Carbon::parse($dateString);
            return $date->format('d/m/Y H:i:s');
        } catch (\Exception $e) {
            return $dateString;
        }
    }

    /**
     * Convertir fecha a timestamp para filtrado
     */
    private function parseDateToTimestamp($dateString)
    {
        try {
            return Carbon::parse($dateString)->timestamp;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Generar ticket imprimible para impresora térmica
     */
    public function printOrderTicket($orderId)
    {
        $filePath = storage_path('logs/pedidos.log');
        
        if (!File::exists($filePath)) {
            return response('No se encontraron pedidos', 404);
        }
        
        $content = File::get($filePath);
        $orderBlocks = explode('=== NUEVO PEDIDO ===', $content);
        
        $selectedOrder = null;
        $index = 0;
        
        foreach ($orderBlocks as $block) {
            if (trim($block) !== '' && $index == $orderId) {
                $selectedOrder = $this->parseOrderBlock($block);
                break;
            }
            $index++;
        }
        
        if (!$selectedOrder) {
            return response('Pedido no encontrado', 404);
        }
        
        // Generar texto formateado para impresora térmica
        $ticket = $this->generateThermalTicket($selectedOrder);
        
        // Retornar como texto plano para impresión
        return response($ticket)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'inline; filename="ticket_' . $orderId . '.txt"');
    }

    /**
     * Generar texto formateado para impresora térmica
     */
    private function generateThermalTicket($order)
    {
        $lineWidth = 32; // Ancho estándar de ticket térmico
        
        $ticket = "\n" . str_repeat('=', $lineWidth) . "\n";
        $ticket .= str_pad('TICKET DE PEDIDO', $lineWidth, ' ', STR_PAD_BOTH) . "\n";
        $ticket .= str_repeat('=', $lineWidth) . "\n\n";
        
        $ticket .= "Fecha: " . $order['fecha'] . "\n";
        $ticket .= "Cliente: " . $order['cliente'] . "\n";
        $ticket .= "Tel: " . $order['telefono'] . "\n";
        $ticket .= "Dir: " . substr($order['direccion'], 0, 30) . "\n\n";
        
        $ticket .= "PRODUCTOS:\n";
        $ticket .= str_repeat('-', $lineWidth) . "\n";
        
        foreach ($order['productos'] as $producto) {
            $ticket .= str_pad(substr($producto['nombre'], 0, 20), 20) . "\n";
            if (!empty($producto['detalles'])) {
                foreach ($producto['detalles'] as $detalle) {
                    $ticket .= "  - " . substr($detalle, 0, 28) . "\n";
                }
            }
        }
        
        $ticket .= str_repeat('-', $lineWidth) . "\n";
        $ticket .= str_pad('Subtotal: $' . number_format($order['subtotal'], 2), $lineWidth, ' ', STR_PAD_LEFT) . "\n";
        $ticket .= str_pad('Envío: $' . number_format($order['envio'], 2), $lineWidth, ' ', STR_PAD_LEFT) . "\n";
        $ticket .= str_repeat('-', $lineWidth) . "\n";
        $ticket .= str_pad('TOTAL: $' . number_format($order['total'], 2), $lineWidth, ' ', STR_PAD_LEFT) . "\n\n";
        
        $ticket .= str_repeat('=', $lineWidth) . "\n";
        $ticket .= str_pad('¡Gracias por tu compra!', $lineWidth, ' ', STR_PAD_BOTH) . "\n";
        $ticket .= str_repeat('=', $lineWidth) . "\n\n\n";
        
        return $ticket;
    }

    /**
     * Eliminar todos los logs de pedidos
     */
    public function clearOrderLogs()
    {
        $filePath = storage_path('logs/pedidos.log');
        
        if (File::exists($filePath)) {
            File::put($filePath, '');
            return redirect()->route('admin.order-logs')
                ->with('success', 'Todos los logs de pedidos han sido eliminados correctamente.');
        }
        
        return redirect()->route('admin.order-logs')
            ->with('error', 'No se encontró el archivo de logs.');
    }

    /**
     * Descargar backup de logs
     */
    public function downloadOrderLogs()
    {
        $filePath = storage_path('logs/pedidos.log');
        
        if (!File::exists($filePath)) {
            return redirect()->route('admin.order-logs')
                ->with('error', 'No se encontró el archivo de logs.');
        }
        
        $fileName = 'pedidos_backup_' . date('Y-m-d_H-i-s') . '.log';
        
        return response()->download($filePath, $fileName);
    }

    /**
     * Mostrar estadísticas de pedidos
     */
    public function showStatistics()
    {
        $filePath = storage_path('logs/pedidos.log');
        
        $stats = [
            'total_pedidos' => 0,
            'total_ingresos' => 0,
            'promedio_pedido' => 0,
            'pedidos_hoy' => 0,
            'ingresos_hoy' => 0,
            'metodos_envio' => [],
            'pedidos_ultima_semana' => 0
        ];
        
        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $orderBlocks = explode('=== NUEVO PEDIDO ===', $content);
            
            $hoy = Carbon::today();
            $semanaPasada = Carbon::today()->subWeek();
            
            foreach ($orderBlocks as $block) {
                if (trim($block) !== '') {
                    $order = $this->parseOrderBlock($block);
                    if ($order) {
                        // Estadísticas generales
                        $stats['total_pedidos']++;
                        $stats['total_ingresos'] += $order['total'];
                        
                        // Pedidos de hoy
                        $fechaPedido = Carbon::createFromFormat('d/m/Y H:i:s', $order['fecha']);
                        if ($fechaPedido->isToday()) {
                            $stats['pedidos_hoy']++;
                            $stats['ingresos_hoy'] += $order['total'];
                        }
                        
                        // Pedidos última semana
                        if ($fechaPedido >= $semanaPasada) {
                            $stats['pedidos_ultima_semana']++;
                        }
                        
                        // Métodos de envío
                        $metodo = $order['metodo_envio'];
                        if (!isset($stats['metodos_envio'][$metodo])) {
                            $stats['metodos_envio'][$metodo] = 0;
                        }
                        $stats['metodos_envio'][$metodo]++;
                    }
                }
            }
            
            // Calcular promedio
            if ($stats['total_pedidos'] > 0) {
                $stats['promedio_pedido'] = $stats['total_ingresos'] / $stats['total_pedidos'];
            }
        }
        
        return view('admin.statistics', compact('stats'));
    }
}