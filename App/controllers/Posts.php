<?php

namespace App\Controllers;
use \core\view;
use App\models\post;
use App\models\tablelists;
use App\models\Sort;
use App\models\EditList;
use App\models\UpdateList;
use App\models\Delete;

class Posts extends \core\controller{
    public function indexAction() {
        $posts = Post::getAll();
        
        View::renderTemplate('posts/index.php',[
            'users' => $posts
        ]);
    }

    public function addCategoryAction() {
        $error = [];
        $success = [];
        $edit_result = [];

        if(isset($_GET['id'])) {
            $result = EditList::editCategorys();

            if(isset($result['status']) && $result['status'] == 'error'){
                $error = $result['data'];
                header("location:".BASE_URL."lists/categorylist");
                $_SESSION['invalid'] = 'Something went wrong';
            }
            
            if(isset($result['status']) && $result['status'] == 'success'){
                $edit_result = $result['data'][0];
            }
        }

        if(isset($_POST['edit_category_btn']) && $_POST['edit_category_btn'] == 'edit_category_btn') {
            $category = UpdateList::updateCategorys();

            if(isset($category['status']) && $category['status'] == 'error'){
                $error = $category['data'];
            }
        
            if(isset($category['status']) && $category['status'] == 'success'){
                $success = $category['data'];
            }
        }

        if(isset($_POST['add_category_btn'])) {
            $category = Post::addCategories();

            if(isset($category['status']) && $category['status'] == 'error') {
                $error = $category['data'];
            }

            if(isset($category['status']) && $category['status'] == 'success') {
                $success = $category['data'];
            }
            
        }

        View::renderTemplate('posts/add-category.php',[
            'error' => $error,
            'success' => $success,
            'edit_category' => $edit_result,
        ]);
    }

    public function addProductAction() {
        $error = [];
        $success = [];
        $edit_result = [];

        if(isset($_GET['id'])) {
            $result = EditList::editProducts();

            if(isset($result['status']) && $result['status'] == 'error'){
                $error = $result['data'];
                header("location:".BASE_URL."lists/productslist");
                $_SESSION['invalid'] = 'Something went wrong';
            }
            
            if(isset($result['status']) && $result['status'] == 'success'){
                $edit_result = $result['data'][0];
            }
        }

        if(isset($_POST['edit_product_btn']) && $_POST['edit_product_btn'] == 'edit_product_btn') {
            $product = UpdateList::updateProduct();
            
            if(isset($product['status']) && $product['status'] == 'error'){
                $error = $product['data'];
            }
        
            if(isset($product['status']) && $product['status'] == 'success'){
                $success = $product['data'];
            }
        }
        
        if(isset($_POST['add_product_btn'])) {
            $product = Post::addProducts();
            
            if(isset($product['status']) && $product['status'] == 'error'){
                $error = $product['data'];
            }

            if(isset($product['status']) && $product['status'] == 'success'){
                $success = $product['data'];
            }
        }

        $cat_list = tablelists::getCategoryList();
        $is_empty = !count($cat_list) > 0 ? true : false;
        
        View::renderTemplate('posts/add-product.php', [
            'categorylist' => $cat_list,
            'is_empty' => $is_empty,
            'error' => $error,
            'success' => $success,
            'edit_products' => $edit_result,
        ]);
    }

