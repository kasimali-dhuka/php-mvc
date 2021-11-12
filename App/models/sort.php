<?php

namespace App\models;

class Sort extends \core\model {
    public static function test() {
        $table = "product";
        try {
            if(isset($_POST['category']) && !empty($_POST['category'])) {
                $category_id = $_POST['category'];
                $db = static::getDB();
                $sql = "SELECT * FROM $table WHERE category_id = '$category_id'";
                $result = mysqli_query($db, $sql);
                
                if(!mysqli_num_rows($result) > 0) {
                    return [
                        'status' => 'error',
                    ];
                }

                return [
                    'status' => 'success',
                    'data' => mysqli_fetch_all($result, MYSQLI_ASSOC)
                ];
            }
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}