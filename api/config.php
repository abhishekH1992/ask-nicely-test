<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: 'X-Requested-With,content-type'");
header('Access-Control-Allow-Methods: GET, POST');

getenv('MYSQL_DBHOST') ? $host=getenv('MYSQL_DBHOST') : $host="localhost";
getenv('MYSQL_DBPORT') ? $port=getenv('MYSQL_DBPORT') : $port="3306";
getenv('MYSQL_DBUSER') ? $user=getenv('MYSQL_DBUSER') : $user="root";
getenv('MYSQL_DBPASS') ? $password=getenv('MYSQL_DBPASS') : $password="root";
getenv('MYSQL_DBNAME') ? $dbname=getenv('MYSQL_DBNAME') : $dbname="php_docker";

$connection = new mysqli("$host:$port", $user, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}