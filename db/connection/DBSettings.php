<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/12/2015
 * Time: 5:29 μμ
 */

class DBSettings {
    private $file = 'db/connection/properties.json';
    private $dbProperties;

    public function __construct() {
        $this->setDbSettings();
    }
    public function setDbSettings()
    {
        if(file_exists($this->file)) {
            $this->dbProperties = json_decode(file_get_contents($this->file));
        }
    }
    public function  getDbSettings() {
        return $this->dbProperties;
    }
}