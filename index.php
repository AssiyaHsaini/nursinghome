<?php

require "vendor/autoload.php";

use App\RouterController;

////////////
use App\PDOController;
$bdd = PDOController::getInstance();
////////////

$router = new RouterController($_GET['url']);
$router->get('/', "\AuthenticationController::indexAction");

$router->run();