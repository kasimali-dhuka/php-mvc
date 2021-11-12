<?php

namespace App\models;

class EditList extends \core\model {
    public static function editOrders() {

        $table = "order_table";

        try {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $error = [];

                if (!preg_match("/^[0-9]+$/",$id) || trim($id) == "") {
                    $error['id'] = "Please enter valid price";
                }
                
                if(count($error) > 0) {
                    return [
                        'status' => 'error',
                        'data' => $error,
                    ];
                }

                $db = static::getDB();
                $sql = "SELECT * FROM $table WHERE order_id = '$id'";
                $result = mysqli_query($db, $sql);

                if(!mysqli_num_rows($result) > 0) {
                    return [
                        'status' => 'error'
                    ];
                }

                return [
                    'status' => 'success',
                    'data' => mysqli_fetch_all($result, MYSQLI_ASSOC),
                ];

            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function editProducts() {
        $table = "product";

        try {

            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $error = [];

                $select_query = "SELECT * FROM $table WHERE product_id = '$id'";

                return static::selectID($id, $error , $select_query);
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public static function editCategorys() {
        $table = "category";

        try {

            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $id = $_GET['id'];
                $error = [];

                $select_query = "SELECT * FROM $table WHERE category_id = '$id'";

                return static::selectID($id, $error , $select_query);
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}