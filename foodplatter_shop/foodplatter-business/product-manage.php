<?php
require_once("./asset/connect/db_connect.php");
session_start();

if (!isset($_SESSION["user"])) {
    header("location:business-login.php");
    exit;
}
if (isset($_SESSION["certified"]["error"])) {
    $certified_error = $_SESSION["certified"]["error"];
  }

$id = $_SESSION["user"]["shop_id"];
if (isset($_SESSION["certified"]["error"])) {
    $certified_error = $_SESSION["certified"]["error"];
}
$sql = "SELECT * FROM shopinfo WHERE shop_id=$id";
$resultA = $conn->query($sql);
$rowA = $resultA->fetch_assoc();


// 計算存在的食物總筆數
$sqlTotal = "SELECT * FROM food_list WHERE food_valid=1 AND foodCategory_id=$id";
$resultTotal = $conn->query($sqlTotal);
$totalProduct = $resultTotal->num_rows;

// 食物分類
$sqlCategory = "SELECT * FROM food_category WHERE food_valid=1 AND foodCategory_id=$id";
$resultCategory = $conn->query($sqlCategory);
$rowsCategory = $resultCategory->fetch_all(MYSQLI_ASSOC);


// 一頁有幾筆
$perPage = 12;
// 有幾頁
$pageCount = ceil($totalProduct / $perPage);

// 執行搜尋動作開始
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    // LIKE模糊搜尋，LIKE '%$search%' 的意思是查詢 name 列中包含 $search 變數的值的所有行
    $sql = "SELECT food_list.*,food_category.name FROM food_list
    JOIN food_category ON food_list.category_id = food_category.id 
    WHERE food_list.food_name LIKE '%$search%' AND food_list.food_valid=1 AND food_list.foodCategory_id=$id"; // 加上 AND valid=1，避免被刪除後還搜尋的到
} elseif (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"]; // 去抓現在在第幾分頁
    $order = $_GET["order"];

    // 在 switch 之前初始化 $orderSql
    $orderSql = "food_price ASC";

    switch ($order) {
        case 1:
            $orderSql = "food_price ASC";
            break;
        case 2:
            $orderSql = "food_price DESC";
            break;
        case 3:
            $orderSql = "modified_at ASC";
            break;
        case 4:
            $orderSql = "modified_at DESC";
            break;
        default:
            $orderSql = "food_id ASC";
    }

    $startItem = ($page - 1) * $perPage; // 略過前幾頁內容
    $sql = "SELECT food_list.*,food_category.name FROM food_list
    JOIN food_category ON food_list.category_id = food_category.id
    WHERE food_list.food_valid=1 AND food_list.foodCategory_id=$id ORDER BY $orderSql LIMIT $startItem, $perPage";
} else if (isset($_GET["category"])) {
    $category = $_GET["category"];
    $sql = "SELECT food_list.*,food_category.name FROM food_list 
    JOIN food_category ON food_list.category_id = food_category.id 
    WHERE food_list.category_id = $category
    AND food_list.food_valid=1 AND food_list.foodCategory_id=$id 
    ORDER BY food_list.food_id ASC LIMIT 0,$perPage";
    $order = 1;
} else {
    $page = 1;
    $sql = "SELECT food_list.*,food_category.name FROM food_list 
    JOIN food_category ON food_list.category_id = food_category.id 
    WHERE food_list.food_valid=1 AND food_list.foodCategory_id=$id 
    ORDER BY food_list.food_id ASC LIMIT 0,$perPage";
    $order = 1; // 預設為升冪排列
}
// 執行搜尋動作結束



$result = $conn->query($sql);
$nowTotalProduct = $result->num_rows;

// 檢查查詢是否成功
if (!$result) {
    die("Query failed: " . $conn->error);
}

// 初始化一個空數組，用於存儲所有行的數據
$rows = array();

