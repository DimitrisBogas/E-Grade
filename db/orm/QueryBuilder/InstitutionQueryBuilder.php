<?php
//namespace db\orm\QueryBuilder;
//use namespace db\connection;

//include_once (__DIR__.'../../db/connection/DBSettings.php');

class InstitutionQueryBuilder
{
    private $dbName;
    public function __construct() {
      //  $d = new \DBSettings();
        $db = new \DBSettings();
        $dbSettings = $db->getDbSettings();
        $this->dbName = $dbSettings->dbName;
    }
    public function createUniversity($universityName) {
        return ("INSERT INTO $this->dbName.university (universityName) VALUES ('$universityName')");
    }
    public function createDepartment($universityId,  $departmentName) {
        return ("INSERT INTO $this->dbName.department (departmentName, universities_universityId) VALUES ('$departmentName', '$universityId')");
    }

    public function createCourse ($courseName) {
        return ("INSERT INTO $this->dbName.course (courseName) VALUES ('$courseName')");

    }
    public function  getAllUniversities() {
        return("select * from  $this->dbName.university");
    }

}