<link rel="stylesheet" href="views/css/top-menu.css">
<div id='cssmenu'>
    <ul>
        <li class='active' style="">
            <li><a href='?c=go_home'><span>Home</span></a></li>
            <?php if(session_name() == UserTypes::administrator()) {
                echo "<li><a id='cssmenu' href='#'><span>Users</span></a></li>";

            }

            ?>

        <li  style="float: right;"><a href='?c=logout'> <?php echo $_SESSION['username'] ?>  &nbsp; &nbsp; Logout<span></span></a></li>
    </ul>
</div>