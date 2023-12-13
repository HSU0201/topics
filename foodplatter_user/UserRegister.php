<?php
require_once("db-connect.php");
session_start();

// 可寫可不寫
if(!isset($_POST["email"])){
    echo "請循正常管道進入此頁";
    exit;
}

$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];

date_default_timezone_set('Asia/Taipei');
$time=date('Y-m-d H:i:s');

if(empty($name)){
    $message="請輸入姓名";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

if(empty($phone)){
    $message="請輸入電話";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

function phone($phonecheck){
    $phonePattern = '/^09\d{8}$/';
    if (preg_match($phonePattern, $phonecheck)) {
        return true; // 驗證通過
    }
};

if(phone($phone)){

}else{
    $message="請輸入正確電話格式";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

if(empty($email)){
    $message="請輸入信箱";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

function email($emailcheck){
    $emailPattern = '/^\w+([-+.]?\w+)*@[a-zA-Z]+([-.][a-zA-Z]+)*\.[a-zA-Z]+$/';
    if (preg_match($emailPattern, $emailcheck)) {
        return true; // 驗證通過
    }
};

if(email($email)){

}else{
    $message="請輸入正確信箱格式";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

if(empty($password)){
    $message="請輸入密碼";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

if(empty($password)){
    $message="請再輸入一次密碼";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "請輸入email";
    exit;
}

// 檢查密碼
if($password!=$repassword){
    $message="前後密碼不一致";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "前後密碼不一致";
    exit;
}

// 檢查重複的帳號有幾筆
$sql="SELECT * FROM users WHERE user_email='$email'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
echo $rowCount;
if($rowCount>0){
    $message="此帳號已經存在，請從登入頁面登入";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    exit;
    
}

// 密碼加密
$password=md5($password);

// 寫入資料
$sql="INSERT INTO users (user_name, password, user_phone, user_email, created_at, user_valid)
VALUES ('$name', '$password', '$phone', '$email', '$time', 1)";


// echo $sql;

if ($conn->query($sql) === TRUE) {
    $message="註冊成功，請由登入頁面再登入一次";
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    // echo "前後密碼不一致";
    exit;

} else {
    $message="註冊失敗: " . $conn->error;
    $_SESSION["error"]["message"]=$message;
    header("location:user_register.php");
    exit;
}

// header("location:sign-up.php");


