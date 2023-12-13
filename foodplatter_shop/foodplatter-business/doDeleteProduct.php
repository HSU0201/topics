<?php
require_once("./asset/connect/db_connect.php");


if (!isset($_GET["food_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}
$id=$_GET["food_id"];

$sql = "UPDATE food_list SET food_valid='0' WHERE food_id=$id";


if ($conn->query($sql) === TRUE) {
    echo "刪除完成";
    
} else {
    echo "刪除資料錯誤 : " . $conn->error;
}

$conn->close();
header("location:product-manage.php");
