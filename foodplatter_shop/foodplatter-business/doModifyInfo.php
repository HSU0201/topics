<?php
require_once("./asset/connect/db_connect.php");
session_start();

if (!isset($_POST["shop_name"])) {
    header("location: business404.html");
    exit;
}
$id = $_SESSION["user"]["shop_id"];
$date = date('Y-m-d');

$name = $_POST["shop_name"];
$cities=$_POST["cities"];
$address = $_POST["address"];
$tel = $_POST["shop_tel"];
$category = $_POST["main_category"];
$email = $_POST["shop_email"];
$zip = $_POST["bank_zip"];
$account = $_POST["bank_account"];
$tax = $_POST["shop_tax"];
$introduce = $_POST["intro"];
// var_dump($introduce);
// exit;

// echo var_dump($_FILES["product_image"]);
// exit;

if ($_FILES["product_image"]["error"] == 0) {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], "./asset/img/" . $_FILES["product_image"]["name"])) {
        echo "上傳成功";
        $filename = $_FILES["product_image"]["name"];

        $sql = "UPDATE shopinfo SET shop_name='$name',cities='$cities' , address='$address',shop_tel='$tel',main_category='$category' ,shop_email='$email',bank_zip='$zip' ,bank_account='$account',shop_tax='$tax', modified_at='$date',shop_img='$filename',shop_intro='$introduce',certified=0 ,shop_valid=0 WHERE shop_id=$id
        ";

        if ($conn->query($sql) === TRUE) {
            echo "更新資料成功";
        } else {
            echo "更新資料錯誤: " . $conn->error;
        }
    }
} else {
    echo "上傳失敗";
    $sql = "UPDATE shopinfo SET shop_name='$name',cities='$cities' , address='$address',shop_tel='$tel',main_category='$category' ,shop_email='$email',bank_zip='$zip' ,bank_account='$account',shop_tax='$tax', modified_at='$date',shop_intro='$introduce',certified=0 ,shop_valid=0 WHERE shop_id=$id
        ";

    if ($conn->query($sql) === TRUE) {
        echo "更新資料成功";
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
}

$conn->close();



$message = "帳號已被下架！！請儘速更改錯誤以及違規內容！若有問題請聯繫客服 客服電話 ：02-10503525";
$_SESSION["certified"]["error"] = $message;
header("location: index.php");


// $sql = "UPDATE shopinfo SET shop_name='$name',address='$address',shop_tel='$tel',shop_email='$email',bank_account='$account',modified_at='$date' WHERE shop_id=$id
// ";

// if ($conn->query($sql) === TRUE) {
//     echo "更新資料成功";
// } else {
//     echo "更新資料錯誤: " . $conn->error;
// }
// $conn->close();
