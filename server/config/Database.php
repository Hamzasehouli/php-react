<?php

namespace app\config;

use PDO;
use PDOException;

class Database
{

    private $host = 'localhost';
    private $port = 3306;
    private $dbname = 'immo';
    private $username = 'root';
    private $password = '';
    public $con;

    public function connect()
    {
        try {
            $this->con = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->con;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

}