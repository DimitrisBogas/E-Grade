<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/12/2015
 * Time: 6:06 πμ
 */


include('AuthenticationController.php') ;

class ViewsController
{
    private $authenticationController;

    public function __construct()  {
        $this->authenticationController = new \controllers\AuthenticationController();
    }

    public function invoke() {
        if(session_name() == "guest") {
           // $this->authenticationController->logoutUser();
            include 'views/login.php';
            echo "</br>" .session_id() . " " . session_name() . "</br>";

            echo  $_SESSION['username'] . "   ". $_SESSION['password'];

        } else if (session_name() == UserTypes::student() && $this->authenticationController->isValidUser()) {
            include 'views/StudentView.php';
        }

    }
    public function invokeRedirect() {
        include 'views/Redirect.php';

    }


}