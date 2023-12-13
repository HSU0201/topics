<?php
require_once("./asset/connect/db_connect.php");
session_start();

$email = $_POST["shop_email"];

if (!isset($_POST["shop_email"])) {
    header("location:business404.php");
    exit;
}
$password = $_POST["password"];
if (empty($email)) {
    $message = "請輸入email";
    $_SESSION["error"]["message"] = $message;
    header("location:business-login.php");
    exit;
}
if (empty($password)) {
    $message = "請輸入密碼";
    $_SESSION["error"]["message"] = $message;
    header("location:business-login.php");
    exit;
}



$sql = "SELECT shop_id,shop_email,password,shop_valid,certified FROM shopinfo WHERE shop_email='$email' AND password ='$password'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    if (isset($_SESSION["error"]["times"])) {
        $_SESSION["error"]["times"]++;
    } else {
        $_SESSION["error"]["times"] = 1;
    }
    $message = "帳號或密碼錯誤";
    $_SESSION["error"]["message"] = $message;
    header("location:business-login.php");
    exit;
}
$row = $result->fetch_assoc();
$_SESSION["user"] = $row;
unset($_SESSION["error"]);
if ($row["certified"] == 0) {

    header("location:certified-none.php");
} else if ($row["certified"] == 1) {

    header("location:index.php");
} else if ($row["certified"] ==( 2 )) {
    $message = "帳號已被下架！！請儘速更改錯誤以及違規內容！若有問題請聯繫客服 客服電話 ：02-10503525";
    $_SESSION["certified"]["error"] = $message;
    header("location: index.php");
} else if ($row["certified"] ==(  3)) {
    $message = "帳號認證不通過！！請儘速更改錯誤以及違規內容！若有問題請聯繫客服 客服電話 ：02-10503525";
    $_SESSION["certified"]["error"] = $message;
    header("location: index.php");
}
$conn->close();
