<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 23:09
 */

namespace App\Models;


use App\Components\App;

class BaseModel
{

    protected $connection;
    protected $table;

    public function __construct(array $attributes = [])
    {
        if (!empty($attributes))
            $this->setAttributes($attributes);
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            if (method_exists($this, 'set'.ucfirst($attribute)))
                $this->{'set'.ucfirst($attribute)}($value);
            elseif (property_exists($this, $attribute))
                $this->$attribute = $value;
        }
    }

    public function attributesToSave()
    {
        return array();
    }

    // TODO: use ORM (doctrine or laravel/database)

    public function save()
    {
        $attributes = $values = $params = array();
        foreach ($this->attributesToSave() as $saveAttribute) {
            $attributes[] = $saveAttribute;
            $values[] = ":$saveAttribute";
            $params[":$saveAttribute"] = $this->{'get'.ucfirst($saveAttribute)}();
        }
        // TODO: add validation and system fields
        $query = "INSERT INTO {$this->table} (".implode(',', $attributes).") VALUES(".implode(',', $values).")";

        App::$db->execute($query, $params);
    }

}