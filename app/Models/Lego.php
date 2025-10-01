<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lego extends Model
{
    public function coleccion() {
        return $this->belongsTo(Coleccion::class, 'idColeccion');
    }

    public function detalles() {
        return $this->hasMany(Detalle::class, 'idLego');
    }
}
