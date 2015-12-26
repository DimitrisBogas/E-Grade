<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/12/2015
 * Time: 6:06 πμ
 */


include(__DIR__.'../../AuthenticationController.php');
include('AdminViewController.php');
class ViewsController
{
    private $authenticationController;

    public function __construct()  {
        $this->authenticationController = new \controllers\AuthenticationController();

    }

    public function invoke($command = null) {
        if(session_name() == "guest" or session_name() == "PHPSESSID") {
            include 'views/authentication/LoginView.php';
        } else if (session_name() == UserTypes::student() && $this->authenticationController->isValidUser(UserTypes::student())) {
            include 'views/users/student/StudentView.php';
        } else if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
            include 'views/users/secretary/SecretaryView.php';
        } else if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
            if(isset($command)){
                if($command == "add_university") {
                    invokeAdminView("addUniversity");
                    unset($_SESSION['command']);
                } else if ($command == "add_department") {
                    invokeAdminView("addUniversity");
                    unset($_SESSION['command']);
                }

            } else invokeAdminView();

        }
    }

}