<?php
// 引入資料庫連線設定檔
require_once("./asset/connect/db_connect.php");

// require_once("foodplatter_connect.php");

// // 如果未設定 GET 參數 "name"，表示不是正確的進入方式，顯示錯誤訊息並結束程式
if (!isset($_POST["food_id"])) {
    header("location: business404.php");
    exit;
}

// if(empty($_POST["food_img"])){
//     $_POST["food_img"]=$rows["food_img"];
// }




// 從 POST 取得要更新的食物資訊
$time = date('Y-m-d');

$food_id = $_POST["food_id"];
$food_name = $_POST["food_name"];
$food_category = $_POST["category_id"];
$food_intro = $_POST["food_intro"];
$food_note = $_POST["food_note"];
$food_price = $_POST["food_price"];
// echo ($food_id);
// 構建 SQL 更新語句


//上傳檔案開始
if ($_FILES["product_image"]["error"] == 0) {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], "./asset/img/" . $_FILES["product_image"]["name"])) {
        echo "上傳成功";
        $filename = $_FILES["product_image"]["name"];

        $sql = "UPDATE food_list 
        SET food_img='$filename', 
            food_name='$food_name', 
            category_id='$food_category',
            food_intro='$food_intro', 
            food_note='$food_note', 
            food_price='$food_price',
            modified_at='$time'
        WHERE food_id='$food_id'";

        if ($conn->query($sql) === TRUE) {
            echo "更新資料成功";
        } else {
            echo "更新資料錯誤: " . $conn->error;
        }
    }
} else {
    echo "上傳失敗";
    $sql = "UPDATE food_list 
    SET 
        food_name='$food_name', 
        category_id='$food_category',
        food_intro='$food_intro', 
        food_note='$food_note', 
        food_price='$food_price',
        modified_at='$time'
    WHERE food_id='$food_id'";

    if ($conn->query($sql) === TRUE) {
        echo "更新資料成功";
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
}
header("location: product-manage.php");
$conn->close();





//88


// echo ($sql);

// // 執行 SQL 語句，如果執行成功則顯示更新成功訊息，否則顯示錯誤訊息
// if ($conn->query($sql) === TRUE) {
//     echo "更新成功";
// } else {
//     echo "更新資料錯誤: " . $conn->error;
// }

// 重新導向到優惠卷列表頁面
// header("location:product-manage.php");

// // 關閉資料庫連線
// $conn->close();
