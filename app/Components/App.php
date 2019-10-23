<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:35
 */

namespace App\Components;

use App\Components\Api\Infura;
use Symfony\Component\HttpFoundation\Request;

class App
{
    public static $kernel;

    public static $request;

    public static $route;

    public static $db;

    public static $infura;

    public static function init()
    {
        // Bootstrap
        static::$route = new Route();
        static::$request = Request::createFromGlobals();
        static::$kernel = new Kernel();
        static::$db = new Db();
        static::$infura = new Infura();
    }
}