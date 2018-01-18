<?php

session_start();

// s'occupe de l'autoloader
require "vendor/autoload.php";

define('__ROOT__', __DIR__); 

use App\RouterController;

// création d'un routeur
$router = new RouterController($_GET['url']); 
 
$router->get('/', "\AuthenticationController::indexAction");
$router->post('/', "\AuthenticationController::indexPostAction");
$router->get('/logout', "\AuthenticationController::logoutAction");
$router->get('/admin', "\AdminController::indexAction");
$router->post('/admin', "\AdminController::validerPostsAction");
$router->get('/admin/nursings', "\AdminController::nursingsAction");
$router->post('/admin/nursings', "\AdminController::nursingsPostsAction");
$router->get('/admin/tasks', "\AdminController::tasksAction");
$router->post('/admin/tasks', "\AdminController::tasksPostsAction");
$router->get('/admin/reset', "\AdminController::resetAction");
$router->post('/admin/reset', "\AdminController::resetPostsAction");
$router->get('/admin/tasksNotDid', "\AdminController::didAction");

$router->run();