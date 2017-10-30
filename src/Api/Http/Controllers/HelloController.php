<?php

namespace Api\Http\Controllers;

use Api\Http\Messages\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HelloController
 * @package Api\Controller
 */
class HelloController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getInfo(Request $request)
    {
        try {
            return $this->jsonResponse(Response::success(['Hello' => true]));
        } catch (\Exception $e) {
            return $this->jsonResponse(Response::failure($e->getMessage()));
        }
    }
}
