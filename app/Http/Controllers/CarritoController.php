<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PiezaLego;

class CarritoController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        return view('carrito', compact('total'));
    }

    public function add(Request $request)
    {
        $id = $request->id;
        $pieza = PiezaLego::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $cart[$id] = [
                "nombre" => $pieza->nombre,
                "cantidad" => 1,
                "precio" => $pieza->precio,
                "imagen" => 'img/' . strtolower($pieza->nombre) . '.jpg'
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        if($request->id && $request->cantidad) {
            $cart = session()->get('cart');
            $cart[$request->id]["cantidad"] = $request->cantidad;
            session()->put('cart', $cart);
        }
        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return response()->json(['success' => true]);
    }
} 