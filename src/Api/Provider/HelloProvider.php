<?php

namespace Api\Provider;

use Api\Http\Controllers\HelloController;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;



class HelloProvider implements ControllerProviderInterface
{
    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        /** @var \Silex\ControllerCollection $route */
        $route = $app['controllers_factory'];

        $route->get('/info', HelloController::class . '::getInfo');
        $route->get('/{name}', HelloController::class . '::getName');

        return $route;

    }
}