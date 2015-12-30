<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/12/2015
 * Time: 3:29 μμ
 */

namespace db\orm\QueryBuilder;

include_once'db/connection/DBSettings.php';

class InstitutionQueryBuilder
{
    private $dbName;
    public function __construct() {
        $db = new DBSettings();
        $dbSettings = $db->getDbSettings();
        $this->dbName = $dbSettings->dbName;
    }
    public function createUniversity($universityName) {
        return ("INSERT INTO $this->dbName.departments (id, departmentName) VALUES ('$universityName'". ")");
    }
    public function createDepartment() {

    }

}