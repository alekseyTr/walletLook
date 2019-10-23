<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 21.10.2019
 * Time: 20:38
 */

namespace App\Components;

class Kernel
{
    public static $defaultControllerName = 'Controller';

    public static $defaultActionName = "index";

    public function launch()
    {
        list($controllerName, $actionName, $params) = App::$route->resolve();
        echo $this->launchAction($controllerName, $actionName, $params);
    }

    public function launchAction($controllerName, $actionName, $params)
    {
        $controllerName = empty($controllerName) ? $this::$defaultControllerName : ucfirst($controllerName);
        $controllerName = "App\\Controllers\\$controllerName";

        if(!class_exists($controllerName))
            throw new \InvalidArgumentException;

        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this::$defaultActionName : $actionName;
        $controller->action = $actionName;
        $actionName = "action$actionName";

        if (!method_exists($controller, $actionName))
            throw new \InvalidArgumentException;

        return $controller->$actionName($params);
    }
}