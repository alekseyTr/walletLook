<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 22.10.2019
 * Time: 12:41
 */
namespace App\Components\Api;

class RPCClient
{
    const VERSION = '2.0';

    protected $url;

    protected $user;

    protected $secret;

    private $method;

    private $params;

    public function __construct($url, array $auth = [])
    {
        $this->url = $url;

        if(count($auth) == 2) {
            $this->user = $auth[0];
            $this->secret = $auth[1];
        }
    }

    public function __call($name, array $arguments = [])
    {
        $this->method = $name;
        $this->params = count($arguments) == 1 && is_array($arguments[0]) ? $arguments[0] : $arguments;

        return $this->_curl();
    }

    private function _curl()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            'method' => $this->method,
            'params' => $this->params,
            'id' => microtime(),
            'jsonrpc' => self::VERSION
        ]));
        if(!is_null($this->user)) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, "{$this->user}:{$this->secret}");
        }
        $result = curl_exec($curl);
        curl_close($curl);

        return new Response($result);
    }
}