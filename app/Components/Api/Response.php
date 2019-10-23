<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 22.10.2019
 * Time: 12:48
 */

namespace App\Components\Api;


class Response
{
    protected $response;

    protected $success;

    public function __construct($response)
    {
        $this->response = json_decode($response, false, 512);
        $this->success = !isset($this->response->error);
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getResult()
    {
        return $this->response->result;
    }

    public function getErrorCode()
    {
        return $this->response->error->code;
    }

    public function getErrorMessage()
    {
        return $this->response->error->message;
    }
}