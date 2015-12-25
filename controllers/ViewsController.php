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
            include 'views/LoginView.php';

        } else if (session_name() == UserTypes::student() && $this->authenticationController->isValidUser(UserTypes::student())) {
            include 'views/StudentView.php';
        } else if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
            include 'views/SecretaryView.php';
        } else if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
            include 'views/AdminView.php';
        }
    }

}