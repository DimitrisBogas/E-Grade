<?php
class Redirect {
    public static function toHome()
    {
        header("Location: http://{$_SERVER['SERVER_NAME']}/");
        die();
    }
}

