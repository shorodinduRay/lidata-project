<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'google' => [
        'client_id' => '973864743675-khou762atou0vrh5ua1ft4pl1vrop6bc.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/Lidata/auth/google/callback',
    ],


    'facebook' => [
        'client_id' => '1847953295409204',
        'client_secret' => '64dded023cd7aaaa51284fde5debea7e',
        'redirect' => 'http://localhost/Lidata/auth/facebook/callback',
    ],

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

];
