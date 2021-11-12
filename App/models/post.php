<?php

namespace App\models;


use PDO;

class Post extends \core\model{
    
    // public static function getAll() {
    //     $table = 'users';
        
    //     try {
    //         $db = static::getDB();
    //         $stmt = $db->query("SELECT * FROM $table");
    //         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $results;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }

    public static function getAll() {
        $table = "users";

        try{
            
            return static::getDBData($table);

        } catch (Exception $e) {
            echo $e->message();
        }
    }

    public static function addCategories() {
        $table = "category";

        try {

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category_btn']) && $_POST['add_category_btn'] == 'add_category_btn' ) {
                $category_name = $_POST["category_name"];
                $error=[];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$category_name) || trim($category_name) == "") {
                    $error['category_name'] = "Please enter valid input";
                }
                
                $check_query = "SELECT * FROM $table WHERE category_name = '$category_name'";
                $insert_query = "INSERT INTO $table (`category_name`) VALUES ('$category_name')";

                return static::insertQuery($error, $check_query, $insert_query);
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function addProducts() {
        $table = "product";

        try {

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product_btn']) && $_POST['add_product_btn'] == 'add_product_btn' ) {
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $category_id = $_POST['category_id'];
                $error=[];

                if (!preg_match("/^[a-zA-Z-' ]*$/",$product_name) || trim($product_name) == "") {
                    $error['product_name'] = "Please enter valid name";
                }
                if (!preg_match("/^[0-9]+$/",$product_price) || trim($product_price) == "") {
                    $error['product_price'] = "Please enter valid price";
                }

                $check_query = "SELECT * FROM $table WHERE 	product_name = '$product_name'";
                $insert_query = "INSERT INTO $table (`product_name`, `product_price`, `category_id`) VALUES ('$product_name', '$product_price', '$category_id')";

                return static::insertQuery($error, $check_query, $insert_query);
                
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function addOrders() {
        $table = "order_table";
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_order_btn']) && $_POST['add_order_btn'] == 'add_order_btn' ) {
                $category_id = $_POST['category_id'];
                $product_id = $_POST['product_id'];
                $total_quantity = $_POST['quantity'];
                $product_price = $_POST['product_price'];
                $error=[];

                if (!preg_match("/^[0-9]+$/",$total_quantity) || trim($total_quantity) == "") {
                    $error['quantity'] = "Please enter valid quantity";
                }

                if (!preg_match("/^[0-9]+$/",$product_price) || trim($product_price) == "") {
                    $error['product_price'] = "Something went wrong !";
                }

                if(count($error) > 0) {
                    return [
                        'status' => 'error',
                        'data' => $error,
                    ];
                }

                $total_price = $total_quantity * $product_price;
                $time = date('Y-m-d', time());
                $check_query = "";
                $insert_query = "INSERT INTO $table (`order_date`, `total_price`, `order_quantity`, `product_id`, `category_id`) VALUES('$time', '$total_price', '$total_quantity', '$product_id', '$category_id')";

                return static::insertQuery($error, $check_query ,$insert_query );

            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}