<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

class Wallet extends BaseModel
{
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

    protected $table = 'wallet';

    public function attributesToSave()
    {
        return array(
            'address'
        );
    }

}