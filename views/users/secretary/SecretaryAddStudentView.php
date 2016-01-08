<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AdminButton.css">
<link rel="stylesheet" href="views/css/AddUniversity.css">
<form action=""  method="post">
    <input type="text" name="studentUsername"  class="smallBox topBorder" placeholder="Student username">
    <input type="password" name="studentPassword"  class="smallBox topBorder" placeholder="Student password">
    <input type="submit"  name="addStudent" class="button" value="Add a Student">
</form>
<?php
if (((!isset($_POST["studentUsername"])) or empty($_POST['studentUsername'])) or ((!isset($_POST["studentPassword"])) or empty($_POST['studentPassword']))  ) {
    $_POST["studentUsername"] = "u";
    $_POST["studentPassword"] = "p";
    exit();
} else {
    $_SESSION['studentUsername'] = $_POST["studentUsername"];
    $_SESSION['studentPassword'] = $_POST["studentPassword"];
    unset($_POST);
    $this->addStudent();

    header("Refresh:0");
   // Redirect::toHome();

}
?>