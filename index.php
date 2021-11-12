<?php
require_once "./vendor/autoload.php";

$router = new core\Router();


// Add routes
$router->add('', ['controller'=>'Home', 'action'=>'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);


$router->dispatch($_SERVER['QUERY_STRING']);