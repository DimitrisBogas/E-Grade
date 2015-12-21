<?php
// include 'db/connection/DBSettings.php';
include'views/template/header.php';
include_once(__DIR__.'/controllers/SessionController.php');
include_once(__DIR__.'/controllers/ViewsController.php');

$sessionController = new \controllers\SessionController($_SERVER['QUERY_STRING']);
$viewsController = new ViewsController();
$viewsController->invoke();

include 'views/template/footer.php';
?>
