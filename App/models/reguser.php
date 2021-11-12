<?php

namespace App\models;

class RegUser extends \core\model {
    
    public static function insert() {
        $table = "users";

        try{
            if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register_btn']) && $_POST['register_btn'] == 'register_btn'){
                $user_email = $_POST["user_email"];
                $error=[];
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $error['user_email'] = "Not a valid Email";
                }
                $username = $_POST["username"];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$username) || trim($username) == "") {
                    $error['username'] = "Not a valid Username";
                }

                $password = $_POST["user_pwd"];
                if (!preg_match("/[a-zA-Z0-9]+/",$password)) {
                    $error['user_pwd'] = "Not a valid Password";
                }

                if(count($error) > 0){
                    return [
                        'status'=>'error',
                        'data'=>$error,
                    ];
                }

                $db = static::getDB();
                $sql = "SELECT * FROM $table WHERE email = '$user_email'";
                $result = mysqli_query($db, $sql);

                if(mysqli_num_rows($result) > 0){

                    return [
                            'status' => 'error',
                            'data' => array('register' => 'Account already exits.'),
                        ];

                } else {            

                    $sql = "INSERT INTO $table (`username` ,`email` ,`password`) VALUES ('$username', '$user_email', '$password')";
            
                    if(mysqli_query($db, $sql)){
                        $_SESSION['is_active'] = true;
                        $_SESSION['username'] = $username;
                        return $_SESSION;
                    } else {
                        return [
                            'status' => 'error',
                            'data' => array('register' => 'Account already exits.'),
                        ];
                    }
                }
            }
        } catch(Exception $e) {
            die( $e->getmessage() );
        }
    }

    public static function login() {
        $table = "users";
        try{
            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login_btn']) && $_POST['login_btn']='login_btn') {
                $user_email = $_POST["user_email"];
                $error = [];
                if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $error['user_email'] = "Not a valid Email";
                }
                
                $password = $_POST["user_pwd"];
                if (!preg_match("/[a-zA-Z0-9]+/",$password)) {
                    $error['user_pwd'] = "Not a valid Password";
                }

                if(count($error) > 0){
                    return [
                        'status'=>'error',
                        'data'=>$error
                    ];
                }

                $db = static::getDB();
                $sql = "SELECT * FROM $table WHERE email = '$user_email' AND password = '$password'";
                $result = mysqli_query($db, $sql);

                if(mysqli_num_rows($result) > 0) {
                    $results_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $_SESSION['is_active'] = true;
                    $_SESSION['username'] = $results_arr[0]['username'];
                    $_SESSION['id'] = $results_arr[0]['id'];
                    return [
                        'status' => 'success'
                    ];
                } else {
                    return [
                        'status'=>'error',
                        'data'=> array('login' => 'Invalid Login details'),
                    ];
                }
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}