<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14/12/2015
 * Time: 5:03 πμ
 */

namespace controllers;

use UserQueryBuilder;

include_once('SessionController.php');
include ('db/orm/QueryBuilder/UserQueryBuilder.php');
include_once(__DIR__.'../../db/orm/DBConnection.php');

class AuthenticationController
{
    private $userQueryBuilder;
    private $dBConnection;
    private $sessionController;
    public function __construct() {
        $this->userQueryBuilder = new UserQueryBuilder();
        $this->sessionController = new SessionController();
        $this->dBConnection = new \DBConnection();
        if (( isset($_SESSION['username']) && isset($_SESSION['password'])  )) {
                if(self::isValidUser())  {
                    $this->sessionController->startStudentSession();
                    $result = $this->userQueryBuilder->login($_SESSION['username'], $_SESSION['password']);
                    $result = $this->dBConnection->query($result);
                } else $this->sessionController->startGuestSession();

        } else $this->sessionController->startGuestSession();
    }
    public function isValidUser() {
        $row = mysql_fetch_assoc($this->dBConnection->query($this->userQueryBuilder->login($_SESSION['username'], $_SESSION['password'])));
        if(  ($row['username']==$_SESSION['username'] && $row['password'] == $_SESSION['password'] )  ) return true;
        else return false;
    }


}