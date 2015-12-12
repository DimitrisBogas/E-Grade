<?php
include 'orm/QueryBuilder/UserTypes.php';

class UserQueryBuilder {
    private  $userType;
    private $dbName;
    public function __construct() {
        $db = new DBSettings();
        $dbSettings = $db->getDbSettings();
        $this->dbName = $dbSettings->dbName;
        $this->userType = new UserTypes();
    }
    public function createSecretariat($user, $password) {
     $userType = $this->userType->secretariat();
        return ("INSERT INTO $this->dbName.users (username, password, usertype) VALUES ('$user', '$password', '$userType')");
    }

    public function createStudent ($user, $password) {
     $userType = $this->userType->student();
        return ("INSERT INTO $this->dbName.users (username, password, usertype) VALUES ('$user', '$password', '$userType')");
    }

     public function createProfessor ($user, $password) {
     $userType = $this->userType->professor();
         return ("INSERT INTO $this->dbName.users (username, password, usertype) VALUES ('$user', '$password', '$userType')");
    }

    public function createAdministrator ($user, $password) {
     $userType = $this->userType->administrator();
        return ("INSERT INTO $this->dbName.users (username, password, usertype) VALUES ('$user', '$password', '$userType')");
    }
 
    public function showUsers() {
        return("select * from users");
    }
    }