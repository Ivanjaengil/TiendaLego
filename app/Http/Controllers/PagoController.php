<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function mostrarPago()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        if(empty($cart)) {
            return redirect()->route('piezaslego.index')->with('error', 'Tu carrito está vacío');
        }
        
        return view('pago', compact('total'));
    }

    public function procesarPago(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required',
            'nombre' => 'required|string',
            'email' => 'required|email',
            'direccion' => 'required|string',
            'ciudad' => 'required|string',
            'codigo_postal' => 'required|string',
            'pais' => 'required|string',
        ]);

        try {
            $cart = session()->get('cart', []);
            $total = 0;
            
            foreach($cart as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }

            // Crear el pedido en la base de datos
            $pedido = Pedido::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'pais' => $request->pais,
                'metodo_pago' => $request->metodo_pago,
                'total' => $total,
                'productos' => $cart,
                'estado' => 'procesado'
            ]);

            // Limpiar el carrito
            session()->forget('cart');
            
            return redirect()->route('pago.exito')->with([
                'success' => true,
                'email' => $request->email,
                'pedido_id' => $pedido->id
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al procesar el pago. Por favor, inténtalo de nuevo.');
        }
    }

    public function exitoPago()
    {
        if (!session('success')) {
            return redirect()->route('piezaslego.index');
        }

        return view('pago-exitoso', [
            'email' => session('email'),
            'pedido_id' => session('pedido_id')
        ]);
    }
}