<?php
// 檢查是否透過正確管道進入
require_once("./asset/connect/db_connect.php");


//後端驗證
session_start();
$id = $_SESSION["user"]["shop_id"];


if (!isset($_POST["food_name"])) {
  echo "請循正常管道進入";
  die;
}

// 獲取 POST 參數
$food_name = $_POST["food_name"];
$food_category = $_POST["food_category"];

$food_intro = $_POST["food_intro"];
$food_note  = $_POST["food_note"];

$food_price = $_POST["food_price"];
//$food_img = $_POST["food_img"];
$foodCategory=$id;

$time = date('Y-m-d');

//echo "$food_name, $food_category, $food_intro, $food_note, $food_price, $food_img";


// 檢查必填欄位是否為空
if (empty($food_name)) {
  //echo "請輸入資料";
  $message = "請輸入商品名稱";
  $_SESSION["error"]["message"] = $message;
   header("location: add-food.php.");
   exit;
   
} 

if (empty($food_category)) {
  //echo "請輸入資料";
  $message = "請選擇商品類別";
  $_SESSION["error"]["message"] = $message;
  header("location: add-food.php.");
  exit;
}

if (empty($food_price)) {
  //echo "請輸入資料";
  $message = "請輸入商品售價";
  $_SESSION["error"]["message"] = $message;
  header("location: add-food.php.");
  exit;
}


if ($_FILES["food_img"]["error"] == 0) {

  if (move_uploaded_file($_FILES["food_img"]["tmp_name"], "./asset/img/" . $_FILES["food_img"]["name"])) {
    $filename = $_FILES["food_img"]["name"];

    // 準備 SQL 插入語句，將用戶數據插入到 "foodlist" 表格中
    $sql = "INSERT INTO food_list (food_img, food_name, category_id, food_intro, food_note, food_price, created_at,modified_at,foodCategory_id,food_valid)
    VALUES ('$filename', '$food_name', '$food_category', '$food_intro','$food_note', '$food_price', '$time','$time','$foodCategory',1)";
    //echo $sql;
    //exit;


    // 執行 SQL 插入語句
    if ($conn->query($sql) === TRUE) {
      echo "新增資料完成";
    } else {
      echo "新增資料錯誤: " . $conn->error;
    }

    //終止報錯資訊 
    //unset($_SESSION["error"]["message"]);

    // 關閉資料庫連接
    $conn->close();


    // 重新導向到指定頁面(依禾的頁面)
    header("location: product-manage.php");
  };
  // echo "上傳成功";
} else {
  $message = "請選擇商品圖片";
  $_SESSION["error"]["message"] = $message;
  header("location: add-food.php");
  exit;
}
