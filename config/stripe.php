<?php

return [
    'api_keys' => [
        'secret_key' => env('STRIPE_SECRET_KEY', null),
        'publish_key' => env('STRIPE_PUBLIC_KEY', null),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET', null),
    ],
];
