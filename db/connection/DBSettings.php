<?php
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