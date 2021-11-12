<?php

namespace core;
use App\config;
use PDO;

abstract class model {
    // protected static function getDB() {
    //     static $db = null;

    //     if($db === null) {
    //         try {
    //             $db = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=utf8", Config::DB_USER, Config::DB_PASSWORD);
    //         } catch (PDOException $e) {
    //             echo $e->getMessage();
    //         }
    //     }
    //     return $db;
    // }

    protected static function getDB() {
        static $db = null;

        if($db === null) {
            try {
                $db = mysqli_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
            } catch(Exception $e) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        return $db;
    }

    protected static function getDBData($table) {
        $db = static::getDB();
        $sql = "SELECT * FROM $table";
        $query = mysqli_query($db, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

        return $result;
    }

    public static function insertQuery($error, $check_query="", $insert_query) {
        if(count($error) > 0) {
            return [
                'status' => 'error',
                'data' => $error,
            ];
        }
        
        $db = static::getDB();

        if($check_query !== ""){
            $sql = $check_query;
            $result = mysqli_query($db, $sql);
    
            if(mysqli_num_rows($result) > 0) {
                return [
                    'status' => 'error',
                    'data' => array('exits' => 'Already exits'),
                ];
            }
        }
        $sql = $insert_query;

            if(mysqli_query($db, $sql)) {
                return [
                    'status' => 'success',
                    'data' => array('added', 'Added successfully'),
                ];
            } else {
                return [
                    'status' => 'error',
                    'data' => array('dberror' => 'Sql injection error! Please try again.'),
                ];
            }
    }

    public static function updateQuery($error, $check_query="", $update_query) {
        if(count($error) > 0) {
            return [
                'status' => 'error',
                'data' => $error,
            ];
        }
        
        $db = static::getDB();
        $sql = $check_query;
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) > 0) {
            return [
                'status' => 'error',
                'data' => array('exits' => 'Already exits'),
            ];
        } else {

            $sql = $update_query;

            if(mysqli_query($db, $sql)) {
                return [
                    'status' => 'success',
                    'data' => array('added', 'Added successfully'),
                ];
            } else {
                return [
                    'status' => 'error',
                    'data' => array('dberror' => 'Sql injection error! Please try again.'),
                ];
            }
        }
    }

    public static function selectID($id, $error, $select_query) {

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
        $sql = $select_query;
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

    public static function deleteID($id, $name="", $delete_query, $error) {
        if (!preg_match("/^[0-9]+$/",$id) || trim($id) == "") {
            $error['id'] = "Invalid Id";
        }
        
        if(count($error) > 0) {
            return [
                'status' => 'error',
                'data' => $error,
            ];
        }

        $db = static::getDB();
        $sql = $delete_query;

        if(mysqli_query($db, $sql)) {
            return [
                'status' => 'success',
                'data' => $name.' Deleted Successfully',
            ];
        } else {
            return [
                'status' => 'error',
                'data' => 'Something went wrong',
            ];
        }
    }
}