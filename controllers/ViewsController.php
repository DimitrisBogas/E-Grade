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
    private $sessionController;
    public function __construct()  {
        $this->authenticationController = new \controllers\AuthenticationController();
    }

    public function invoke() {
        if(session_name() == "guest") {
            include 'views/login.php';
            echo session_id() . " " . session_name() ;
            if ($this->authenticationController->isValidUser($_SESSION['username'],$_SESSION['password'])) {
                echo "Welcome user";
                $this->sessionController = new \controllers\SessionController(UserTypes::student());
                \controllers\SessionController::closeSession("guest");
                $_SERVER['QUERY_STRING'] = "&=" . UserTypes::student();
                \controllers\SessionController::startStudentSession(UserTypes::student());
                header( "refresh:5;url=index.php". $_SERVER['QUERY_STRING'] );

            }
            echo $_SESSION['password'];
        } else if ($this->authenticationController->isValidUser($_SESSION['username'],$_SESSION['password'])) {

            echo "Welcome student !";

        }
    }
    public function invokeRedirect() {
        include 'views/Redirect.php';

    }


}