<?php
echo "E-Grade Project User Login<br>";


?>
<script type="text/javascript"></script>
<form action=""  method="post">
    Username:<input type="text" name="username"><br>
    Password:<input type="password" name="password"><br>
    <br>
    <input type="submit"  class="button" name="login" value="Sign In">
</form>

<?php
if(!(isset($_POST['username'] ) )) {
    $_SESSION['username'] = "u";
    $_SESSION['password'] = "p";
} else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
}

?>