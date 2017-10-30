<?php

/**
 * Set env constant
 */
if (getenv('APPENV')) {
    define('ENVIRONMENT', getenv('APPENV'));
} else {
    define('ENVIRONMENT', 'development');
}

require __DIR__ . '/../app/app.php';

$app->run();