// 使用循環遍歷結果集，將每一行的數據存儲到$rows數組中
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?= $rowA["shop_name"] ?>後台系統</title>

    <!--此模板的自訂字體-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!--此模板的自訂樣式-->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link href="./css/sb-admin-2.css" rel="stylesheet" />

    <style>
        .object-fit-cover {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .btn-ppp {
            background: #02078e;
            border: #02078e;
            color: white !important;
        }

        .btn-ppp:hover {
            background: #0008fc;
            border: #0008fc;
        }
    </style>

</head>



<body id="page-top">
    <!-- 登出彈出視窗 -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">確定要離開嗎?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    如果您準備結束目前會話，請選擇下面的「登出」。
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        取消
                    </button>
                    <a class="btn btn-ppp " href="business-login.php">登出</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 登出彈出視窗結束 -->
    <?php foreach ($rows as $row) : ?>
        <!-- 製作刪除的警告視窗 -->
        <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">警告</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        確認刪除此商品嗎？
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            取消
                        </button>
                        <a class="btn btn-danger" href="doDeleteProduct.php?food_id=<?= $row["food_id"] ?>">確認刪除</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- 結束製作刪除的警告視窗 -->

    <!--頁面包裝器-->
    <div id="wrapper" class="goodnav">
        <!--側邊欄-->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!--側邊欄 -品牌-->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-slack"></i>
                </div>
                <div class="sidebar-brand-text mx-3">foodplatter</div>
            </a>

            <!--分音器-->
            <hr class="sidebar-divider my-0" />

            <!--導航項目 -儀表板-->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <span><i class="bi bi-house-fill"></i>&nbsp;&nbsp;主頁</span>
                </a>
            </li>

            <!--分音器-->
            <hr class="sidebar-divider" />

            <!--標題-->
            <div class="sidebar-heading">管理系統</div>

            <!--導航項目 -表格 -商品管理-->
            <li class="nav-item active">
                <a class="nav-link" href="product-manage.php">
                    <i class="bi bi-shop"></i>
                    <span>商品管理</span></a>
            </li>
            <!--導航項目 -表格 -優惠卷管理-->
            <li class="nav-item">
                <a class="nav-link" href="./foodplatter-bussiness/bussiness-coupon.html">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>優惠卷管理</span></a>
            </li>

            <!--分音器-->
            <hr class="sidebar-divider d-none d-md-block" />

            <!--側邊欄切換器（側邊欄）-->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!--側邊欄末尾-->


        <!--內容包裝器-->
        <div id="content-wrapper" class="d-flex flex-column">
            <!--主要內容-->
            <div id="content">
                <!--nav-->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!--側邊欄切換（頂欄）-->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!--頂欄中級-->
                    <ul class="navbar-nav ml-auto">
                        <!--導航項目 -搜尋下拉式選單（僅 XS 可見）-->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!--下拉式選單 -訊息-->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!--導航項目 -使用者資訊-->
                        <li class="nav-item dropdown no-arrow d-flex">
                            <div class="nav-link" href="#" id="">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Hello! <?= $rowA["shop_name"] ?>
                                </span>
                                <img class="img-profile rounded-circle" src="./asset/img/<?= $rowA["shop_img"] ?>" />
                            </div>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- 登出 -->
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                            <!-- 登出結束 -->


                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">商品管理列表 <span style="color: red;font-size:1rem"><?php echo isset($certified_error) ? $certified_error : "" ?></span></h1>
                        <div class="d-sm-flex align-items-center justify-content-end mb-4 ">
                            <a class="btn btn-danger text-white btn-no-border shadow-sm mx-2" href="./delete-product-manage.php" title="已刪除的商品 ">已刪除的商品 <i class="bi bi-trash3"></i></a>

                            <a class="btn btn-success text-white btn-no-border  shadow-sm" href="./add-food.php" title="增加商品">增加商品 <i class="bi bi-plus-circle"></i></a>
                        </div>

                    </div>


                    <!-- Content Row -->
                    <div class="container-fluid">
                        <div class="py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <!-- 回首頁按鈕，如果有search這個時才需要出現 -->
                                <?php
                                if (isset($_GET["search"])) : ?>
                                    <!-- 增加一個返回的按鈕 -->
                                    <a class="btn btn-info text-white" href="product-manage.php" title="返回全部商品列表">
                                        <i class="bi bi-arrow-left"></i>
                                    </a>
                                <?php endif; ?>
                                <!-- 顯示搜尋的結果 -->
                                <?php
                                if (isset($_GET["search"])) : ?>
                                    搜尋 <?= $_GET["search"] ?>
                                    的結果,
                                <?php endif; ?>
                                <!-- 共有幾筆 -->
                                本頁有 <?= $nowTotalProduct  ?> 筆，本餐廳的食物品項共有<?= $totalProduct ?>筆

                            </div>
                        </div>
                        <!-- 搜尋 -->
                        <div class="py-2">
                            <form action="">
                                <div class="d-flex">
                                    <input type="text" class="form-control" placeholder="搜尋您要找的商品" name="search">
                                    <button class="btn btn-info text-white mx-1" type="submit" id=""><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <?php if (!isset($_GET["search"])) : ?>
                            <div class="pb-2 d-flex justify-content-end align-items-center">

                                <!-- 增加升冪降冪的按鈕 -->
                                <div class="btn-group mx-1">
                                    <!-- 編號由小到大排列 -->
                                    <a class="btn btn-warning text-white btn-no-border <?php if ($order == 1) echo "active" ?>" href="product-manage.php?page=<?= $page ?>&order=1">售價<i class="bi bi-sort-numeric-down"></i></a>
                                    <!-- 編號由大到小排列 -->
                                    <a class="btn btn-warning text-white btn-no-border <?php if ($order == 2) echo "active" ?>" href="product-manage.php?page=<?= $page ?>&order=2">售價<i class="bi bi-sort-numeric-down-alt"></i></a>
                                </div>
                                <div class="btn-group mx-1">
                                    <!-- 更新時間由舊到新排列 -->
                                    <a class="btn btn-warning text-white btn-no-border <?php if ($order == 3) echo "active" ?>" href="product-manage.php?page=<?= $page ?>&order=3"><i class="bi bi-caret-left-fill"></i>更新時間</a>
                                    <!-- 更新時間由新到舊排列 -->
                                    <a class="btn btn-warning text-white btn-no-border <?php if ($order == 4) echo "active" ?>" href="product-manage.php?page=<?= $page ?>&order=4">更新時間<i class="bi bi-caret-right-fill"></i></a>
                                </div>

                            </div>
                        <?php endif ?>

                        <!-- 食物分類Nav bar -->
                        <ul class="nav nav-tabs">
                            <!-- 全品項 -->
                            <li class="nav-item">
                                <a class="nav-link <?php if (!isset($_GET["category"])) echo "active"; ?>" aria-current="page" href="product-manage.php">全品項</a>
                            </li>
                            <!-- 其他分類 -->
                            <?php foreach ($rowsCategory as $category) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($_GET["category"]) && $_GET["category"] == $category["id"]) echo "active"; ?>" href="product-manage.php?category=<?= $category["id"] ?>"><?= $category["name"] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>


                        <?php if ($totalProduct > 0) : ?>
                            <!-- 用表格呈現資料庫內容 -->
                            <table class="table table-bordered table-striped overflow-auto">
                                <!-- 表格的title -->
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">圖片</th>
                                        <th style="width: 45%;">商品名稱</th>
                                        <th style="width: 10%;">分類</th>
                                        <th style="width: 5%;">價格</th>
                                        <th style="width: 10%;">更新時間</th>
                                        <th style="width: 10%;">修改</th>

                                    </tr>
                                </thead>
                                <!-- 表格的內容 -->
                                <tbody>
                                    <?php foreach ($rows as $row) : ?>
                                        <tr>
                                            <td>
                                                <img class="object-fit-cover" src="../foodimg/<?= $row["food_img"] ?>" alt="">
                                            </td>
                                            <td>
                                                <a href="#">
                                                    <h5><?= $row["food_name"] ?></h5>
                                                </a>
                                                <?= $row["food_intro"] ?>
                                            </td>
                                            <td>
                                                <!-- 這裡接的是外鍵的category.name -->
                                                <?= $row["name"] ?>
                                            </td>
                                            <td>
                                                <?= $row["food_price"] ?>
                                            </td>
                                            <td>
                                                <?= $row["modified_at"] ?>
                                            </td>
                                            <td class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <!-- 修改按鈕 -->

                                                <!-- ????????????????????????? -->
                                                <a class="btn btn-info text-white mx-1" href="doFood-edit.php?food_id=<?= $row["food_id"] ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <!-- 刪除按鈕 -->
                                                <button type="button" data-toggle="modal" data-target="#alertModal" class="btn btn-danger text-white mx-1">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            目前無使用者
                        <?php endif; ?>

                        <!-- 分頁按鈕 -->
                        <!-- 當搜尋頁面的時候，不要有分頁 -->
                        <?php if (!isset($_GET["search"])) : ?>
                            <div class="py-2 d-flex justify-content-end mb-4">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                            <li class="page-item <?php if ($page == $i) echo "active"; ?>">
                                                <a class="page-link" href="product-manage.php?page=<?= $i ?>&order=<?= $order ?>>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>

                                    </ul>
                                </nav>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <!--內容包裝結束-->
            </div>
            <!--頁尾包裝器-->

            <!--捲動到頂部按鈕-->
            <!-- <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a> -->






            <!-- 加入bs5的連結 -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
            </script>
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>



        </div>


</body>

</html>