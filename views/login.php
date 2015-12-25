<?php
echo "E-Grade Project User Login<br>";


?>
<script type="text/javascript"></script>
<form action=""  method="post">
    Username:<input type="text" name="username" id="username" ><br>
    Password:<input type="password" name="password" id="password"><br>
    <br>
    <input type="submit"  class="button" name="login" value="Sign In" >
</form>

<?php
if (!((isset($_POST['username']) && isset($_POST['password'])))) {
    $_POST['username'] = "u";
    $_POST['password'] = "p";
} else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
}

?>