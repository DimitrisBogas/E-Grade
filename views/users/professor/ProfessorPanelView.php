<link rel="stylesheet" href="views/css/AdminButton.css">
<input type="submit"  name="addGrade" class="button" value="Add a Grade" onclick="location.href='?c=add_grade'"> </br>
<?php
include_once(__DIR__.'../../../Redirect.php');
if($_GET) {
    if($_GET['c'] == 'add_grade') {
        $_SESSION['command'] = 'add_grade';
        unset($GET);
        Redirect::toHome();
    }
}

?>