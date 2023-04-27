<?php

declare(strict_types=1);

use GuzzleHttp\Client;

return [
    'api' => [
        /*
        |--------------------------------------------------------------------------
        | SendInBlue API URL to be used for making requests.
        |--------------------------------------------------------------------------
        */
        'url' => env('SENDINBLUE_API_KEY', 'https://api.sendinblue.com/v3/'),

        /*
        |--------------------------------------------------------------------------
        | SendInBlue API Authentication Key
        |--------------------------------------------------------------------------
        | Used for identifying your identity when making requests to the API.
        | Can be found/created at https://app.sendinblue.com/settings/keys/api.
        */
        'key' => env('SENDINBLUE_API_KEY', ''),

        /*
        |--------------------------------------------------------------------------
        | SendInBlue API Authentication Key Name
        |--------------------------------------------------------------------------
        */
        'key_name' => env('SENDINBLUE_API_KEY_NAME', 'api-key'),

        /*
        |--------------------------------------------------------------------------
        | HTTP Client
        |--------------------------------------------------------------------------
        | If you want use custom http client,
        | pass your client which implements `GuzzleHttp\ClientInterface`.
        | This is optional, `GuzzleHttp\Client` will be used as default.
        */
        'client' => Client::class,
    ],
];
