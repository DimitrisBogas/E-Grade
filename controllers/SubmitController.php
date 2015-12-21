<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/12/2015
 * Time: 7:51 πμ
 */



class SubmitController
{
    private $username;
    private $password;
    private $authenticationController;

    public function __construct()
    {
        $authenticationController = new \controllers\AuthenticationController();
    }

    public function readCredentials()
    {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $this->username = $_POST["username"];
            $this->password = $_POST["password"];
            if ($this->authenticationController->login($this->username, $this->password)) {
                if (isset($_SESSION["1"])) {
                    session_start();
                    header("Location:index.php");
                }

            } else echo "error ";
            echo $this->username;
            echo $this->password;
        }

    }
}
function readCredentials()
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username;
    echo $password ;
    header("Location:index.php");
}
