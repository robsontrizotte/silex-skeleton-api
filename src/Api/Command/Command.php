<?php

namespace Api\Command;

use Api\Console\Application;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Class Command
 * @package Api\Command
 */
class Command extends BaseCommand
{
    /**
     * @return \Silex\Application
     */
    public function getSilexApplication()
    {
        return $this->getConsoleApp()->getSilexApplication();
    }

    /**
     * @return string
     */
    public function getProjectDirectory()
    {
        return $this->getConsoleApp()->getProjectDirectory();
    }

    /**
     * @return Application
     */
    protected function getConsoleApp()
    {
        /**
         * @var Application $consoleApp
         */
        $consoleApp = $this->getApplication();
        return $consoleApp;
    }
}
