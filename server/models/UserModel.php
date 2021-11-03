<?php

class UserModel
{
    private $id = '';
    private $firstname = '';
    private $lastname = '';
    private $email = '';
    private $password = '';

    public function find($con)
    {
        $stmt = $con->prepare('SELECT * FROM users');
        return $stmt;
    }
    public function create($con)
    {
        $stmt = $con->prepare('INSERT INTO users (firstname, lastname, email, password) VALUES(:firstname, :lastname, :email, :password)');
        return $stmt;
    }
    public function findOne($con)
    {
        $stmt = $con->prepare('SELECT * FROM users WHERE id=:id');
        return $stmt;
    }
    public function findOneAndUpdate()
    {

    }
    public function findOneAndDelete()
    {

    }
}