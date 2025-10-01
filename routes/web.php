<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PiezaLegoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PayPalController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------------------
// RUTA PRINCIPAL (HOME)
// -------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// -------------------------
// RUTAS PRINCIPALES
// -------------------------
Route::get('/piezaslego', [PiezaLegoController::class, 'index'])->name('piezaslego.index');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/add', [CarritoController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/update', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/remove', [CarritoController::class, 'remove'])->name('carrito.remove');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto.index');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

// -------------------------
// RUTAS PAGO
// -------------------------
Route::get('/pago', [PagoController::class, 'mostrarPago'])->name('pago.mostrar');
Route::post('/pago/procesar', [PagoController::class, 'procesarPago'])->name('pago.procesar');
Route::get('/pago/exito', [PagoController::class, 'exitoPago'])->name('pago.exito');

// -------------------------
// RUTAS PAYPAL
// -------------------------
Route::get('/paypal/form', [PayPalController::class, 'showForm'])->name('paypal.form');
Route::post('/paypal/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.create');
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

// -------------------------
// LOGIN / REGISTER (guest)
// -------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// -------------------------
// RUTAS USUARIOS AUTENTICADOS
// -------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Verificación de email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// -------------------------
// ARCHIVO DE AUTENTICACIÓN EXTRA
// -------------------------
require __DIR__.'/auth.php';
