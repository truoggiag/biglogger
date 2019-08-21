<?php
return [
    'contactpoints' => env('CQL_HOST', '127.0.0.1'),
    'port' => env('CQL_PORT', 9042),
    'keyspace' => env('CQL_KEYSPACE', 'bigloger'),
];