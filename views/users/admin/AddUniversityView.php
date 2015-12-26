<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AdminButton.css">
<link rel="stylesheet" href="views/css/AddUniversity.css">
<form action=""  method="post">
<input type="text" name="universityName" id="universityName"  class="universityName topBorder" placeholder="University Name">
<input type="submit"  name="addUniversity" class="button" value="Add a University">
</form>
<?php

if (!(isset($_POST['universityName']))) {
    $_POST['universityName'] = "u";
} else {
    $_SESSION['universityName'] = $_POST['universityName'];
 //   include(__DIR__.'../../Redirect.php');
    Redirect::toHome();
}


?>