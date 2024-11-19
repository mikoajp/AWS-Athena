<?php


return [
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'version' => 'latest',
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],
    's3' => [
        'bucket' => env('AWS_BUCKET'),
    ],
];
