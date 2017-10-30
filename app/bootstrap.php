<?php

ini_set('display_errors', 0);

use App\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Noodlehaus\Config;

require_once __DIR__.'/../vendor/autoload.php';


//Conf
$conf_dir = __DIR__.'/config/';
define('CONFIG_DIR', realpath($conf_dir));

//Files config
$conf_files = [
    $conf_dir . 'database.php'
];

$conf = Config::load($conf_files);

/**
 * Doctrine configuration
 */
$isDevMode = true;
$mappings_paths = [
    realpath(__DIR__.'/../src/App/Entity')
];
$configuration = Setup::createAnnotationMetadataConfiguration(
    $mappings_paths,
    $isDevMode,
    null, //Proxy dir
    null, //Cache Driver
    false //SimpleAnnotation
);

//Create EntityManager
$entityManager = EntityManager::create(
    $conf['database'][ENVIRONMENT],
    $configuration
);


Container::setEm($entityManager);