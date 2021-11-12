<?php

namespace App\models;

class Delete extends \core\model {

    public static function deleteOrder() {
        $table = "order_table";

        try{

            if(isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                $order_id = $_POST['order_id'];
                $db = static::getDB();
                $sql = "DELETE FROM $table WHERE order_id = '$order_id'";

                if(mysqli_query($db, $sql)) {
                    return [
                        'status' => 'success',
                        'data' => 'Order Deleted Successfully',
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'data' => 'Something went wrong',
                    ];
                }
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function deleteProduct() {
        $table = "product";

        try{

            if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
                $product_id = $_POST['product_id'];
                $error = [];

                $delete_query = "DELETE FROM $table WHERE product_id = '$product_id'";

                return static::deleteID($product_id, 'Product', $delete_query, $error);
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function deleteCategory() {
        $table = "category";

        try{

            if(isset($_POST['category_id']) && !empty($_POST['category_id'])) {
                $category_id = $_POST['category_id'];
                $error = [];

                $delete_query = "DELETE FROM $table WHERE category_id = '$category_id'";

                return static::deleteID($category_id, 'Product', $delete_query, $error);
            }

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}