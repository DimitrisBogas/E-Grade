<?php
include'views/template/header.php';

include_once(__DIR__.'/controllers/ViewsController.php');

$viewsController = new ViewsController();
$viewsController->invoke();

include 'views/template/footer.php';
?>
