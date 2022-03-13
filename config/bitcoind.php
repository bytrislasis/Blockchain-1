<?php

return [

    'default' => [
        'scheme' => env('BITCOIND_SCHEME', 'http'),
        'host' => env('BITCOIND_HOST', 'localhost'),
        'port' => env('BITCOIND_PORT', 8332),
        'user' => env('BITCOIND_USER', ''),
        'password' => env('BITCOIND_PASSWORD', ''),
        'ca' => null,
        'preserve_case' => false,
        'timeout' => false,
        'zeromq' => [
            'host' => 'localhost',
            'port' => 28332,
        ],
    ],

    'bitcoin' => [
        'scheme'        => 'http',
        'host'          => '192.168.1.50',
        'port'          => 18333,
        'user'          => 'satoshiturk',
        'password'      => 'Asd+-*789',
        'ca'            => null,
        'preserve_case' => false,
        'timeout'       => false,
        'zeromq'        => null,
    ],


    'litecoin' => [
        'scheme'        => 'http',
        'host'          => '192.168.1.50',
        'port'          => 8335,
        'user'          => 'satoshiturk',
        'password'      => 'Asd+-*789',
        'ca'            => null,
        'preserve_case' => false,
        'timeout'       => false,
        'zeromq'        => null,
    ],


    'dogecoin' => [
        'scheme'        => 'http',
        'host'          => '192.168.1.50',
        'port'          => 8337,
        'user'          => 'satoshiturk',
        'password'      => 'Asd+-*789',
        'ca'            => null,
        'preserve_case' => false,
        'timeout'       => false,
        'zeromq'        => null,
    ],


];
