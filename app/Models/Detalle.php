<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    public function pedido() {
        return $this->belongsTo(Pedido::class, 'idPedido');
    }
    public function lego() {
        return $this->belongsTo(Lego::class, 'idLego');
    }
}

