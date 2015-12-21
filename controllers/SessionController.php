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
    public function __construct($userType) {
        if ($userType =="") if(!self::exists()) self::startGuestSession();
        else {
            if($userType == \UserTypes::student())
                self::startGuestSession();
        }
    }
    public static function exists() {
        if(isset($_SESSION)) return true;
        else return false;
    }
    public static function startGuestSession() {
        session_name("guest");
        session_start();
    }
    public static function startStudentSession() {
        if(isset($_SESSION)) {
            session_destroy();
            session_name("student");
            session_start();
        }
    }
    public static function closeSession($user) {
        session_unset($_SESSION['$user']);
        session_destroy();

    }

}