<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AddDepartment.css">

<?php
$universities = $this->showAllUniversities();
?>



<form action=""  method="post">

    <select name="universityId" class="universityName topBorder">
        <?php
        while ($university = mysql_fetch_assoc($universities)) {
            echo "<option value=' " . $university['universityId'] . "'> " . $university['universityName'] . "</option>";
        }
        ?>
    </select>
    <input type="text" name="departmentName"  class="universityName topBorder" placeholder="Department Name">
    <input type="text" name="secretariatUsername"  class="smallBox topBorder" placeholder=" Secretariat username">
    <input type="text" name="secretariatPassword"  class="smallBox topBorder" placeholder=" Secretariat password">
    <input type="submit"  name="addUDepartment" class="button" value="Add a Department">
</form>

<?php

if (((!isset($_POST["universityId"])) or empty($_POST['universityId'])) or ((!isset($_POST["departmentName"])) or empty($_POST['departmentName']))  or ((!isset($_POST["secretariatUsername"])) or empty($_POST['secretariatUsername'])) or ((!isset($_POST["secretariatPassword"])) or empty($_POST['secretariatPassword'])) ) {
    $_POST["universityId"] = "1";
    $_POST["departmentName"] = "i";
    $_POST['secretariatUsername'] = "u";
    $_POST['secretariatPassword'] = "p";
    exit();
} else {
    $_SESSION['universityId'] = $_POST['universityId'];
    $_SESSION['departmentName'] = $_POST["departmentName"];
    $_SESSION['secretariatUsername'] = $_POST['secretariatUsername'];
    $_SESSION['secretariatPassword'] = $_POST['secretariatPassword'];
    echo $_SESSION['secretariatUsername'] . $_SESSION['secretariatPassword'];
    unset($_POST);

    $this->addDepartment();

    header("Refresh:0");

}



?>