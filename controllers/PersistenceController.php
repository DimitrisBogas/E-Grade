<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/12/2015
 * Time: 9:10 πμ
 */

namespace controllers;

use db\orm\QueryBuilder\InstitutionQueryBuilder;

include_once('db/orm/QueryBuilder/UserQueryBuilder.php');
include_once('db/orm/QueryBuilder/InstitutionQueryBuilder.php');
include_once(__DIR__.'../../db/orm/DBConnection.php');

class PersistenceController
{
    private $dBConnection;
    private $userQueryBuilder;
    private $institutionQueryBuilder;
    public function __construct() {
        $this->dBConnection = new \DBConnection();
        $this->userQueryBuilder = new \UserQueryBuilder();
        $this->institutionQueryBuilder = new InstitutionQueryBuilder();
    }
    public function retrieveUser($username, $password) {
        return(mysql_fetch_assoc($this->dBConnection->query($this->userQueryBuilder->login($username, $password))));
    }

    public function saveUniversity($universityName) {
        $this->institutionQueryBuilder->createUniversity($universityName);
    }


}