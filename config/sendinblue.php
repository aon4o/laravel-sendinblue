<?php

declare(strict_types=1);

return [
    'api' => [
        'url' => env('SENDINBLUE_API_KEY', 'https://api.sendinblue.com/v3/'),
        'key' => env('SENDINBLUE_API_KEY', ''),
        'key_name' => env('SENDINBLUE_API_KEY_NAME', 'api-key'),
    ],
];
