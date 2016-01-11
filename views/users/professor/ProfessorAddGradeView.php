<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AddDepartment.css">
<?php
$this->setMaximumUploadFileSize();
$students = $this->showAllDepartmentStudents($this->getUsersDepartmentId());
$courses = $this->showAllCourses();
?>
<form action=""  method="post" enctype='multipart/form-data'>
    <select name="userId" class="smallBox topBorder">
        <option value="">Select student</option>
        <?php
        while ($student = mysql_fetch_assoc($students)) {
            echo "<option value=' " . $student['userId'] . "'> " . $student['username'] . "</option>";
        }
        ?>
    </select>
    <select name="courseId" class="smallBox topBorder center">
        <option value="">Select course</option>
        <?php
        while ($course = mysql_fetch_assoc($courses)) {
            echo "<option value=' " . $course['courseId'] . "'> " . $course['courseName'] . "</option>";
        }
        ?>
    </select>
    <input type="text" name="studentGrade"  class="smallBox topBorder center" placeholder="Student Grade">
    <div class="fileUpload topBorder" >Upload exam paper<input type="file" name="examPaper"   class="fileUpload" /></div>
    <input type="submit"  name="addGrade" class="button" value="Grade a Student">
</form>

<?php
if (((!isset($_POST["userId"])) or empty($_POST['userId'])) or ((!isset($_POST["courseId"])) or empty($_POST['courseId']))  or ((!isset($_POST["studentGrade"])) or empty($_POST['studentGrade']))    ) {
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
        if(is_uploaded_file($_FILES["examPaper"]['tmp_name'])) {
            $_SESSION['file-data'] = $_FILES;
            move_uploaded_file($_SESSION['file-data']["examPaper"]['tmp_name'], 'exam-papers/'."ExamPaper-StudentId" . $_SESSION['userId'] . "-" . "CourseId" .  $_SESSION['courseId'] . ".". (new SplFileInfo($_FILES['examPaper']['name']))->getExtension() );
        } else unset($_FILES["examPaper"]);
        unset($_POST);
        unset($_FILES);
        $this->addGrade();
        header("Refresh:0");
    } else exit();
}
?>