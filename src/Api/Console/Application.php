<?php

namespace Api\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Silex\Application as SilexApplication;

class Application extends BaseApplication
{

    /**
     * @var SilexApplication
     */
    private $silexApplication;

    /**
     * @var string
     */
    private $projectDirectory;

    /**
     * Application constructor.
     * @param SilexApplication $silexApplication
     * @param string $projectDir
     * @param string $name
     * @param string $version
     */
    public function __construct(SilexApplication $silexApplication, $projectDir, $name = 'SilexConsole', $version = '1.0.0')
    {
        parent::__construct($name, $version);

        $this->silexApplication = $silexApplication;
        $this->projectDirectory = $projectDir;

        $silexApplication->boot();
    }

    /**
     * @return SilexApplication
     */
    public function getSilexApplication()
    {
        return $this->silexApplication;
    }


    /**
     * @return string
     */
    public function getProjectDirectory()
    {
        return $this->projectDirectory;
    }

}