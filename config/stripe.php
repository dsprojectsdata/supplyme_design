<?php
 
return [
    'pk' => env('STRIPE_KEY'),
    'sk' => env('STRIPE_SECRET'),
    'webhook' => env('STRIPE_WEBHOOK_SECRET')
];