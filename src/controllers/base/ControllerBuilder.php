<?php

namespace App\controllers\base;

abstract class ControllerBuilder
{
    protected array $controllers = [];

    protected function buildControllers($controller)
    {
        $parts = preg_split('/(?=[A-Z])/',array_reverse(explode("\\", $controller))[0]);
        array_pop($parts);

        $name = rtrim(implode("",$parts),"\\");

        if(!array_key_exists($controller, $this->controllers)){
            $gateway = new ('\App\gateways\\'.$name.'Gateway')();
            $useCase = new ('\App\usecases\\'.$name.'UseCase')($gateway);

            $this->controllers[$controller] = new $controller($useCase);
        }

        return $this->controllers[$controller];

    }

}