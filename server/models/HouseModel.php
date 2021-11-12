<?php

class HouseModel
{
    public $id = '';
    public $title = '';
    public $price = '';
    public $added_at = '';
    public $adresse = '';
    public $images = '';
    public $description = '';
    public $user = '';
    public $area = '';
    public $type = '';
    public $discret = '';
    public $state = '';
    public function find($con)
    {
        $stmt = $con->prepare('SELECT * FROM houses');
        return $stmt;
    }
    public function create($con)
    {
        $stmt = $con->prepare('INSERT INTO houses (title, price, city, adresse, images,description,user,area,type,discret,state) VALUES(:title, :price, :city, :adresse,:images,:description,:user,:area,:type,:discret,:state)');
        return $stmt;
    }
    public function findOne($con)
    {
        $stmt = $con->prepare('SELECT * FROM houses WHERE id=:id');
        return $stmt;
    }
    public function findOneAndUpdate()
    {

    }
    public function findOneAndDelete()
    {

    }
}