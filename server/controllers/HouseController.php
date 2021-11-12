<?php

namespace app\controllers;

use app\config\Database;
use app\models\HouseModel;

class HouseController
{
    public static function getAllHouses()
    {
        echo 'get all houses';
    }
    public static function createHouse()
    {
        $body = json_decode(file_get_contents('php://input', true));
        // extract($body);
        $db = new Database();
        $con = $db->connect();
        $houseModel = new HouseModel();
        $stmt = $houseModel->create($con);
        $stmt->bindValue(':title', $body->title);
        $stmt->bindValue(':price', $body->price);
        $stmt->bindValue(':description', $body->description);
        $stmt->bindValue(':adresse', $body->adresse);
        // $stmt->bindValue(':images', $body->images);
        $stmt->bindValue(':state', $body->state);
        $stmt->bindValue(':discret', $body->discret);
        $stmt->bindValue(':type', $body->type);
        $stmt->bindValue(':area', $body->area);
        $stmt->bindValue(':user', $body->user);
        $stmt->bindValue(':city', $body->city);
        $stmt->execute();
    }
    public static function getHouse()
    {
        echo 'get house';
    }
    public static function updateHouse()
    {
        echo 'update house';
    }
    public static function deleteHouse()
    {
        echo 'delete house';
    }
}