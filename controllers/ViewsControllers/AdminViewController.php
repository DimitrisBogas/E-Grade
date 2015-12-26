<?php

include('MainPanelView.php');

    function invokeAdminView($page = null) {
        include 'views/template/top-bar.php';
        if (isset($page)) {
            if($page == "addUniversity") invokeMainPanel('views/users/admin/AddUniversityView.php');
            if($page == "home") invokeMainPanel('views/users/adminAdminPanelView.php');
        } else invokeMainPanel('views/users/admin/AdminPanelView.php');
        include ('views/authentication/Logout.php');
    }






