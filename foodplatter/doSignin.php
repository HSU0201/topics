<?php
require_once("foodplatter_connect.php");
session_start();

// if(!isset($_POST["email"])){
//     echo "請循正常管道進入此頁";
//     exit;
// }

$email=$_POST["email"];
$password=$_POST["password"];

// var_dump($email,$password);

if(empty($email)){
    $message="請輸入信箱";
    $_SESSION["error"]["message"]=$message;
    header("location:login.php");
    echo "請輸入email";
    exit;
}
if(empty($password)){
    $message="請輸入密碼";
    $_SESSION["error"]["message"]=$message;
    header("location:login.php");
    // echo "請輸入email";
    exit;
}
// $password=md5($password);
// var_dump($email,$password);

$sql="SELECT * FROM admin WHERE email = '$email' AND password = '$password' AND valid = 1";

$result=$conn->query($sql);

if($result->num_rows==0){
    if(isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]++;
    }else{
        $_SESSION["error"]["times"]=1;
    }
    $message="帳號或密碼錯誤";
    $_SESSION["error"]["message"]=$message;
    header("location:login.php");
    exit;
}

// echo "登入成功";
$row=$result->fetch_assoc();
// 用session拿到使用者的資料
$_SESSION["admin"]=$row;
// var_dump($row);
// 登入成功，就把之前的登入錯誤清掉
unset($_SESSION["error"]);

header("location:index.php");
$conn->close();