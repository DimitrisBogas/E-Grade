<?php
include_once '../db/connection/DBSettings.php';

class DBConnection {
    private $dbSettings;
    private $dbHandle;
    public function __construct() {
        $this->loadDBSettings();
        $this->connect();
    }
    private function loadDBSettings() {
        $db = new DBSettings();
        $this->dbSettings = $db->getDbSettings();
    }
    private function connect() {
        $this->dbHandle = mysql_connect($this->dbSettings->host,$this->dbSettings->username, $this->dbSettings->password);
    }
    public function query ($query) {
        mysql_select_db($this->dbSettings->dbName);
        $result = mysql_query($query);
        return $result;
    }
}