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
            'host' => 'localhost',
            'dbname' => 'wallet_look',
            'charset' => 'utf8',
            'user' => 'root',
            'pass' => ''
        ];
        $settings = [
            'dsn' => "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
            'user' => $config['user'],
            'pass' => $config['pass'],
        ];

        $this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
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
}