<?php

require "vendor/autoload.php";

use App\RouterController;

$router = new RouterController($_GET['url']);
$router->get('/', "\AuthenticationController::indexAction");

$router->run();