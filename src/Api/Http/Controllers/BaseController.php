<?php


namespace Api\Http\Controllers;


use Api\Http\Messages\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController
{
    /**
     * @param Response $response
     * @return JsonResponse
     */
    protected function jsonResponse(Response $response)
    {
        return new JsonResponse($response->toArray(), $response->getHttpCode());
    }

}