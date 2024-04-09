<?php

$dbhost="localhost";
$dbname="";
$dsn = "mysql:host=$dbhost; dbname=$dbname";
$dbusername= "root";
$dbpassword = "";

try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);  //connect to the database using PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   //set the error mode to exception
}catch(PDOException $e){
    echo "Database connection failed: ".$e->getMessage();
}
