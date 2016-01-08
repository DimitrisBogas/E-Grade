<?php
include_once'db/connection/DBSettings.php';

class UserQueryBuilder {
    private $dbName;
    public function __construct() {
        $db = new DBSettings();
        $dbSettings = $db->getDbSettings();
        $this->dbName = $dbSettings->dbName;
    }
    public function createSecretariat($username, $password, $departmentId) {
        return ("INSERT INTO $this->dbName.user (username, password, usertype, departments_departmentId) VALUES ('$username', '$password'," . "'". UserTypes::secretariat() . "'". ", '$departmentId')");
    }

    public function createStudent ($username, $password, $departmentId) {
        return ("INSERT INTO $this->dbName.user (username, password, usertype, departments_departmentId) VALUES ('$username', '$password'," . "'". UserTypes::student() . "'"  .", '$departmentId')");
    }

     public function createProfessor ($user, $password, $departmentId) {
         return ("INSERT INTO $this->dbName.user  (username, password, usertype, departments_departmentId) VALUES ('$user', '$password'," . "'". UserTypes::professor() . "'".", '$departmentId')");
    }

    public function createAdministrator ($user, $password) {
        return ("INSERT INTO $this->dbName.user (username, password, usertype) VALUES ('$user', '$password'," . "'". UserTypes::administrator() . "'". ")");
    }
 
    public function selectAllUsers() {
        return("select * from  $this->dbName.users");
    }

    public function login($username, $password)
    {
        return("SELECT * from $this->dbName.user  where username like '$username' AND password like '$password' ");
    }


}