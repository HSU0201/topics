<?php
require_once("./asset/connect/db_connect.php");
session_start();
if (!isset($_SESSION["user"])) {
  header("location:business-login.php");
  exit;
}


$id = $_SESSION["user"]["shop_id"];
if (isset($_SESSION["certified"]["error"])) {
  $certified_error = $_SESSION["certified"]["error"];
}

$sql = "SELECT * FROM shopinfo WHERE shop_id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?= $row["shop_name"] ?> 後台系統</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <style>
    img {
      width: 10vw;
      border-radius: 30px;
    }

    .btn {
      background: #02078e;
      border: #02078e;
      color: white !important;
    }

    .btn:hover {
      background: #0008fc;
      border: #0008fc;
    }
  </style>
  <link rel="stylesheet" href="./asset/css/main.css" />

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
          <button class="btn btn-cancel" type="button" data-dismiss="modal">
            取消
          </button>
          <a class="btn btn-primary" href="doLogout.php">登出</a>
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="bi bi-slack"></i>
        </div>
        <div class="sidebar-brand-text mx-3">foodplatter</div>
      </a>

      <!--分音器-->
      <hr class="sidebar-divider my-0" />

      <!--導航項目 -儀表板-->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <span><i class="bi bi-house-fill"></i>&nbsp;&nbsp;主頁</span>
        </a>
      </li>

      <!--分音器-->
      <hr class="sidebar-divider" />

      <!--標題-->
      <div class="sidebar-heading">管理系統</div>

      <!--導航項目 -表格-->
      <li class="nav-item">
        <a class="nav-link" href="./product-manage.php">
          <i class="bi bi-shop"></i>
          <span>商品管理</span></a>
      </li>
      <!--導航項目 -表格-->
      <li class="nav-item">
        <a class="nav-link" href="business-coupon.php">
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

              <div class="nav-link" href="" id="">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello ! <?= $row["shop_name"] ?> </span>
                <img class="img-profile rounded-circle" src="./asset/img/<?= $row["shop_img"] ?>" />
              </div>

              <div class="topbar-divider d-none d-sm-block"></div>

              <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <!--插眼 -->
        <main>
          <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4 container" style="margin-top: 3rem;">
              <p class="h2 mb-0 text-gray-800">詳細資訊 <span style="color: red;font-size:1rem"><?php echo isset($certified_error) ? $certified_error : "" ?></span></p>
              <a href="modify-info.php" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="bi bi-pencil-square"></i> 編輯</a>
            </div>
            <div class="infomation  " style="background-color: white;border-radius:20px">
              <div class="card-body row">
                <img class="business-img col-4" style="height: 20vw; margin: 1rem" src="./asset/img/<?= $row["shop_img"] ?>" />

                <table class="table col-7">
                  <tr>
                    <th scope="row" style="border-top:none">店家名稱：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["shop_name"] ?></th>
                    <td style="border-top:none"></td>
                  </tr>
                  <tr>
                    <th scope="row">店家地址：&nbsp;&nbsp;&nbsp;&nbsp;<?php
                                                                  $citiesSql = "SELECT shopinfo.*,cities.* FROM shopinfo JOIN cities ON  shopinfo.cities = cities.cities_id WHERE shop_id=$id";
                                                                  $citiesResult = $conn->query($citiesSql);
                                                                  $citiesRow =  $citiesResult->fetch_assoc();
                                                                  echo $citiesRow["cities_name"] . $citiesRow["towns_name"] . $row["address"]  ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">店家電話：&nbsp;&nbsp;&nbsp;&nbsp;0<?= $row["shop_tel"] ?></th>
                    <td></td>
                  </tr>
                  <?php
                  $shopCategorySQL = "SELECT shopinfo.*,shop_category.* FROM shopinfo JOIN shop_category ON shop_category.shopCategory_id = shopinfo.main_category WHERE shop_id = $id";
                  $shopCategoryResult = $conn->query($shopCategorySQL);
                  $shopCategoryRow = $shopCategoryResult->fetch_assoc();
                  
                  ?>
                  <tr>
                    <th scope="row">店家分類：&nbsp;&nbsp;&nbsp;&nbsp;<?= $shopCategoryRow["name_main"] . " " . $shopCategoryRow["name_sub"]; ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">店家信箱：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["shop_email"] ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">銀行帳號：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["bank_zip"] ?>&nbsp;&nbsp;<?= $row["bank_account"] ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">統一編號：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["shop_tax"] ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">創建時間：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["created_at"] ?></th>
                    <td></td>
                  </tr>

                  <tr>
                    <th scope="row">修改時間：&nbsp;&nbsp;&nbsp;&nbsp;<?= $row["modified_at"] ?></th>
                    <td></td>
                  </tr>
                </table>
              </div>
            </div>
            <article class=" row justify-content-center" style="margin-top: 2rem;">
              <p class="h2 mb-0 text-gray-800 mt-2 mb-4 col-12">店家介紹</p>

              <p class="h5 col-11 mb-5 text-secondary" style="color: black;line-height:2rem;background-color: white;border-radius:20px;padding:2rem">
                <?= $row["shop_intro"] ?>
              </p>
            </article>
          </div>
        </main>

      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Foodplatter &copy; 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!--內容包裝結束-->
  </div>
  <!--頁尾包裝器-->

  <!--捲動到頂部按鈕-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!--註銷模式-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
</body>

</html>