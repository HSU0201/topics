<?php
// 引入資料庫連線設定檔
require_once("../foodplatter_connect.php");
// require_once("foodplatter_connect.php");

// // 如果未設定 GET 參數 "name"，表示不是正確的進入方式，顯示錯誤訊息並結束程式
if (!isset($_POST["food_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

if(empty($_POST["food_img"])){
    $_POST["food_img"]=$rows["food_img"];
}

if(empty($_POST["food_img"])){
    $_POST["food_img"]=$rows["food_img"];
}


// 從 POST 取得要更新的食物資訊
$food_id = $_POST["food_id"];
$food_img = $_POST["food_img"];
$food_name = $_POST["food_name"];
$food_category = $_POST["food_category"];
$food_intro = $_POST["food_intro"];
$food_note = $_POST["food_note"];
$food_price = $_POST["food_price"];
// echo ($food_id);
// 構建 SQL 更新語句
$sql = "UPDATE food_list 
        SET food_img='$food_img', 
            food_name='$food_name', 
            food_category='$food_category',
            food_intro='$food_intro', 
            food_note='$food_note', 
            food_price='$food_price'
        WHERE food_id='$food_id'";

echo ($sql);

// // 執行 SQL 語句，如果執行成功則顯示更新成功訊息，否則顯示錯誤訊息
if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

// 重新導向到優惠卷列表頁面
// header("location:product-manage.php");

// // 關閉資料庫連線
// $conn->close();
