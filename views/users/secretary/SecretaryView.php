<link rel="stylesheet" href="../../css/top-menu.css">
<div id='cssmenu'>
    <ul>
        <li class='active' style="">
            <a href='#'><span>Departments</span></a></li>
        <li><a href='#'><span>Universities</span></a></li>
        <li  style="float: right;"><a href='?c=logout'>Logout<span></span></a></li>
    </ul>
</div>

<?php

echo " </br> Welcome ....";

$this->authenticationController->display();

include 'Logout.php';
?>