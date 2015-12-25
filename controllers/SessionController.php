<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/12/2015
 * Time: 9:51 πμ
 */


namespace controllers;


class SessionController
{
    public function __construct() {
        session_start();
        if (session_name() == "guest") {
            $_SESSION['username'] = "u";
            $_SESSION['password'] = "p";
        }
/*        if ($userType =="") self::startGuestSession();
        else {
            if($userType == \UserTypes::student())
                self::startGuestSession();
        }*/
    }
    public static function exists() {
        if(isset($_SESSION)) return true;
        else return false;
    }
    public static function startGuestSession() {
        session_name("guest");
        $_SESSION['username'] = "u";
        $_SESSION['password'] = "p";
    }
    public static function startStudentSession() {
        session_name(\UserTypes::student());
    }
    public static function startSecretariatSession() {
        session_name(\UserTypes::secretariat());
    }
    public static function startAdministratorSession() {
        session_name(\UserTypes::administrator());
    }
    public function  closeGuestSession() {
        session_unset($_SESSION);
     //   session_destroy();
     //   session_write_close();
    }
    public function closeUserSession() {
        session_unset($_SESSION);
       // session_destroy();

    }

}