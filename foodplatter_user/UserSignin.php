<?php
require_once("db-connect.php");
session_start();

if(!isset($_POST["email"])){
    echo "請循正常管道進入此頁";
    exit;
}

$email=$_POST["email"];
$password=$_POST["password"];

// var_dump($email,$password);

if(empty($email)){
    $message="請輸入信箱";
    $_SESSION["error"]["message"]=$message;
    header("location:user_signin.php");
    // echo "請輸入email";
    exit;
}

// email檢測:
// @前面的使用者名稱可以以任何字串設定，一定要有@，@後面的字一定要以.連接
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
    header("location:user_signin.php");
    // echo "請輸入email";
    exit;
}

if(empty($password)){
    $message="請輸入密碼";
    $_SESSION["error"]["message"]=$message;
    header("location:user_signin.php");
    // echo "請輸入email";
    exit;
}

$password=md5($password);
// echo $email.",",$password;
// admin1@gmail.com
// 11111

// var_dump($email,$password);

// 為甚麼這裡不用取得他的密碼?
$sql="SELECT user_id, user_name, user_email, user_phone FROM users WHERE user_email = '$email' AND password = '$password' AND user_valid = 1";

$result=$conn->query($sql);

if($result->num_rows==0){
    if(isset($_SESSION["error"]["times"])){
        $_SESSION["error"]["times"]++;
    }else{
        $_SESSION["error"]["times"]=1;
    }
    $message="帳號或密碼錯誤";
    $_SESSION["error"]["message"]=$message;
    header("location:user_signin.php");
    exit;
}

// echo "登入成功";
$row=$result->fetch_assoc();
// 用session拿到使用者的資料
$_SESSION["user"]=$row;
// var_dump($row);
// 如果我登入成功，就把之前的登入錯誤清掉
unset($_SESSION["error"]);

header("location:user_index.php");
$conn->close();





?>
