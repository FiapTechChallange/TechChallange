<?php
namespace App\Core\Domain\Base;

class BaseController
{
    private static array $controllers = [];

    private function __construct(){}

    public static function create($controller, $request)
    {
        return (self::BuildControllers($controller))->create($request);
    }
    
    public static function update($controller, $id, $request)
    {
        return (self::BuildControllers($controller))->update($id, $request);
    }
    
    public static function delete($controller, $id)
    {
        return (self::BuildControllers($controller))->delete($id);
    }
    
    public static function show($controller, $id)
    {
        return (self::BuildControllers($controller))->show($id);
    }

    public static function list($controller)
    {
        return (self::BuildControllers($controller))->list();
    }

    public static function BuildControllers($controller)
    {
        $parts = preg_split('/(?=[A-Z])/',array_reverse(explode("\\", $controller))[0]);
        array_pop($parts);

        $name = rtrim(implode("",$parts),"\\");

        if(!array_key_exists($controller, self::$controllers)){
            $repository = new ('\App\Adapter\Driven\Infra\Repository\\'.$name.'Repository');
            $useCase = new ('\App\Core\Application\UseCases\\'.$name.'UseCase')($repository);

            self::$controllers[$controller] = new $controller($useCase);
        }

        return self::$controllers[$controller];
        
    }

}