<?php

session_start();

require "vendor/autoload.php";

use App\RouterController;

$router = new RouterController($_GET['url']); // création d'un routeur
$router->get('/', "\AuthenticationController::indexAction");
$router->post('/', "\AuthenticationController::indexPostAction");
$router->get('/admin', "\AdminController::indexAction");
$router->get('/admin/nursings', "\AdminController::nursingsAction");
$router->post('/admin/nursings', "\AdminController::nursingsPostsAction");
$router->run();