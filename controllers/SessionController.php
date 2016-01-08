<?php
namespace controllers;


class SessionController
{
    public function __construct() {
        session_start();
        $_SESSION['errors'] = array();
    }
    public static function exists() {
        if(isset($_SESSION)) return true;
        else return false;
    }
    public static function startGuestSession() {
        session_name("guest");
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