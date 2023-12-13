<?php
// 引入與資料庫連接的文件
require_once("foodplatter_connect.php");

// 檢查是否有 POST 參數 "id"
if (!isset($_POST["coupon_id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

// 從 POST 參數中獲取需要更新的優惠卷資料
$id = $_POST["coupon_id"];
$name = $_POST["coupon_name"];
$introduce = $_POST["coupon_introduce"];
$code = $_POST["coupon_code"];
$threshold = $_POST["coupon_threshold"];
$discount = $_POST["coupon_discount"];
$start = $_POST["coupon_start"];
$exp = $_POST["coupon_exp"];
$max_count = $_POST["coupon_max_count"];
$used_count = $_POST["coupon_used_count"];
// 獲取當前時間
$time = date('Y-m-d H:i:s');

// 構建 SQL 更新語句
$sql = "UPDATE coupon 
        SET coupon_name='$name',
            coupon_introduce='$introduce',
            coupon_code='$code',
            coupon_threshold='$threshold',
            coupon_discount='$discount',
            coupon_start='$start',
            coupon_exp='$exp',
            coupon_max_count='$max_count',
            coupon_used_count='$used_count',
            modified_at='$time'
        WHERE coupon_id=$id";

// 印出 SQL 語句，用於測試
// echo $sql;

// 執行 SQL 更新
if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

// 關閉資料庫連接
$conn->close();

// 重新導向到優惠卷列表頁面
header("location:coupons.php");