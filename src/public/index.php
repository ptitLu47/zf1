<?php

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(dirname(__DIR__)));
define("SRC_PATH", ROOT_PATH.DS."src");
define("PUBLIC_PATH", SRC_PATH.DS."public");
define("VENDOR_PATH", ROOT_PATH.DS."vendor");

require_once ROOT_PATH.DS.'vendor'.DS.'autoload.php';
echo "plop";