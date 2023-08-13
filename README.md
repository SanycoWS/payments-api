# Instruction

## Laravel Usage

create file `config/payments-api.php` with content:

```php
return [
    'paypal' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id' => env('PAYPAL_SANDBOX_APP_ID', ''),
    ],   
    'stripe' => [
        'secret_key' => env('STRIPE_SECRET_KEY', null)
        'publishable_key' => env('STRIPE_PUBLISHABLE_KEY', null)
    ],   
    'stripe' => [
        'private_key' => env('LIQPAY_PRIVATE_KEY', null)
        'public_key' => env('LIQPAY_PUBLIC_KEY', null)
    ],   
]
```
