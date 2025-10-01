<?php

namespace App\Http\Controllers;

use App\Models\PiezaLego;
use Illuminate\Http\Request;

class PiezaLegoController extends Controller
{
    public function index()
    {
        $piezas = PiezaLego::all();
        return view('piezaslego', compact('piezas'));
    }

    public function show($id)
    {
        $pieza = PiezaLego::findOrFail($id);
        return view('piezas.show', compact('pieza'));
    }

    public function create()
    {
        return view('piezas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric'
        ]);

        PiezaLego::create($request->all());
        return redirect()->route('piezaslego.index');
    }
}
