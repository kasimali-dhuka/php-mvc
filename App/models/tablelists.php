<?php

namespace App\models;

class TableLists extends \core\model {

    public static function getCategoryList() {
        $table = "category";

        try {
            
            $data = static::getDBData($table);
            return $data;

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getProductList() {
        $table = "product";

        try{

            $result = static::getDBData($table);
            return $result;

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public static function getOrderList() {
        $table = "order_table";

        try{
            
            $result = static::getDBData($table);
            return $result;

        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

}