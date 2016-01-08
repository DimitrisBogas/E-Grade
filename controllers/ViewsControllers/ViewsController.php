<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/12/2015
 * Time: 6:06 πμ
 */


include_once(__DIR__.'../../AuthenticationController.php');
include_once(__DIR__.'../../PersistenceController.php');

class ViewsController
{
    private $authenticationController;
    private $persistenceController;
    public function __construct()  {
        $this->authenticationController = new \AuthenticationController();
        $this->persistenceController = new \PersistenceController();
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
                    self::invokeAdminView("addUniversity");
                    unset($_SESSION['command']);
                } else if ($command == "add_department") {
                    self::invokeAdminView("addDepartment");
                    unset($_SESSION['command']);
                }
            } else {
                if(isset($_SESSION['command']))unset($_SESSION['command']);
                self::invokeAdminView();
            }
        }
    }
    private function showMainPanelHeader() {
        echo "
                <link rel='stylesheet' href='views/css/main-panel.css'>
                <div class='panel-card'>
             ";
    }
    private function showMainPanelFooter() {
        echo "</div>";
    }
    private function invokeMainPanel($file = null) {
        self::showMainPanelHeader();
        if(isset($file)) include_once($file);
        self::showMainPanelFooter();
    }
    private function invokeAdminView($page = null) {
        include 'views/template/top-bar.php';
        if (isset($page)) {
            if($page == "addUniversity") self::invokeMainPanel('views/users/admin/AddUniversityView.php');
            if($page == "addDepartment") self::invokeMainPanel('views/users/admin/AddDepartmentView.php');
            if($page == "home") self::invokeMainPanel('views/users/admin/AdminPanelView.php');
        } else {
            self::invokeMainPanel('views/users/admin/AdminPanelView.php');
            include('views/authentication/Logout.php');
        }
    }
    public function saveFormData() {
        if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
            if($this->persistenceController->saveUniversity($_SESSION['universityName'])) unset($_SESSION['universityName']);
        }
    }
    public function addDepartment() {
        if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
            if($this->persistenceController->saveDepartment($_SESSION['universityId'], $_SESSION['departmentName'], $_SESSION['secretariatUsername'],$_SESSION['secretariatPassword'] )) {
                unset($_SESSION['universityId']);
                unset($_SESSION['departmentName']);
                unset($_SESSION['secretariatUsername']);
                unset($_SESSION['secretariatPassword']);
            }
        }
    }
    public function showAllUniversities() {
        return $this->persistenceController->getAllUniversities();
    }

}