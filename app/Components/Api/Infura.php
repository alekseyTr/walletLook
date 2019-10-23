<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 22.10.2019
 * Time: 12:49
 */

namespace App\Components\Api;


class Infura
{
    const VERSION = '3';

    public $client;

    public $apiUrl = 'https://mainnet.infura.io';

    public function __construct()
    {
        // TODO: set auth params from config
        $url = $this->apiUrl . '/v' . $this::VERSION .'/12b11dc823d1436996faa220a650623b';
        $this->client = new RPCClient($url);
    }

}