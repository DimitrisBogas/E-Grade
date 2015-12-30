<link rel="stylesheet" href="views/css/AdminButton.css">
<a> <?php if(isset($_SESSION['universityName'])) echo $_SESSION['universityName'];

    if($_SESSION['e']) echo $_SESSION['e'];?> </a>
<input type="submit"  name="addUniversity" class="button" value="Add a University" onclick="location.href='?c=add_university'"> </br>
<input type="submit"  name="addDepartment" class="button" value="Add a Department" onclick="location.href='?c=add_department'">
<?php
include_once(__DIR__.'../../../Redirect.php');
if($_GET) {
    if($_GET['c'] == 'add_university') {
        $_SESSION['command'] = 'add_university';
        unset($GET);
        Redirect::toHome();
    } else if ($_GET['c'] == 'add_department') {
        $_SESSION['command'] = 'add_department';
        unset($GET);
        Redirect::toHome();
    }
}

?>