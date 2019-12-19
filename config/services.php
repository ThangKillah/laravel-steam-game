<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'homepage_url' => env('APP_URL'),

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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_APP_CALLBACK_URL'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_APP_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect' => env('GOOGLE_APP_CALLBACK_URL'),
    ],

    'twitch' => [
        'client_id' => env('TWITCH_APP_ID'),
        'client_secret' => env('TWITCH_APP_SECRET'),
        'redirect' => env('TWITCH_APP_CALLBACK_URL'),
    ],

    'steam' => [
        'client_id' => null,
        'client_secret' => env('STEAM_KEY'),
        'redirect' => env('STEAM_REDIRECT_URI')
    ],

    'recaptcha' => [
        'site_key' => env('NOCAPTCHA_SITEKEY'),
        'secret_key' => env('NOCAPTCHA_SECRET')
    ],

    'disqus' => [
        'secret_key' => env('DISQUS_SECRET_KEY'),
        'public_key' => env('DISQUS_PUBLIC_KEY')
    ],

    'gamespot' => [
        'url_review' => 'http://www.gamespot.com/api/reviews/',
        'url_blog' => 'http://www.gamespot.com/api/articles/',
        'key' => env('GAMESPOT_API_KEY'),
        'status_ok' => 200,
        'limit' => 100
    ]
];
