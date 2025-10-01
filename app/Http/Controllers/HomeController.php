<?php

namespace App\Http\Controllers;

use App\Models\PiezaLego;
use Illuminate\Http\Request;

class HomeController extends Controller
{
 public function index() 
 {
  $piezalego = PiezaLego::where('id', 1)->get();
  return view('home', compact('piezalego'));
 }
}
