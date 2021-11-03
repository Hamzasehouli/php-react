<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once __DIR__ . '/vendor/autoload.php';
use app\config\Database;
use app\controllers\HouseController;
use app\routes\HouseRoute;

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

echo '404, route not found with this url: ' . $_SERVER['REQUEST_URI'] . '';