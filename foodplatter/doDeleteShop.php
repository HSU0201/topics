<?php
require_once("foodplatter_connect.php");

if (!isset($_GET["shop_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["shop_id"];

$sql = "UPDATE shopinfo SET shop_valid='0', certified='2' WHERE shop_id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location:shopstables.php");
