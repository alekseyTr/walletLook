<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:37
 */

namespace App\Components;

class Db
{
    public $pdo;

    public function __construct()
    {
        // TODO: set setting from configs (.env)
        $config = [
            'type' => 'mysql',
            'host' => 'mysql',
            'dbname' => 'app',
            'charset' => 'utf8',
            'user' => 'admin',
            'pass' => 'test',
        ];
        $settings = [
            'dsn' => "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
            'user' => $config['user'],
            'pass' => $config['pass'],
        ];
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], $options);
    }

    public function execute($query, array $params=null)
    {
        if ($params) {
            $request = $this->pdo->prepare($query);
            $request->execute($params);
        } else {
            $request = $this->pdo->query($query);
        }
        return $request->fetchAll();
    }

    public function insert($table, array $attributes)
    {
        $params = [];
        foreach ($attributes as $attribute => $value)
            $params[":$attribute"] = $value;
        $query = "INSERT INTO $table (".implode(',', array_keys($attributes)).') VALUES('.implode(',', array_keys($params)).')';
        $this->execute($query, $params);
    }

    public function delete($table, $condition)
    {
        $query = "DELETE FROM $table WHERE $condition";
        return $this->pdo->exec($query);
    }

    public function select($table, $condition = '')
    {
        $query = "SELECT * FROM $table";
        if ($condition)
            $query .= " WHERE $condition";
        return $this->execute($query);
    }
}