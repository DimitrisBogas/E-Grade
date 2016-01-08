<?php
include 'views/template/page/header.php';

include_once('/../controllers/ViewsControllers/ViewsController.php');

$viewsController = new ViewsController();
if(isset($_SESSION['command'])) $viewsController->invoke($_SESSION['command']);
else $viewsController->invoke();

include 'views/template/page/footer.php';