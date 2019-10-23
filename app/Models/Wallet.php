<?php

namespace App\Models;

use App\Components\Api\Response;
use App\Components\App;

class Wallet extends BaseModel
{
    protected static $table = 'wallet';

    private $id;

    private $address;

    private $type;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function attributesToSave()
    {
        return array(
            'address'
        );
    }

    public function dateAttributesToSave()
    {
        return array(
            'created',
        );
    }
    public static function getBalance($address)
    {
        $balance = null;
        /* @var $apiResponse Response */
        $apiResponse = App::$infura->client->eth_getBalance([
            $address, 'latest'
        ]);
        if ($apiResponse->isSuccess()) {
            // TODO: convert balance to decimal
            $balance = $apiResponse->getResult();
            $balance = hexdec($balance);
            $balance = sprintf('%f', $balance);
        }
        return $balance;
    }

}