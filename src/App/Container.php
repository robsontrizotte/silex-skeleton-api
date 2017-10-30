<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Noodlehaus\Config;
use Silex\Application;

/**
 * Class Container
 * @package App
 */
final class Container
{

    /**
     * @var EntityManager
     */
    private static $em;

    /**
     * @var Config
     */
    private static $config;

    /**
     * @var Application
     */
    private static $app;

    /**
     * Container constructor.
     */
    private function __construct(){}

    /**
     * @return EntityManager
     */
    public static function getEm()
    {
        return self::$em;
    }

    /**
     * @param EntityManager $em
     */
    public static function setEm(EntityManager $em)
    {
        self::$em = $em;
    }

    /**
     * @return Config
     */
    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * @param Config $config
     */
    public static function setConfig(Config $config)
    {
        self::$config = $config;
    }

    /**
     * @return Application
     */
    public static function getApp()
    {
        return self::$app;
    }

    /**
     * @param Application $app
     */
    public static function setApp(Application $app)
    {
        self::$app = $app;
    }
}