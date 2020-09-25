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
    'facebook' => [
        'client_id' => '616353995980602',
        'client_secret' => '32cad16d4b034083787c64ffccceea89',
        'redirect' => 'https://sarahahs.com/login/facebook/callback',
    ],
    'twitter' => [
        'client_id' => 'dXhQpXXo4YBHfMNNs3hu8N9FN',
        'client_secret' => 'r8StYk8mnMfFXdRbaoHZDWN05HYKOUdesDzZQSz98Ky039RYMc',
        'redirect' => 'https://sarahahs.com/login/twitter/callback',
    ],
    'google' => [
        'client_id' => '709880219901-prqmjna4r9v4g73ishnieu13f1s6crrh.apps.googleusercontent.com',
        'client_secret' => 'PDV6O8qjcUGpVD7d_PYU22J4',
        'redirect' => 'https://sarahahs.com/login/google/callback',
    ]
];
