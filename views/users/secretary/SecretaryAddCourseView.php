<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AdminButton.css">
<link rel="stylesheet" href="views/css/AddUniversity.css">
<form action=""  method="post">
    <input type="text" name="courseName"  class="universityName topBorder" placeholder="Course Name">
    <input type="submit"  name="addCourse" class="button" value="Add a Course">
</form>

<?php
if ((!isset($_POST["courseName"])) or empty($_POST['courseName'])) {
    $_POST["courseName"] = "i";
    exit();
} else {
    $_SESSION['courseName'] = $_POST['courseName'];
    unset($_POST);
    $this->addCourse();
    ob_start();
    header("Refresh:0");
    ob_end_flush();
}
?>