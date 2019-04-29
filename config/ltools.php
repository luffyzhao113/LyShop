<?php
return [
    // 加签
    'sign' => [
        'time_out' => env('LTOOL_SIGN_TIME_OUT', 60),

        'sign_key' => env('LTOOL_SIGN_SIGN_KEY', 'DFECXFE53ER432Ef'),

        'rsa_private_key' => env('LTOOL_SIGN_RSA_PRIVATE', __DIR__ . '/../pems/rsa_private_key.pem'),

        'rsa_public_key' => env('LTOOL_SIGN_RSA_PUBLIC', __DIR__ . '/../pems/rsa_public_key.pem'),
    ],

    // token-cache验证
    'token-cache' => [
        'key_prefix' => 'token:cache:',
        'exp' => 86400,
        'ttl' => 86400
    ]
];