<?php
namespace Core;
session_start();
use core\View;

define('BASE_URL', $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".explode("/",$_SERVER['PHP_SELF'])[1]."/".explode("/",$_SERVER['PHP_SELF'])[2]. "/");
define('ROOT_URL', $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".explode("/",$_SERVER['PHP_SELF'])[1]."/");

abstract class Controller {
    protected $route_params = [];

    public function __construct($route_params) {
        $this->route_params = $route_params;
    }

    public function __call($name, $args) {
        $method = $name . "Action";

        if(method_exists($this, $method)) {
            if($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            echo "Method $method not found in controller " . get_class($this);
        }
    }

    protected function before(){
        if(!isset($_SESSION['is_active']) && empty($_SESSION['username'])) {
            if(!($_SERVER['QUERY_STRING'] == 'home/login' || $_SERVER['QUERY_STRING'] == 'home/register'|| $_SERVER['QUERY_STRING'] == '' )) {
                header('Location: '.BASE_URL.'home/login');
            }
        }
    }

    protected function after(){
        if(!isset($_SESSION['is_active']) && empty($_SESSION['username'])) {
            if(!($_SERVER['QUERY_STRING'] == 'home/login' || $_SERVER['QUERY_STRING'] == 'home/register'|| $_SERVER['QUERY_STRING'] == '' )) {
                header('Location: '.BASE_URL.'home/login');
            }
        }
    }
}