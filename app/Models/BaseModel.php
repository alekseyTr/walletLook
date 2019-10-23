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
    protected static $table;

    protected static $pk = 'id';

    private $created;

    private $updated;

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = date('Y-m-d H:i:s', $created);
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = date('Y-m-d H:i:s', $updated);;
    }

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

    public function dateAttributesToSave()
    {
        return array(
            'created', 'updated'
        );
    }

    // TODO: use ORM (doctrine or laravel/database)

    public function save()
    {
        // TODO: add validation
        // Update date system attributes
        foreach ($this->dateAttributesToSave() as $systemAttribute)
            $this->{'set'.ucfirst($systemAttribute)}(time());

        // Prepare attributes to save
        $attributes = [];
        $attributesToSave = array_merge($this->attributesToSave(), $this->dateAttributesToSave());

        foreach ($attributesToSave as $saveAttribute)
            $attributes[$saveAttribute] = $this->{'get'.ucfirst($saveAttribute)}();

        App::$db->insert(static::$table, $attributes);
    }

    /* Data provider helpers */

    public static function getByPk($value)
    {
        $item = App::$db->select(static::$table, static::$pk . " = $value");
        $item = reset($item);
        return $item;
    }

    public static function deleteByPk($value)
    {
        App::$db->delete(static::$table, static::$pk . " = $value");
    }

    public static function getAll()
    {
        return App::$db->select(static::$table);
    }

}