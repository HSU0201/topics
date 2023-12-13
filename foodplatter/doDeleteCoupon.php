<?php
require_once("foodplatter_connect.php");

if (!isset($_GET["coupon_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["coupon_id"];

$sql = "UPDATE coupon SET valid='0' WHERE coupon_id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location:coupons.php");
