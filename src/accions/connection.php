<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "universidad";

try{
    $mysqli = new mysqli($host, $user, $pass, $dbname);
    
}catch (mysqli_sql_exception $error){
    echo "Error "  . $error->getMessage();
}