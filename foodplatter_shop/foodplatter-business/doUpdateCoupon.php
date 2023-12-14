<?php
session_start();
require_once('./asset/connect/pdo_connect.php');

$_SESSION['coupon_id'] = $_POST['coupon-id'];
$_SESSION['revise'] = 'update';

$coupon_id = $_POST['coupon-id'];
$coupon_name = $_POST['coupon-name'];
$coupon_intro = $_POST['coupon-intro'];
$coupon_code = $_POST['coupon-code'];
$coupon_threshold = $_POST['coupon-threshold'];
$coupon_discount = $_POST['coupon-discount'];
$coupon_start = $_POST['coupon-start'];
$coupon_exp = $_POST['coupon-exp'];
$coupon_max_count = $_POST['coupon-max-count'];
$date = date('Y-m-d');

$sql = "UPDATE coupon SET 
    coupon_name=:coupon_name, 
    coupon_introduce=:coupon_intro, 
    coupon_code=:coupon_code, 
    coupon_threshold=:coupon_threshold, 
    coupon_discount=:coupon_discount, 
    coupon_start=:coupon_start, 
    coupon_exp=:coupon_exp, 
    coupon_max_count=:coupon_max_count, 
    modified_at='$date'
    WHERE coupon_id='$coupon_id'";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':coupon_name', $coupon_name);
$stmt->bindParam(':coupon_intro', $coupon_intro);
$stmt->bindParam(':coupon_code', $coupon_code);
$stmt->bindParam(':coupon_threshold', $coupon_threshold); 
$stmt->bindParam(':coupon_discount', $coupon_discount); 
$stmt->bindParam(':coupon_start', $coupon_start);
$stmt->bindParam(':coupon_exp', $coupon_exp);
$stmt->bindParam(':coupon_max_count', $coupon_max_count);

// $couponIntroRegExp = '/^[\s\S]{1,30}$/u';
$couponThresholdRegExp = '/^\p{Nd}+$/';
$couponDiscountRegExp = '/^(0(\.\d{1,2})?|[1-9]\d*)$/';
$couponCodeRegExp = '/^[A-Z0-9]{6,10}$/';
$dateRegExp = '/^\d{4}-\d{2}-\d{2}$/';
$couponMaxCountRegExp = '/^[1-9]\d*$/';
// if(!preg_match($couponIntroRegExp, $coupon_intro)){
//     $message = '優惠券說明內容格式錯誤';
//     $_SESSION['error']['message']=$message;
//     var_dump($message);
//     header('location: business-coupon-update.php');
// }
if(!preg_match($couponThresholdRegExp, $coupon_threshold)){
    $message = '優惠券門檻格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
}
if(!preg_match($couponDiscountRegExp, $coupon_discount)){
    $message = '優惠方式格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
}
if(!preg_match($couponCodeRegExp, $coupon_code)){
    $message = '優惠碼格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
}
if(!preg_match($couponMaxCountRegExp, $coupon_max_count)){
    $message = '發送數量格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
    exit;
}
if(!preg_match($dateRegExp, $coupon_start)){
    $message = '開始日期格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
    exit;
}
if(!preg_match($dateRegExp, $coupon_exp)){
    $message = '結束日期格式錯誤';
    $_SESSION['error']['message']=$message;
    header('location: business-coupon-update.php');
}

try{
    $stmt->execute();
    echo "優惠券修改成功";
}catch(PDOException $e){
    die('優惠券修改失敗，敬請洽詢課服並提供錯誤內容: '.$e->getMessage());
}

$pdo = null;


header("location: ".$_SESSION['currentUrl']);