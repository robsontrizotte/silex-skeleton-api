<?php


namespace Api\Http\Messages;


class Response
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var int
     */
    private $httpCode = 0;


    private function __construct()
    {
    }

    /**
     * @param string $message
     * @param int $httpCode
     * @return Response
     */
    public static function failure($message = "Couldn't process the request.", $httpCode = 400)
    {
        $response = new static();
        $response->setSuccess(false);
        $response->setMessage($message);
        $response->setHttpCode($httpCode);

        return $response;
    }

    /**
     * @param array $data
     * @param int $httpCode
     * @param null|string $message
     * @return Response
     */
    public static function success(array $data, $httpCode = 200, $message = null)
    {
        $response = new static();
        $response->setSuccess(true);
        $response->setData($data);
        $response->setHttpCode($httpCode);
        $response->setMessage($message);

        return $response;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'success' => $this->isSuccess()
        ];

        if ($this->getMessage() !== null) {
            $data['message'] = $this->getMessage();
        }

        if ($this->isSuccess()) {
            $data['data'] = $this->getData();
        }

        return $data;

    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     * @return Response
     */
    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        if ($this->httpCode < 100 || $this->httpCode >= 600) {
            $this->httpCode = $this->isSuccess() ? 200 : 400;
        }
        return $this->httpCode;
    }

    /**
     * @param int $httpCode
     * @return Response
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
        return $this;
    }
}