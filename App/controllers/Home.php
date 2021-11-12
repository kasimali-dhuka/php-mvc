<?php


namespace App\Controllers;
use \core\view;
use \App\models\RegUser;
use App\models\tablelists;

class Home extends \core\Controller {
    public function indexAction() {
        $cat_list = count(tablelists::getCategoryList());
        $is_cat_empty = $cat_list > 0 ? true : false;

        $pro_list = count(tablelists::getProductList());
        $is_pro_empty = $pro_list > 0 ? true : false;

        $order_list = count(tablelists::getOrderList());
        $is_order_empty = $order_list > 0 ? true : false;

        
        if(isset($_POST['login_btn'])){
            $result = RegUser::login();
            
            if(isset($result['status']) && $result['status'] == 'error'){
                // echo "<pre>";
                // print_r($_SESSION);
                // echo "<br>";
                // print_r('error');
                // exit;
                $_SESSION['validation_error'] = $result['data'];
                header('Location: ./login');
            }
            
            if(isset($result['status']) && $result['status'] == 'success') {
                // echo "<pre>";
                // print_r($_SESSION);
                // print_r('success');
                // exit;
                view::renderTemplate('home/index.php', [
                    'user' => $_SESSION['username'],
                    'id' => $_SESSION['id'],
                    'categorylist' => $cat_list,
                    'productlist' => $pro_list,
                    'orderlist' => $order_list,
                    'is_cat_empty' => $is_cat_empty,
                    'is_pro_empty' => $is_pro_empty,
                    'is_order_empty' => $is_order_empty,
                ]);
            }
        } elseif(isset($_POST['register_btn'])){
            $result = RegUser::insert();

            if(isset($result['status']) && $result['status'] == 'error') {
                $_SESSION['validation_error'] = $result['data'];
                header('Location: ./register');
            }
            

            if($_SESSION['is_active']) {
                view::renderTemplate('home/index.php', [
                    'user' => $_SESSION['username'],
                    'categorylist' => $cat_list,
                    'productlist' => $pro_list,
                    'orderlist' => $order_list,
                    'is_cat_empty' => $is_cat_empty,
                    'is_pro_empty' => $is_pro_empty,
                    'is_order_empty' => $is_order_empty,
                ]);
            }
        } elseif(isset($_SESSION['is_active'])) {

            view::renderTemplate('home/index.php',[
                'user' => $_SESSION['username'],
                'id' => $_SESSION['id'] ?? '',
                'categorylist' => $cat_list,
                'productlist' => $pro_list,
                'orderlist' => $order_list,
                'is_cat_empty' => $is_cat_empty,
                'is_pro_empty' => $is_pro_empty,
                'is_order_empty' => $is_order_empty,
            ]);
        }  else {
            header('Location: home/login');
        }
    }

    public function login($error = "") {

        if(isset($_SESSION['is_active']) && !empty($_SESSION['username'])) {
            header('Location:'.BASE_URL);
        }

        $invalid_login = $_SESSION['validation_error'] ?? [];
        unset($_SESSION['validation_error']);
        View::renderTemplate('signin-up/login.php',[
            'error' => $error,
            'invalid_login' => $invalid_login,
        ]);
    }
    
    public function registerAction($error = "") {

        if(isset($_SESSION['is_active']) && !empty($_SESSION['username'])) {
            header('Location:'.BASE_URL);
        }

        $invalid_reg = $_SESSION['validation_error'] ?? [];
        unset($_SESSION['validation_error']);
        View::renderTemplate('signin-up/register.php',[
            'error' => $error,
            'invalid_reg' => $invalid_reg,
        ]);
    }

    public function logoutAction() {
        unset($_SESSION);
        session_destroy();
        header('Location: ./login');
    }

    // public function before() {
    // }

    // public function addUserAction() {
    //     $result = RegUser::insert();
    //     echo "<pre>";
    //     print_r($result);
    //     exit;
    // }

    // public function userLoginAction() {
    //     if(isset($_POST['login_btn'])) {
    //         echo 'True';
    //         exit;
    //     } else {
    //         echo 'False';
    //         exit;
    //     }
    //     $result = RegUser::login();
    //     // echo "<pre>";
    //     // print_r($result);
    //     // exit;
    // }

    // public function before() {
    //     if(true) {
    //         // echo '<pre>';
    //         // print_r($_SERVER);
    //         // exit;
    //         View::renderTemplate('signin-up/login.php', [
    //             $_SERVER['REDIRECT_QUERY_STRING']="home/login";
    //         ]);
    //     }
    // }

    // public function after() {
    //     echo 'Hello after';
    // }
    
}