<?php
class Redirect {
    public static function toHome()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        //header("Location: http://{$_SERVER['SERVER_NAME']}/");
        die();
    }
}

