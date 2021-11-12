<?php

namespace App\Controllers;
use \core\view;
use App\models\tablelists;

class Lists extends \core\controller {
    public function indexAction() {
        echo 'Hello from template';
    }

    public function categoryListAction() {
        $cat_list = tablelists::getCategoryList();
        $is_empty = !count($cat_list) > 0 ? true : false;

        View::renderTemplate('templates/category-list.php', [
            'lists' => $cat_list,
            'is_empty' => $is_empty,
            'BASE_URL' => BASE_URL,
        ]);
    }

    public function orderListAction() {
        $order_list = tablelists::getOrderList();
        $is_empty = !count($order_list) > 0 ? true : false;
        $invalid = null;

        if(isset($_SESSION['invalid'])) {
            $invalid = $_SESSION['invalid'];
            unset($_SESSION['invalid']);
        }

        View::renderTemplate('templates/order-list.php',[
            'lists' => $order_list,
            'is_empty' => $is_empty,
            'BASE_URL' => BASE_URL,
            'error' => $invalid
        ]);
    }

    public function productsListAction() {
        $pro_list = tablelists::getProductList();
        $is_empty = !count($pro_list) > 0 ? true : false;
        $invalid = null;

        if(isset($_SESSION['invalid'])) {
            $invalid = $_SESSION['invalid'];
            unset($_SESSION['invalid']);
        }
        
        View::renderTemplate('templates/products-list.php', [
            'lists' => $pro_list,
            'is_empty' => $is_empty,
            'BASE_URL' => BASE_URL,
            'error' => $invalid,
        ]);
    }

    // public function before() {
    // }
    
    // public function after() {
    //     echo "Hello After";
    // }
}