<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once __DIR__ . '/vendor/autoload.php';
use app\config\Database;
use app\controllers\HouseController;
use app\controllers\UserController;
use app\routes\HouseRoute;
use app\routes\UserRoute;

$con = new Database();
// $router = new Router();
// $jj = new HouseController();
// print_r($jj);

if (str_starts_with($_SERVER['REQUEST_URI'], '/api/v1/houses')) {
    $houseRouter = new HouseRoute();
    $houseRouter->get('/api/v1/houses', [HouseController::class, 'getAllHouses']);
    $houseRouter->post('/api/v1/houses', [HouseController::class, 'createHouse']);
    $houseRouter->get('/api/v1/houses/get-house', [HouseController::class, 'getHouse']);
    $houseRouter->post('/api/v1/houses/update-house', [HouseController::class, 'updateHouse']);
    $houseRouter->post('/api/v1/houses/delete-house', [HouseController::class, 'deleteHouse']);
    $houseRouter->run();
    return;
}

if (str_starts_with($_SERVER['REQUEST_URI'], '/api/v1/users')) {
    $userRouter = new UserRoute();
    $userRouter->get('/api/v1/users', [UserController::class, 'getAllUsers']);
    $userRouter->post('/api/v1/users', [UserController::class, 'createUser']);
    $userRouter->get('/api/v1/users/get-user', [UserController::class, 'getUser']);
    $userRouter->post('/api/v1/users/update-user', [UserController::class, 'updateUser']);
    $userRouter->post('/api/v1/users/delete-user', [UserController::class, 'deleteUser']);
    $userRouter->run();
    return;
}

echo '404, route not found with this url: ' . $_SERVER['REQUEST_URI'] . '';