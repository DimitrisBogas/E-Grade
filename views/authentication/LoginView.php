<link rel="stylesheet" href="views/css/login.css">
<script type="text/javascript">
    $(function(){
        $(".alert-message").delegate("a.close", "click", function(event) {
            event.preventDefault();
            $(this).closest(".alert-message").fadeOut(function(event){
                $(this).remove();
            });
        });
    });
</script>

    <div class="login-card">
        <?php
            include (__DIR__.'../../template/alert-box.php');
        ?>
        <h1> E-Grade Log-in</h1><br>
        <form action=""  method="post">
            Username:<input type="text" name="username" id="username"  placeholder="Username"><br>
            Password:<input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="submit"  name="login" class="login login-submit" value="Sign In">
        </form>
        <?php
        echo "Session id: " . session_id() . "</br>". " Session name:" . session_name() . "</br>";
        if(isset($_SESSION['username']) && isset($_SESSION['password'])) echo  "Session: username: " . $_SESSION['username'] . "</br>" ." Session Password: ". $_SESSION['password'];

        ?>
    </div>
<?php
if (!((isset($_POST['username']) && isset($_POST['password'])))) {
    $_POST['username'] = "u";
    $_POST['password'] = "p";
} else {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    //unserialize($_POST);
    include(__DIR__.'../../Redirect.php');
    Redirect::toHome();
}

?>