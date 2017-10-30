<?php

use Api\Command\HelloCommand;

//Define console constant
define('CONSOLE_APP', true);

//Include AppSilex
require 'app.php';

set_time_limit(0);

/**
 * Console Service Provider
 *
 */
$app->register(new ConsoleServiceProvider(), array(
    'console.name' => 'SilexConsole',
    'console.version' => '1.0.0',
    'console.project_directory' => __DIR__ . '/..'
));

/**
 * @var \Api\Console\Application $application
 */
$application = $app['console'];
$application->add(new HelloCommand());
$application->run();
