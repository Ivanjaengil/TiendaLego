<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PiezaLego;

class CarritoController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calcularTotal($cart);

        // Pasamos ya formateado a la vista
        return view('carrito', [
            'total' => number_format($total, 2) . '€'
        ]);
    }

    public function add(Request $request)
    {
        $id = $request->id;
        $pieza = PiezaLego::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $nombreArchivo = strtolower(str_replace(' ', '-', $pieza->nombre)) . '.png';

            $cart[$id] = [
                "nombre"   => $pieza->nombre,
                "cantidad" => 1,
                "precio"   => (float) $pieza->precio,   // casteamos a float
                "imagen"   => 'img/' . $nombreArchivo
            ];
        }

        session()->put('cart', $cart);

        $total = $this->calcularTotal($cart);

        return response()->json([
            'success' => true,
            'total'   => number_format($total, 2) . '€'
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->id && $request->cantidad) {
            $cart[$request->id]["cantidad"] = (int) $request->cantidad;
            session()->put('cart', $cart);
        }

        $subtotal = (float) $cart[$request->id]['precio'] * (int) $cart[$request->id]['cantidad'];
        $total = $this->calcularTotal($cart);

        return response()->json([
            'success'   => true,
            'subtotal'  => number_format($subtotal, 2) . '€',
            'total'     => number_format($total, 2) . '€'
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->id && isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        $total = $this->calcularTotal($cart);

        return response()->json([
            'success'  => true,
            'total'    => number_format($total, 2) . '€',
            'is_empty' => empty($cart)
        ]);
    }

    private function calcularTotal($cart): float
    {
        $total = 0;
        foreach ($cart as $item) {
            $precio = (float) $item['precio'];
            $cantidad = (int) $item['cantidad'];
            $total += $precio * $cantidad;
        }
        return $total;
    }
}

