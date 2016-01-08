<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AddDepartment.css">

<?php
$students = $this->showAllDepartmentStudents($this->getUsersDepartmentId());
$courses = $this->showAllCourses();
?>
<form action=""  method="post">
    <select name="userId" class="universityName topBorder">
        <?php
        while ($student = mysql_fetch_assoc($students)) {
            echo "<option value=' " . $student['userId'] . "'> " . $student['username'] . "</option>";
        }
        ?>
    </select>
    <select name="courseId" class="universityName topBorder">
        <?php
        while ($course = mysql_fetch_assoc($courses)) {
            echo "<option value=' " . $course['courseId'] . "'> " . $course['courseName'] . "</option>";
        }
        ?>
    </select>
    <input type="text" name="studentGrade"  class="universityName topBorder" placeholder="Student Grade">
    <input type="submit"  name="addUDepartment" class="button" value="Add a Department">
</form>

<?php

if (((!isset($_POST["userId"])) or empty($_POST['userId'])) or ((!isset($_POST["courseId"])) or empty($_POST['courseId']))  or ((!isset($_POST["studentGrade"])) or empty($_POST['studentGrade']))  ) {
    $_POST["userId"] = "1";
    $_POST["courseId"] = "1";
    $_POST['studentGrade'] = "5";
    exit();
} else {
    $studentGrade = str_replace(array('.', ','), array('.', '.'), $_POST['studentGrade']);
    if ( in_array( $_POST['studentGrade'] , range( "0" , "10" ) ) ) {
        $_SESSION['userId'] = $_POST['userId'];
        $_SESSION['courseId'] = $_POST["courseId"];
        $_SESSION['studentGrade'] = $studentGrade;
        unset($_POST);
        $this->addGrade();
        header("Refresh:0");
    } else exit();
}



?>