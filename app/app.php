<?php
require 'bootstrap.php';

use App\Container;
use Silex\Application;

//Silex Application
$app = new Application();


//Applications
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => dirname(CONFIG_DIR) . '/logs' .'/error.log',
    'monolog.level' => \Monolog\Logger::ERROR 
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/Api/Resources/views'
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => $conf['database'][ENVIRONMENT]
));

if (!defined('CONSOLE_APP')) {
    //Routes
    require 'routes.php';

    /*
    //Security
    $app->register(new ApiKeyAuthenticationServiceProvider(), array(
        'security.apikey.param' => 'X-Api-Key',
    ));

    $app->register(new SecurityServiceProvider(), array(
        'security.firewalls' => array(
            'news' => array(
                'pattern' => '^/newsletter'
            ),
            'api' => array(
                'apikey'    => true,
                'pattern'   => '^/',
                'stateless' => true,
            ),
        )
    ));
    */

}
Container::setApp($app);

