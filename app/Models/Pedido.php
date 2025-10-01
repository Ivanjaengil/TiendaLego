<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'direccion',
        'ciudad',
        'codigo_postal',
        'pais',
        'metodo_pago',
        'total',
        'productos'
    ];

    protected $casts = [
        'productos' => 'array'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }
    public function detalles() {
        return $this->hasMany(Detalle::class, 'idPedido');
    }

}
