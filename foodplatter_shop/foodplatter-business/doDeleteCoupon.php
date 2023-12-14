<?php
session_start();
require_once("./asset/connect/pdo_connect.php");

$_SESSION['revise'] = 'delete';

if(!isset($_POST['coupon-id'])):
    die('請循正常管道進入此頁');
else:
    $coupon_id = $_POST['coupon-id'];
endif;

$sql = "UPDATE coupon SET valid=0 WHERE coupon_id=:coupon_id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':coupon_id', $coupon_id);


try{
    $stmt->execute();
}catch(PDOException $e){
    die('優惠券修改失敗，敬請洽詢課服並提供錯誤內容: '.$e->getMessage());
}

$pdo = null;

header("location: ".$_SESSION['currentUrl']);