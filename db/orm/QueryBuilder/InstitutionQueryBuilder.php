<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/12/2015
 * Time: 3:29 μμ
 */

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
        return ("INSERT INTO $this->dbName.universities (name) VALUES ('$universityName')");
    }
    public function createDepartment() {

    }

}