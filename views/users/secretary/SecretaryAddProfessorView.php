<link rel="stylesheet" href="views/css/input-boxes.css">
<link rel="stylesheet" href="views/css/AdminButton.css">
<link rel="stylesheet" href="views/css/AddUniversity.css">
<form action=""  method="post">
    <input type="text" name="professorUsername"  class="smallBox topBorder" placeholder="Professor username">
    <input type="password" name="professorPassword"  class="smallBox topBorder" placeholder="Professor password">
    <input type="submit"  name="addProfessor" class="button" value="Add a Professor">
</form>
<?php
if (((!isset($_POST["professorUsername"])) or empty($_POST['professorUsername'])) or ((!isset($_POST["professorPassword"])) or empty($_POST['professorPassword']))  ) {
    $_POST["professorUsername"] = "u";
    $_POST["professorPassword"] = "p";
    exit();
} else {
    $_SESSION['professorUsername'] = $_POST["professorUsername"];
    $_SESSION['professorPassword'] = $_POST["professorPassword"];
    unset($_POST);
    $this->addProfessor();
    header("Refresh:0");

}
?>