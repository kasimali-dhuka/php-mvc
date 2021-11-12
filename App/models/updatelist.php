<?php

namespace App\models;

class UpdateList extends \core\model {

    public static function updateOrders() {
        $table = "order_table";

        try {

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_order_btn']) && $_POST['edit_order_btn'] == 'edit_order_btn' ) {
                $category_id = $_POST['category_id'];
                $product_id = $_POST['product_id'];
                $total_quantity = $_POST['quantity'];
                $product_price = $_POST['product_price'];
                $order_id = $_POST['order_id'];
                $error = [];

                if (!preg_match("/^[0-9]+$/",$total_quantity) || trim($total_quantity) == "") {
                    $error['quantity'] = "Please enter valid quantity";
                }
    
                if (!preg_match("/^[0-9]+$/",$product_price) || trim($product_price) == "") {
                    $error['product_price'] = "Something went wrong !";
                }

                if (!preg_match("/^[0-9]+$/",$order_id) || trim($order_id) == "") {
                    $error['order_id'] = "Something went wrong !";
                }
    
                if(count($error) > 0) {
                    return [
                        'status' => 'error',
                        'data' => $error,
                    ];
                }
    
                $total_price = $total_quantity * $product_price;
                $time = date('Y-m-d', time());

                $check_query = "SELECT * FROM $table WHERE order_id = '$order_id' AND total_price = '$total_price' AND order_quantity = '$total_quantity' AND product_id = '$product_id' AND category_id = '$category_id'";
                $update_query = "UPDATE $table SET order_date = '$time', total_price = '$total_price', order_quantity = '$total_quantity', product_id = '$product_id', category_id = '$category_id' WHERE order_id = $order_id";
                
                return static::updateQuery($error, $check_query, $update_query);
                
            }


        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function updateProduct() {
        $table = 'product';

        try {

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_product_btn']) && $_POST['edit_product_btn'] == 'edit_product_btn' ) {
                $category_id = $_POST['category_id'];
                $product_id = $_POST['product_id'];
                $product_price = $_POST['product_price'];
                $product_name = $_POST['product_name'];
                $error = [];

                if (!preg_match("/^[0-9]+$/",$category_id) || trim($category_id) == "") {
                    $error['category_id'] = "Something went wrong";
                }
                if (!preg_match("/^[0-9]+$/",$product_id) || trim($product_id) == "") {
                    $error['product_id'] = "Something went wrong";
                }
                if (!preg_match("/^[0-9]+$/",$product_price) || trim($product_price) == "") {
                    $error['product_price'] = "Please enter valid price";
                }
                if (!preg_match("/^[a-zA-Z-' ]*$/",$product_name) || trim($product_name) == "") {
                    $error['product_name'] = "Please enter valid name";
                }

                $check_query = "SELECT * FROM $table WHERE product_id = '$product_id' AND product_name = '$product_name' AND product_price = '$product_price' AND category_id = '$category_id'";
                $update_query = "UPDATE $table SET product_name = '$product_name', product_price = '$product_price', category_id = '$category_id' WHERE product_id = '$product_id'";

                return static::updateQuery($error, $check_query, $update_query);
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function updateCategorys() {
        $table = 'category';

        try {

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_category_btn']) && $_POST['edit_category_btn'] == 'edit_category_btn' ) {
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $error = [];

                if (!preg_match("/^[0-9]+$/",$category_id) || trim($category_id) == "") {
                    $error['category_id'] = "Please enter valid price";
                }
                if (!preg_match("/^[a-zA-Z-' ]*$/",$category_name) || trim($category_name) == "") {
                    $error['category_name'] = "Please enter valid name";
                }

                $check_query = "SELECT * FROM $table WHERE category_id = '$category_id' AND category_name = '$category_name'";
                $update_query = "UPDATE $table SET category_name = '$category_name' WHERE category_id='$category_id'";

                return static::updateQuery($error, $check_query, $update_query);
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}