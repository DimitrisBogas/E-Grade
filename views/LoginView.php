<link rel="stylesheet" href="css/login.css">
    <div class="login-card">
        <h1> E-Grade Log-in</h1><br>
        <form action=""  method="post">
            Username:<input type="text" name="username" id="username"  placeholder="Username"><br>
            Password:<input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="submit"  name="login" class="login login-submit" value="Sign In"  onclick="clearform();">
        </form>
        <?php
        echo "Session id: " . session_id() . "</br>". " Session name:" . session_name() . "</br>";
        echo  "Session: username: " . $_SESSION['username'] . "</br>" ." Session Password: ". $_SESSION['password'];

        ?>
    </div>
<?php
if (!((isset($_POST['username']) && isset($_POST['password'])))) {
    $_POST['username'] = "u";
    $_POST['password'] = "p";
} else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
}

?>