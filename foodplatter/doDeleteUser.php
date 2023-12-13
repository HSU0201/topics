<?php
require_once("foodplatter_connect.php");

if (!isset($_GET["user_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["user_id"];

$sql = "UPDATE users SET user_valid=0 WHERE user_id=$id";
// echo $sql;
// exit;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location:userstables.php");
