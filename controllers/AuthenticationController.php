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
                    self::setSessionType();
                    $result = $this->userQueryBuilder->login($_SESSION['username'], $_SESSION['password']);
                    $result = $this->dBConnection->query($result);
                } else $this->sessionController->startGuestSession();

        } else $this->sessionController->startGuestSession();
    }
    public function isValidUser($userType = NULL) {
        if (empty($userType)) $userType = null;
        $user = self::retrieveUserFromPersistence();
        if (empty($userType)) {
            if (($user['username'] == $_SESSION['username'] && $user['password'] == $_SESSION['password'])) return true;
            else return false;
        }
        else if (!empty($userType)) {
            if (($user['username']==$_SESSION['username'] && $user['password'] == $_SESSION['password'] && $userType == $user['userType'] )) return true;
            else return false;
        }
        }
    private function retrieveUserFromPersistence() {
        return(mysql_fetch_assoc($this->dBConnection->query($this->userQueryBuilder->login($_SESSION['username'], $_SESSION['password']))));
    }
    private function setSessionType() {
        $user = self::retrieveUserFromPersistence();
        if($user['userType'] == \UserTypes::student()) $this->sessionController->startStudentSession();
        if($user['userType'] == \UserTypes::secretariat()) $this->sessionController->startSecretariatSession();
    }


}