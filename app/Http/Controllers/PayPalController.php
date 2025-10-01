<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function showForm()
    {
        // Obtener el carrito de la sesión
        $cart = session('cart', []);

        // Calcular total en backend
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }

        if ($total <= 0) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'No hay productos en el carrito');
        }

        return view('paypal.form', compact('total'));
    }

    public function createPayment(Request $request)
    {
        // ⚠️ No confiar en $request->total: recalcular desde sesión
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0);
        }

        if ($total <= 0) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'No hay productos en el carrito');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($total, 2, '.', ''),
                ],
            ]],
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if (($link['rel'] ?? '') === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()
            ->route('pago.index')
            ->with('error', 'Algo salió mal con PayPal');
    }

    public function success(Request $request)
    {
        // PayPal devuelve ?token=ORDER_ID
        $token = $request->get('token');

        if (!$token) {
            return redirect()->route('pago.index')
                ->with('error', 'Token de PayPal no recibido');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($token);

        if (($response['status'] ?? null) === 'COMPLETED') {
            // TODO: guardar pago/pedido en BD, vaciar carrito, etc.
            // session()->forget('cart');
            return redirect()
                ->route('pago.success')
                ->with('success', '¡Pago completado con éxito!');
        }

        return redirect()
            ->route('pago.index')
            ->with('error', 'Algo salió mal con el pago');
    }

    public function cancel()
    {
        return redirect()
            ->route('pago.index')
            ->with('error', 'Pago cancelado');
    }
}
