<?php

include_once('/../db/orm/QueryBuilder/UserQueryBuilder.php');
include_once('/../db/orm/QueryBuilder/InstitutionQueryBuilder.php');
include_once('/../db/orm/DBConnection.php');

class PersistenceController
{
    private $dBConnection;
    private $userQueryBuilder;
    private $institutionQueryBuilder;
    public function __construct() {
        $this->dBConnection = new DBConnection();
        $this->userQueryBuilder = new \UserQueryBuilder();
        $u = new \UserQueryBuilder();
        $this->institutionQueryBuilder = new InstitutionQueryBuilder();
    }
    public function retrieveUser($username, $password) {
        return(mysql_fetch_assoc($this->dBConnection->query($this->userQueryBuilder->login($username, $password))));
    }

    public function saveUniversity($universityName) {
        if ($this->dBConnection->query($this->institutionQueryBuilder->createUniversity($universityName))) return true;
        else return false;
    }

    public function saveDepartment($universityId, $departmentName, $secretariatUsername, $secretariatPassword) {
        if ($this->dBConnection->query($this->institutionQueryBuilder->createDepartment($universityId,$departmentName)) && $this->dBConnection->query($this->userQueryBuilder->createSecretariat($secretariatUsername,$secretariatPassword, $universityId)) ) return true;
        else return false;
    }

    public function saveStudent($username, $password, $departmentId) {
        if ($this->dBConnection->query($this->userQueryBuilder->createStudent($username, $password, $departmentId))) return true;
        else return false;
    }

    public function saveProfessor($username, $password, $departmentId) {
        if ($this->dBConnection->query($this->userQueryBuilder->createProfessor($username, $password, $departmentId))) return true;
        else return false;

    }
    public function  saveCourse($courseName) {
        if ($this->dBConnection->query($this->institutionQueryBuilder->createCourse($courseName))) return true;
        else return false;
    }
    public function getAllUniversities() {
        return $this->dBConnection->query($this->institutionQueryBuilder->getAllUniversities());
    }
    public function getAllDepartmentStudents($departmentId) {
        return $this->dBConnection->query($this->userQueryBuilder->selectAllDepartmentStudents($departmentId));

    }


}