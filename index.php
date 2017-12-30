<?php

session_start();

require "vendor/autoload.php";

use App\RouterController;

// $duree=(strtotime(date('Y-m-d')) - strtotime("2017-12-29")) / 86400;
// echo $duree;

$router = new RouterController($_GET['url']); // création d'un routeur
$router->get('/', "\AuthenticationController::indexAction");
$router->post('/', "\AuthenticationController::indexPostAction");
$router->get('/admin', "\AdminController::indexAction");
$router->post('/admin', "\AdminController::validerPostsAction");

$router->get('/admin/nursings', "\AdminController::nursingsAction");
$router->post('/admin/nursings', "\AdminController::nursingsPostsAction");
$router->get('/admin/tasks', "\AdminController::tasksAction");
$router->post('/admin/tasks', "\AdminController::tasksPostsAction");
$router->get('/admin/tasksNotDid', "\AdminController::didAction");
$router->run();