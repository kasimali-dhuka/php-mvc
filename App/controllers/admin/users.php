<?php

namespace App\controllers\admin;

class Users extends \core\controller {
    protected function before() {
        // Make sure an admin user is logged in (condition)
        // else return false;
    }

    public function indexAction() {
        echo "user admin index";
    }
}