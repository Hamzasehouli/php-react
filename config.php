<?php
$host = 'localhost'; //define the host 
$port=3306; //define the port
$DB = 'users'; //define the data base name in mysql
$DB_USERNAME = 'root'; //define the user name a windows admin
$DB_PASSWORD=''; //define the password of windows admin

try{
    $con = new PDO("mysql:host=$host;port=$port;dbname=$DB", $DB_USERNAME,$DB_PASSWORD); //connecting to the data base using PDO class
    $con->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE); // PDO::ERRMODE_EXCEPTION throws exception and if there is an error in SQL it will stop the running of the script ; with PDO::ATTR_ERRMODE; the PDOException will be set and caught in the catch statement if there is a fatal error; the script still not running; 
    // echo 'successfull connection to DB';
}catch(PDOException $err){
// echo $err; here we catch the error from try statement and will be strored in the new declared variable $err;
}
?>