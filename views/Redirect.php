<?php
class Redirect {
    public static function toHome()
    {
        ob_start();
        header("Location: http://{$_SERVER['SERVER_NAME']}/");
        ob_end_flush();
        die();
    }
}

