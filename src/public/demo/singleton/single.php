<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 07/07/14
 * Time: 16:55
 */

class Single
{
    //l'objet ne peut pas être instancié plus d'une fois. Mécanisme qui permet de renvoyer l'instanciation s'il existe déjà
    // ou de le créer s'il n'existe pas

    // pour interdire une méthode , la passer en private!

    private static $instances = array();

    private function __construct()
    {

    }

    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset(self::$instances[$class])){
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

    private function __clone()
    {
        trigger_error("Clonage interdit", E_USER_ERROR);
    }
}