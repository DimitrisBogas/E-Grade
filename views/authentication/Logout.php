<?php

include_once(__DIR__.'../../Redirect.php');
if($_GET) {
    if($_GET['c'] == "go_home") {
        unset($_POST);
        unset($GET);
        Redirect::toHome();

    }
    if($_GET['c'] == "logout") {
        $this->authenticationController->logout();
        unset($_POST);
        unset($GET);
        Redirect::toHome();
    }


}