<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 07/07/14
 * Time: 16:57
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require 'single.php';

$single1 = Single::getInstance();
var_dump($single1);

$single2 = Single::getInstance();
var_dump($single2);
