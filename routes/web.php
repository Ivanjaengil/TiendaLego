<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth; 
use App\Models\PiezaLego;  
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\PiezaLegoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagoController;

// Ruta principal (home)
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home');
});
 
Route::get('/home', function () {
    return view('home');
})->name('home.index');
 



 // Rutas principales
Route::get('/piezaslego', [PiezaLegoController::class, 'index'])->name('piezaslego.index');
 
 
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/update', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');
 
 
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::get('/pago', [PagoController::class, 'mostrarPago'])->name('pago.mostrar');
Route::post('/pago/procesar', [PagoController::class, 'procesarPago'])->name('pago.procesar');
Route::get('/pago/exito', [PagoController::class, 'exitoPago'])->name('pago.exito');





// Rutas login y register   
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login.index');
 
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');
 
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register.index');
 
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

});
 



// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
 
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
 
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
 
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

        

    // Rutas de verificación de email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Agregar esta ruta para el dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});



// Rutas de autenticación
require __DIR__.'/auth.php';



