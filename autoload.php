<?php 
abstract class Autoload
{

    public static function inclusionAuto($className){
        if($className == 'controller\Controller'){
            require __DIR__ . '/controller/Controller.php';
        }else{ 
     require_once __DIR__ .'/' . str_replace('\\', '/', $className) .'.php';
       }
    }

}

spl_autoload_register(['Autoload', 'inclusionAuto']);

//test 
//$c = new controller\Controller;
///echo $c->getClass();