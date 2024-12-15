<?php
require 'core/db.php';
require 'core/Router.php';
require 'models/UserModel.php';
require 'controllers/UserController.php';

// Create MYSQLi instance
$mysqli = new Db($host, $user, $passwd, $db);
// Create Router instance
$router = new Router();

// Define routes
$router->get('/user', function($params) use ($mysqli) {
    $userModel = new UserModel($mysqli);
    $userController = new UserController($userModel);
    $userController->showUser($params['id']);
});

// Dispatch the request
$router->dispatch();
?>