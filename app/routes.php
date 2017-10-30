<?php

use Api\Provider\HelloProvider;

$app->get('/', function () use ($app) {
    $data = ['message' => 'Hello World!'];
    return $app->json($data);
});

$app->mount('/hello', new HelloProvider());
