<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
<?php
define("DS", DIRECTORY_SEPARATOR);
define("APP_ENV", getenv("APPLICATION_ENV") ?: "production");
define("ROOT_PATH", dirname(dirname(__DIR__)));
define("SRC_PATH", ROOT_PATH.DS."src");
define("PUBLIC_PATH", SRC_PATH.DS."public");
define("VENDOR_PATH", ROOT_PATH.DS."vendor");
define("APP_PATH", SRC_PATH.DS."application");
define("LIB_PATH", ROOT_PATH.DS."library");

require_once ROOT_PATH.DS.'vendor'. DS .'autoload.php';

if("development" === APP_ENV){
    \php_error\reportErrors();
} else {
    set_exception_handler(array('\Iplib\Error', 'handlerException'));
    set_error_handler(array('\Iplib\Error', 'handlerError')); // erreur php
}

//$autoloader = Zend_Loader_Autoloader::getInstance(); ---> plus besoin puisqu'on l'a ajouter dans composer.json

$application = new Zend_Application(
        APP_ENV,
        APP_PATH.DS."core". DS ."configs". DS ."application.ini"
);

$application->bootstrap();
$application->run();

/*
function exceptionHandler()
{
    echo "Erreur de l'application";
    // logger dans le syslog
    // envoyer un mail à l'admin...
}

function errorHandler($errno, $errstr, $errfile, $errline, $context)
{
    echo "Erreur de l'application errorHandler";
    // logger dans le syslog
    // envoyer un mail à l'admin...
}*/