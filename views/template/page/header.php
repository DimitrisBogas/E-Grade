<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E-Grade</title>
    <link rel="shortcut icon" href="http://clipartbest.com/cliparts/nTE/XdM/nTEXdM7Gc.png"/>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="../../js/login.js" ></script>
    <link rel="stylesheet" href="views/css/index.css">
    <link rel="stylesheet" href="views/css/alert-box.css">
    <?php
        ob_start();
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        ob_flush();
    ?>

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
</head>
<body>
