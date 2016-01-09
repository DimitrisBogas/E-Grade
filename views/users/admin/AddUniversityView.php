<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AdminButton.css">
<link rel="stylesheet" href="views/css/AddUniversity.css">
<form action=""  method="post">
    <input type="text" name="uni"  class="universityName topBorder" placeholder="University Name">
    <input type="submit"  name="addUniversity" class="button" value="Add a University">
</form>
<?php
    if ((!isset($_POST["uni"])) or empty($_POST['uni'])) {
        $_POST["uni"] = "i";
      //  if
        exit();
    } else {
        $_SESSION['universityName'] = $_POST['uni'];
        unset($_POST);
        $this->saveFormData();
        ob_start();
        header("Refresh:0");
        ob_end_flush();
    }
?>