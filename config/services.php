<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
     'facebook' => [
        'client_id' => '338038313570608',         // Your GitHub Client ID
        'client_secret' =>'6d9e4931c75dafcb92a3fe17d00e79a4', // Your GitHub Client Secret
        'redirect' => 'https://www.weppl.org/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '194574334303-aqjqo3l2pdlb5u5giej4m0tt94omsrb4.apps.googleusercontent.com',
        'client_secret' => 'vI9wa394z9jEyG-j5c0_761U',
        'redirect' => 'http://www.weppl.org/google/callback'
    ],

];
