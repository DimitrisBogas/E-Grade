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
                self::invokeStudentView();
        } else if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
                self::invokeSecretariatView($command);
        }   if (session_name() == UserTypes::professor() && $this->authenticationController->isValidUser(UserTypes::professor())) {
            self::invokeProfessorView($command);
        } else if (session_name() == UserTypes::administrator() && $this->authenticationController->isValidUser(UserTypes::administrator())) {
                self::invokeAdministratorView($command);
        }
    }
    public function setMaximumUploadFileSize() {
        ini_set('upload_max_filesize', '25M');
        ini_set('post_max_size', '25M');
    }
    private function invokeStudentView() {
        self::invokeUserView("s", UserTypes::student());
    }
    private function invokeProfessorView($command) {
        if($command) {
            if ($command == "add_grade") {
                self::invokeUserView("addGrade", UserTypes::professor());
                unset($_SESSION['command']);
            }
        } else {
            self::invokeUserView("home", UserTypes::professor());
            unset($_SESSION['command']);
        }
    }
    private function invokeStudentPage() {
        self::invokeMainPanel('views/users/student/StudentPanelView.php');
    }
    private function invokeSecretariatView($command) {
        if ($command == "add_student") {
            self::invokeUserView("addStudent", UserTypes::secretariat());
            unset($_SESSION['command']);
        }
        else if ($command == "add_professor") {
            self::invokeUserView("addProfessor", UserTypes::secretariat());
            unset($_SESSION['command']);
        } else if ($command == "add_course") {
            self::invokeUserView("addCourse", UserTypes::secretariat());
            unset($_SESSION['command']);
        } else self::invokeUserView("home", UserTypes::secretariat());
    }
    private function invokeAdministratorView($command) {
        if(isset($command)){
            if($command == "go_home") {
                self::invokeHome('go_home');
            }
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
    private function invokeHome() {
            unset($_POST);
            unset($GET);
            self::invoke('go_home');
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
            if($userType == UserTypes::professor()) self::invokeProfessorPage($page);
            if($userType == UserTypes::student()) self::invokeStudentPage();

        } else self::invokeMainPanel('views/users/admin/AdminPanelView.php');
    }
    private function invokeProfessorPage($page) {
        if($page == "home") self::invokeMainPanel('views/users/professor/ProfessorPanelView.php');
        if($page == "addGrade") self::invokeMainPanel('views/users/professor/ProfessorAddGradeView.php');
    }
    private function invokeSecretaryPages($page) {
        if($page == "addStudent") self::invokeMainPanel('views/users/secretary/SecretaryAddStudentView.php');
        if($page == "addProfessor") self::invokeMainPanel('views/users/secretary/SecretaryAddProfessorView.php');
        if($page == "addCourse") self::invokeMainPanel('views/users/secretary/SecretaryAddCourseView.php');
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
    public function addCourse () {
        if (session_name() == UserTypes::secretariat() && $this->authenticationController->isValidUser(UserTypes::secretariat())) {
            if($this->persistenceController->saveCourse($_SESSION['courseName'])) {
                unset($_SESSION['courseName']);
            }
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
    public function addGrade() {
        if (session_name() == UserTypes::professor() && $this->authenticationController->isValidUser(UserTypes::professor())) {
            if($this->persistenceController->saveGrade($_SESSION['userId'], $_SESSION['courseId'], $_SESSION['studentGrade'])) {
                unset($_SESSION['userId']);
                unset($_SESSION['courseId']);
                unset($_SESSION['studentGrade']);
            }
        }
    }
    public function showAllDepartmentStudents($departmentId) {
        return $this->persistenceController->getAllDepartmentStudents($departmentId);
    }
    public function showAllCourses() {
        return $this->persistenceController->getAllCourses();
    }
    public function showAllUniversities() {
        return $this->persistenceController->getAllUniversities();
    }
    public function getUsersDepartmentId() {
        return $this->authenticationController->getUsersDepartmentId();
    }
    public function showAllStudentGrades() {
        return $this->persistenceController->getAllGrades(self::getUserId());
    }
    public function getUserId() {
        return $this->authenticationController->getUserId();
    }
}