<?php

include_once('/../AuthenticationController.php');
include_once('/../PersistenceController.php');

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
            if ($command == "add_student") {
                self::invokeUserView("addStudent", UserTypes::secretariat());
                unset($_SESSION['command']);
            }
            else if ($command == "add_professor") {
                self::invokeUserView("addProfessor", UserTypes::secretariat());
                unset($_SESSION['command']);
            }
            else self::invokeUserView("home", UserTypes::secretariat());
        } else if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
            if(isset($command)){
                if($command == "add_university") {
                    self::invokeUserView("addUniversity", UserTypes::administrator());
                    unset($_SESSION['command']);
                } else if ($command == "add_department") {
                    self::invokeUserView("addDepartment", UserTypes::administrator());
                    unset($_SESSION['command']);
                }
            } else {
                if(isset($_SESSION['command']))unset($_SESSION['command']);
                self::invokeUserView("home", UserTypes::administrator());
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
        include('views/authentication/Logout.php');
        self::showMainPanelHeader();
        if(isset($file)) include_once($file);
        self::showMainPanelFooter();
    }

    private function invokeUserView($page = null, $userType) {
        include 'views/template/top-bar.php';
        if (isset($page)) {
            if($userType ==  UserTypes::administrator()) self::invokeAdminPages($page);
            if($userType == UserTypes::secretariat()) self::invokeSecretaryPages($page);
        } else self::invokeMainPanel('views/users/admin/AdminPanelView.php');

    }
    private function invokeSecretaryPages($page) {
        if($page == "addStudent") self::invokeMainPanel('views/users/secretary/SecretaryAddStudentView.php');
        if($page == "addProfessor") self::invokeMainPanel('views/users/secretary/SecretaryAddProfessorView.php');
        if($page == "home") self::invokeMainPanel('views/users/secretary/SecretaryPanelView.php');

    }
    private function invokeAdminPages($page) {
        if($page == "addUniversity") self::invokeMainPanel('views/users/admin/AddUniversityView.php');
        if($page == "addDepartment") self::invokeMainPanel('views/users/admin/AddDepartmentView.php');
        if($page == "home") self::invokeMainPanel('views/users/admin/AdminPanelView.php');
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
    public  function addStudent() {
        if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
            $this->persistenceController->saveStudent("usr", "pwd", "1");
            if($this->persistenceController->saveStudent($_SESSION['studentUsername'], $_SESSION['studentPassword'], $this->authenticationController->getUsersDepartmentId())) {
                unset($_SESSION['studentUsername']);
                unset($_SESSION['studentPassword']);
            }
        }
    }
    public function addProfessor() {
        if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
            if($this->persistenceController->saveProfessor($_SESSION['professorUsername'], $_SESSION['professorPassword'], $this->authenticationController->getUsersDepartmentId())) {
                unset($_SESSION['professorUsername']);
                unset($_SESSION['professorPassword']);
            }
        }
    }
    public function showAllUniversities() {
        return $this->persistenceController->getAllUniversities();
    }
    public function getUsersDepartmentId() {
        return $this->authenticationController->getUsersDepartmentId();
    }
}