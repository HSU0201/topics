<?php
require_once("../db-connect.php");

if(!isset($_POST["email"])){
    echo "請循正常管道進入此頁";
    exit;
}

$email=$_POST["email"];
$name=$_POST["name"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];

// echo "$email, $name, $password, $repassword";

if(empty($email)||empty($name)||empty($password)||empty($repassword)){
    echo "請輸入必填欄位";
    exit;
}

// echo "$email, $name, $password, $repassword";

// 檢查密碼
if($password!=$repassword){
    echo "前後密碼不一致";
    exit;
}

// 檢查重複的帳號有幾筆
$sql="SELECT * FROM users WHERE email='$email'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
echo $rowCount;
if($rowCount>0){
    die("此帳號已經存在");
}

// 密碼加密
$password=md5($password);

$time=date('Y-m-d H:i:s');
$sql="INSERT INTO users (name, password, email,create_at, valid)
VALUES ('$name', '$password', '$email','$time',1)";

// valid也可以做會員等級

// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
    
    $last_id = $conn->insert_id;
    echo "最新一筆序號".$last_id;
} else {
    echo "新增資料錯誤: " . $conn->error;
}

// header("location:sign-up.php");