<?php
namespace Iplib;

class Error
{
    public function handlerError($errno, $errstr, $errfile, $errline, $context)
    {
        echo "Erreur de l'application";
    }

    public function handlerException(\Exception $e) // rajouter le \ pour montrer que c'est dans php
    {
        echo "Erreur de l'application handleException";
    }
}