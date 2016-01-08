<link rel="stylesheet" href="views/css/AdminButton.css">
<input type="submit"  name="addStudent" class="smallButton" value="Add a Student" onclick="location.href='?c=add_student'"> </br>
<input type="submit"  name="addProfessor" class="smallButton" value="Add a Professor" onclick="location.href='?c=add_professor'">
<input type="submit"  name="addCourse" class="smallButton" value="Add a Course" onclick="location.href='?c=add_course'">
<?php
include_once(__DIR__.'../../../Redirect.php');
if($_GET) {
    if($_GET['c'] == 'add_student') {
        $_SESSION['command'] = 'add_student';
        unset($GET);
        Redirect::toHome();
    } else if ($_GET['c'] == 'add_professor') {
        $_SESSION['command'] = 'add_professor';
        unset($GET);
        Redirect::toHome();
    } else if ($_GET['c'] == 'add_course') {
        $_SESSION['command'] = 'add_course';
        unset($GET);
        Redirect::toHome();
    }

}

?>