    public function addOrderAction() {
        $error = [];
        $success = [];
        $edit_result = [];
        $BASE_URL = BASE_URL;
        $ROOT_URL = ROOT_URL;
        
        
        if(isset($_GET['id'])) {
            $result = EditList::editOrders();
            
            if(isset($result['status']) && $result['status'] == 'error'){
                $error = $result['data'];
                header("location:".BASE_URL."lists/orderlist");
                $_SESSION['invalid'] = 'Something went wrong';
            }
            
            if(isset($result['status']) && $result['status'] == 'success'){
                $edit_result = $result['data'][0];
                $_SESSION['product_id'] = $edit_result['product_id'];
            }
        }

        if(isset($_POST['edit_order_btn']) && $_POST['edit_order_btn'] == 'edit_order_btn'){
            $orders = UpdateList::updateOrders();

            if(isset($orders['status']) && $orders['status'] == 'error'){
                $error = $orders['data'];
            }
        
            if(isset($orders['status']) && $orders['status'] == 'success'){
                $success = $orders['data'];
            }
        }


        if(isset($_POST['add_order_btn']) && $_POST['add_order_btn'] == 'add_order_btn'){
            $orders = post::addOrders();
        
            if(isset($orders['status']) && $orders['status'] == 'error'){
                $error = $orders['data'];
            }
        
            if(isset($orders['status']) && $orders['status'] == 'success'){
                $success = $orders['data'];
            }
        }

        $cat_list = tablelists::getCategoryList();
        $is_cat_empty = !count($cat_list) > 0 ? true : false;

        $pro_list = tablelists::getProductList();
        $is_pro_empty = !count($pro_list) > 0 ? true : false;

        $order_list = tablelists::getOrderList();
        $is_order_empty = !count($order_list) > 0 ? true : false;


        View::renderTemplate('posts/add-order.php', [
            'categorylist' => $cat_list,
            'productlist' => $pro_list,
            'orderlist' => $order_list,
            'is_cat_empty' => $is_cat_empty,
            'is_pro_empty' => $is_pro_empty,
            'is_order_empty' => $is_order_empty,
            'error' => $error,
            'success' => $success,
            'BASE_URL' => $BASE_URL,
            'ROOT_URL' => $ROOT_URL,
            'edit_orders' => $edit_result,
        ]);
    }

    public function test() {
        $sort = Sort::test();
        $product_id = null;

        if(isset($_SESSION['product_id'])) {
            $product_id = $_SESSION['product_id'];
            unset($_SESSION['product_id']);
        }


        if(isset($sort['data']) && !empty($sort['data']) && $sort['status'] == 'success'){
            foreach ($sort['data'] as $key => $value) {
                if($product_id && $product_id == $value['product_id']) {
                    echo '<option value="'.$value['product_id'].'" data-price="'.$value['product_price'].'" selected>'.$value['product_name'].'</option>';
                } else {
                    echo '<option value="'.$value['product_id'].'" data-price="'.$value['product_price'].'">'.$value['product_name'].'</option>';
                }
            }
        } else {
            echo '<option value="" disabled> ⚠ No Products ⚠ </option>';
        }
    }

    public function delete() {
        if(isset($_POST['order_id'])){
            $delete = Delete::deleteOrder();
    
            if(isset($delete['status']) && !empty($delete['data']) && $delete['status'] == 'success' ) {
                print_r($delete['data']);
            } else {
                print_r($delete['data']);
            }
        }
        
        if(isset($_POST['product_id'])){
            $delete = Delete::deleteProduct();
    
            if(isset($delete['status']) && !empty($delete['data']) && $delete['status'] == 'success' ) {
                print_r($delete['data']);
            } else {
                print_r($delete['data']);
            }
        }

        if(isset($_POST['category_id'])){
            $delete = Delete::deleteCategory();
    
            if(isset($delete['status']) && !empty($delete['data']) && $delete['status'] == 'success' ) {
                print_r($delete['data']);
            } else {
                print_r($delete['data']);
            }
        }
    }

    // public function before() {
    //     echo 'Hello from start';
    // }
    // public function after() {
    //     echo 'Hello from end';
    // }
    
    // public function addNewAction() {
    //     echo "Hello from the addNew action in the Posts controller!";
    // }

    // public function editAction() {
    //     echo 'Hello from the edit action in Posts controller!';
    //     echo '<p> Route parameters : <pre>'. htmlspecialchars(print_r($this->route_params, true));
    // }
}