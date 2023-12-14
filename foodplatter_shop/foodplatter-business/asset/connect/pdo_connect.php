<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "Foodplatter";


try{
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
}catch(PDOException $e){
    echo "資料庫連線失敗: ".$e->getMessage();
}

