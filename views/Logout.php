<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/12/2015
 * Time: 8:51 μμ
 */
if($_GET) {
    if($_GET['c'] == "logout") {
        $this->authenticationController->logout();
    }
}
