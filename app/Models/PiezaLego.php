<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PiezaLego extends Model
{
    protected $table = 'piezas_lego'; 
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio'
    ];
}