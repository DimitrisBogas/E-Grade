<?php
class UserQueryBuilder {
    private $dBName;
    public function __construct() {
        $db = new DBSettings();
        $dbSettings = $db->getDbSettings();
        $this->dBName= $dbSettings->dBName;
    }
    public function createSecretariat($user, $password, $usertype) {
     return ("INSERT INTO `$this->dBName`.`users` (`username`, `password`, `usertype`) VALUES ('$user', '$password', '$usertype')");
 }
    public function showusers() {
        return("select * from users");
    }
}