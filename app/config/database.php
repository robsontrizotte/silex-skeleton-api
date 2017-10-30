<?php

return [
    'database' => [
        'production' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'dbname',
            'user' => 'user',
            'password' => 'password',
            'charset' => 'utf8',
            'driverOptions' => array(1002 => 'SET NAMES utf8')
        ],
        'development' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'dbname',
            'user' => 'user',
            'password' => 'password',
            'charset' => 'utf8',
            'driverOptions' => array(1002 => 'SET NAMES utf8')
        ]
    ]
];
