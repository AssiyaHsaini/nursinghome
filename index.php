<?php

require "vendor/autoload.php";

use App\RouterController;
// use App\PDOController;

$router = new RouterController($_GET['url']);
$router->get('/', "\AuthenticationController::indexAction");

$router->run();
// $bdd= new PDOController();