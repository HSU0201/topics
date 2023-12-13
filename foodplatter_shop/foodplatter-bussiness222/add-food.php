<?php
require_once("../foodplatter_connect.php");


session_start();
//後端驗證


$id = 2;
$sql = "SELECT food_list.* ,food_category.* FROM food_list JOIN food_category ON food_list.category_id = food_category.foodCategory_id WHERE food_list.food_id = $id";

//$result = $conn->query($sql);
$resultCategory = $conn->query($sql);

$rows = $resultCategory->fetch_all(MYSQLI_ASSOC);

//echo var_dump($rows);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>八方雲集</title>

    <!--此模板的自訂字體-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <!--  -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- 新的fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!--此模板的自訂樣式-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body id="page-top">

    <!-- 登出彈出視窗 -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">確定要離開嗎?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">確定要離開嗎?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        取消
                    </button>
                    <a class="btn btn-primary" href="login.php">登出</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 登出彈出視窗結束 -->


    <!--頁面包裝器-->
    <div id="wrapper" class="goodnav">
        <!--側邊欄-->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!--側邊欄 -品牌-->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-slack"></i>
                </div>
                <div class="sidebar-brand-text mx-3">foodplatter</div>
            </a>

            <!--分音器-->
            <hr class="sidebar-divider my-0" />

            <!--導航項目 -儀表板-->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <span><i class="bi bi-house-fill"></i>&nbsp;&nbsp;主頁</span>
                </a>
            </li>

            <!--分音器-->
            <hr class="sidebar-divider" />

            <!--標題-->
            <div class="sidebar-heading">管理系統</div>

            <!--導航項目 -表格-->
            <li class="nav-item active">
                <a class="nav-link" href="./product-manage.html">
                    <i class="bi bi-shop"></i>
                    <span>商品管理</span></a>
            </li>
            <!--導航項目 -表格-->
            <li class="nav-item">
                <a class="nav-link" href="./bussiness-coupon.html">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! 八方雲集急急急</span>
                                <img class="img-profile rounded-circle" src="/images/888.png" />
                            </div>

                            <div class="topbar-divider d-none d-sm-block"></div>
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">新增商品</h1>
                    </div>

                    <div class="py-2 ">
                        <!--  -->
                        <a class="btn  text-white" id="btn-color" href="#" title="回到使用者列表">
                            回商品列表
                        </a>
                    </div>

                    <!-- 後端驗證訊息 -->
                    <?php if (isset($_SESSION["error"]["message"])) : ?>
                        <div class="text-danger"><?= $_SESSION["error"]["message"] ?></div>
                    <?php endif; ?>

                    <!-- 上傳非文字必須加入 enctype -->
                    <form action="./doAddFood.php" method="post" class="row-sm-2 row-form-label py-5" enctype="multipart/form-data">
                        <label for="food_name" class="row-sm-2 row-form-label py-2">商品名稱</label>
                        <div class="row-sm-6">

                            <input type="text" class="form-control" id="food_name" name="food_name" placeholder="輸入商品名稱(必填)">
                        </div>

                        <label for="food_category" class="row-sm-2 row-form-label py-2">商品分類</label>
                        <div class="dropdown">


                            <!-- 商家食品類別分類 -->
                            <select class="form-select " id="food_category" name="food_category">
                                <option value="">商品類別...</option>

                                <?php foreach ($rows as $row) : ?>
                                    <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!--  -->

                        </div>

                        <label for="food_intro" class="row-sm-2 row-form-label py-2">商品介紹</label>
                        <div class="row-sm-6">
                            <textarea class="form-control" id="food_intro" name="food_intro" rows="3" placeholder="輸入產品介紹" style="resize: none"></textarea>
                        </div>

                        <label for="food_note" class="row-sm-2 row-form-label py-2">商品備註</label>
                        <div class="row-sm-6">
                            <input type="text" class="form-control" id="food_note" name="food_note" placeholder="輸入商品備註" />
                        </div>

                        <label for="food_price" class="row-sm-2 row-form-label py-2">商品售價</label>
                        <div class="row-sm-6">
                            <input type="text" class="form-control" id="food_price" name="food_price" placeholder="輸入商品售價(必填)" autocomplete="off">
                        </div>

                        <label for="food_img" class="row-form-label row-sm-2 py-2">商品圖片</label>

                        <div class="row-6">

                            <input type="file" class="form-control" onchange="readURL(this)" targetID="preview_progressbarTW_img" accept="image/gif, image/jpeg, image/png" name="food_img" id="food_img" autocomplete="off">

                        </div>

                        <label for="food_price" class="row-sm-2 row-form-label py-2">預覽圖片</label>
                        <!-- <div class="row-sm-6 "> -->
                        <div class="row-sm-6 ">
                            <img style="max-width: 400px" src="/images/777.jpeg" id="preview_progressbarTW_img" alt="" required>
                        </div>

                        <div class="row-sm-2 row-form-label mt-4 py-2">
                            <button class="btn text-white" type="submit" id="btn-color" title="確認送出">
                                送出
                            </button>
                        </div>
                    </form>
                </div>

                <!--頁尾包裝器-->

                <!--捲動到頂部按鈕-->
                <!-- <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a> -->


                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>

                <!-- 新增的 -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

                <!-- 預覽圖片 script -->
                <script>
                    function readURL(input) {

                        if (input.files && input.files[0]) {

                            var imageTagID = input.getAttribute("targetID");

                            var reader = new FileReader();

                            reader.onload = function(e) {

                                var img = document.getElementById(imageTagID);

                                img.setAttribute("src", e.target.result)

                            }

                            reader.readAsDataURL(input.files[0]);

                        }

                    }
                </script>

                <!-- 加入bs5的連結 -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
                </script>
                <!--  -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                <!--  -->

</body>

</html>