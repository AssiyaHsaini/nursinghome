<?php

session_start();

require "vendor/autoload.php";

define('__ROOT__', __DIR__); 

use App\RouterController;

$router = new RouterController($_GET['url']); // création d'un routeur

$router->get('/', "\AuthenticationController::indexAction");
$router->post('/', "\AuthenticationController::indexPostAction");
$router->get('/logout', "\AuthenticationController::logoutAction");
$router->get('/admin', "\AdminController::indexAction");
$router->post('/admin', "\AdminController::validerPostsAction");
$router->get('/admin/nursings', "\AdminController::nursingsAction");
$router->post('/admin/nursings', "\AdminController::nursingsPostsAction");
$router->get('/admin/tasks', "\AdminController::tasksAction");
$router->post('/admin/tasks', "\AdminController::tasksPostsAction");
$router->get('/admin/tasksNotDid', "\AdminController::didAction");

$router->run();