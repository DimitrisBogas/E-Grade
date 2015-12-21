<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14/12/2015
 * Time: 5:03 πμ
 */

namespace controllers;

use UserQueryBuilder;

include ('db/orm/QueryBuilder/UserQueryBuilder.php');

class AuthenticationController
{
    private $userQueryBuilder;
    private $username;
    private $password;
    public function __construct() {
        $this->userQueryBuilder = new UserQueryBuilder();
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'getUserCredentials':
                    $this->getUserCredentials();
                    break;
            }
        }

    }
    public function clickFunction(){
        $array = array(
        'status'  => '1');
        return $array;
    }
    public function getUserCredentials(){
        if (isset($_POST["username"]) && isset($_POST["password"]) ) {
            $this->username = $_POST["username"];
            $this->password = $_POST["password"];
            echo "username: " . $this->username . "</br>" . "password: " . $this->password;

        }
        else echo "error ";

    }
    public function login($username, $password) {
        if ($username == "user" && $password == "user") return true;
        else return false;

    }
    public static function isValidUser($username, $password) {
        if($username == "user" && $password =="user")
        return true;

    }
    public static function check() {
        if(isset($_SESSION)) return true;
        else return false;

    }


}