<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "foodplatter";
    
// Create connection
// 把這些資料丟進去，並建立資料庫，丟進物件
// (問題)瘦箭頭意思?
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
// 在js中是用. 在php中是用-> (就是物件後面附註的功能)
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}else{
    // echo "資料庫連線成功";
};


