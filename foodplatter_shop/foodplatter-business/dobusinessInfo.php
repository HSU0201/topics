<?php
require_once("./asset/connect/db_connect.php");
session_start();
if (!isset($_POST["shop_name"])) {
    // header("location: business404.html");
    header("location: business-login.php");


    exit;
}



$pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$vatIdPattern = '/^[0-9]{8}$/';
$passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,14}$/';

$email = $_POST["shop_email"];
$sql = "SELECT shop_email FROM shopinfo WHERE shop_email = '$email'";
$result = $conn->query($sql);
$emailResult = $result->num_rows;

$date = date('Y-m-d');

$password = $_POST["password"];
$repassword = $_POST["repassword"];
$name = $_POST["shop_name"];

$tel = $_POST["shop_tel"];
$tax = $_POST["shop_tax"];
$zip = $_POST["bank_zip"];
$bank = $_POST["bank_account"];
$cities = $_POST["cities"];
$address = $_POST["address"];
$categoryM = $_POST["main_category"];
$introduce = $_POST["shop_intro"];
$_SESSION["shop"]["email"] = $email;
$_SESSION["shop"]["name"] = $name;
$_SESSION["shop"]["password"] = $password;
$_SESSION["shop"]["tel"] = $tel;
$_SESSION["shop"]["tax"] = $tax;
$_SESSION["shop"]["zip"] = $zip;
$_SESSION["shop"]["bank"] = $bank;
$_SESSION["shop"]["address"] = $address;
$_SESSION["shop"]["introduce"] = $introduce;


if (empty($email)) {
    $message = "請輸入email";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if ($emailResult > 0) {
    $message = "此email已存在";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match($pattern, $email)) {
    $message = "請輸入正確的信箱";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}

if (empty($password)) {
    $message = "請輸入密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match($passwordPattern, $password)) {
    $message = "請輸入6到14位數且包含一個英文及數字的密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}

if (empty($repassword)) {
    $message = "請重新輸入密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (($password != $repassword)) {
    $message = "密碼與重複輸入密碼不一致";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (empty($name)) {
    $message = "請輸入店家名稱";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (empty($tel)) {
    $message = "請輸入店家電話";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match("/^0[0-9]{9}$/", $tel)) {
    $message = "請輸入正確的電話號碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}

if (empty($tax)) {
    $message = "請輸入統一編號";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match($vatIdPattern, $tax)) {
    $message = "請輸入正確的統一編號";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
/* */
if (empty($zip)) {
    $message = "請輸入銀行代碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match("/^[0-9]{3}$/", $zip)) {
    $message = "請輸入正確的銀行代碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
/* */
if (empty($bank)) {
    $message = "請輸入銀行帳號";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (!preg_match("/^[0-9]{12}$/", $bank)) {
    $message = "請輸入正確的銀行帳號";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}


if (empty($cities)) {
    $message = "請選擇縣市地區";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (empty($address)) {
    $message = "請輸入詳細地址";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (empty($categoryM)) {
    $message = "請選擇分類";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if (empty($introduce)) {
    $message = "請輸入詳細介紹";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
if ($_FILES["product_image"]["error"] == 0) {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], "./asset/img/" . $_FILES["product_image"]["name"])) {
        // echo "上傳成功";
        $filename = $_FILES["product_image"]["name"];

        $sql = "INSERT INTO shopinfo (shop_name,shop_intro,main_category,shop_tax,shop_email,password,shop_tel,cities,address,bank_zip,bank_account,shop_img,shop_valid,certified,created_at,modified_at) VALUES ('$name', '$introduce', '$categoryM','$tax', '$email', '$password', '$tel', '$cities', '$address', '$zip', '$bank', '$filename', 0, 0, '$date', '$date')";

        if ($conn->query($sql) === TRUE) {
            header("location: business-login.php");
        } else {
            header("location: business404.html");
        }
    }
} else {
    $message = "圖檔上傳失敗";
    $_SESSION["error"]["message"] = $message;
    header("location:business-info.php");
    exit;
}
unset($_SESSION["shop"]);
unset($_SESSION["error"]["message"]);
$conn->close();
