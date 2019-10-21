<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:36
 */

namespace App\Components;

class Route
{
    public function resolve ()
    {
        // TODO: use Symfony Request component
        if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false)
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = array_filter(explode('/', $route));
        // TODO: For test use only main controller
        $result = [
            Kernel::$defaultControllerName,
            $route[1],
            $route[2]
        ];
        return $result;
    }
}