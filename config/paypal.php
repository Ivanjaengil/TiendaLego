<?php
/**
 * config/paypal.php
 * Configuración para srmklive/paypal (Orders API).
 * Se usa con: $provider->setApiCredentials(config('paypal'));
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Modo
    |--------------------------------------------------------------------------
    | 'sandbox' para pruebas, 'live' para producción.
    */
    'mode' => env('PAYPAL_MODE', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Credenciales Sandbox
    |--------------------------------------------------------------------------
    | Mapeadas a tus variables actuales:
    |   PAYPAL_CLIENT_ID, PAYPAL_SECRET
    | y compatibles con las convenciones del paquete:
    |   PAYPAL_SANDBOX_CLIENT_ID, PAYPAL_SANDBOX_CLIENT_SECRET
    */
    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID', env('PAYPAL_CLIENT_ID')),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', env('PAYPAL_SECRET')),
        'app_id'        => env('PAYPAL_SANDBOX_APP_ID', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Credenciales Live
    |--------------------------------------------------------------------------
    | Si aún no las tienes, puedes dejarlo vacío o reutilizar las mismas
    | variables. Recomendado usar variables separadas en producción.
    */
    'live' => [
        'client_id'     => env('PAYPAL_LIVE_CLIENT_ID', env('PAYPAL_CLIENT_ID')),
        'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', env('PAYPAL_SECRET')),
        'app_id'        => env('PAYPAL_LIVE_APP_ID', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Moneda, localización y validación SSL
    |--------------------------------------------------------------------------
    */
    'currency'     => env('PAYPAL_CURRENCY', 'EUR'),
    'locale'       => env('PAYPAL_LOCALE', 'es_ES'),
    'validate_ssl' => (bool) env('PAYPAL_VALIDATE_SSL', true),

    /*
    |--------------------------------------------------------------------------
    | HTTP (timeouts / reintentos)
    |--------------------------------------------------------------------------
    */
    'http' => [
        'timeout' => (int) env('PAYPAL_HTTP_TIMEOUT', 30),
        'retry'   => (int) env('PAYPAL_HTTP_RETRY', 1),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log
    |--------------------------------------------------------------------------
    */
    'log' => [
        'enabled'   => (bool) env('PAYPAL_LOG_ENABLED', true),
        'file_name' => env('PAYPAL_LOG_FILE', storage_path('logs/paypal.log')),
        'level'     => env('PAYPAL_LOG_LEVEL', 'ERROR'),
    ],
];
