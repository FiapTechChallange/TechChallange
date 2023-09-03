<?php
namespace App\api;

class FastFoodApp
{
    private array $controllers = [];
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function create($controller, $request)
    {
        return ($this->buildControllers($controller))->create($request);
    }
    
    public function update($controller, $id, $request)
    {
        return ($this->buildControllers($controller))->update($id, $request);
    }
    
    public function delete($controller, $id)
    {
        return ($this->buildControllers($controller))->delete($id);
    }
    
    public function show($controller, $id)
    {
        return ($this->buildControllers($controller))->show($id);
    }

    public function list($controller, $params = null)
    {
        return ($this->buildControllers($controller))->list($params);
    }

    public function query($controller, $params, $method)
    {
        return ($this->buildControllers($controller))->$method($params);
    }

    public function buildControllers($controller)
    {
        $parts = preg_split('/(?=[A-Z])/',array_reverse(explode("\\", $controller))[0]);
        array_pop($parts);

        $name = rtrim(implode("",$parts),"\\");

        if(!array_key_exists($controller, $this->controllers)){
            $gateway = new ('\App\gateways\\'.$name.'Gateway')($this->connection);
            $useCase = new ('\App\usecases\\'.$name.'UseCase')($gateway);

            $this->controllers[$controller] = new $controller($useCase);
        }

        return $this->controllers[$controller];
        
    }

}