<?php

namespace Api\Console;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class ConsoleEvent
 * @package Api\Console
 */
class ConsoleEvent extends Event
{
    private $application;

    /**
     * ConsoleEvent constructor.
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->application;
    }
}