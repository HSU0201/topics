<?php
// 檢查是否存在 GET 參數 "id"
if (!isset($_GET["user_id"])) {
  // 如果不存在，將使用者重新導向到 coupons.php
  header("location:userstables.php");
}

// 從 GET 參數中獲取 id
$id = $_GET["user_id"];

// 引入與資料庫連接的文件
require("foodplatter_connect.php");
// 構建 SQL 查詢語句，選擇資料庫中 foodplatter 表中 id 等於 $id 且 valid 等於 1 的記錄
$sql = "SELECT * FROM users WHERE user_id=$id AND user_valid=1";
// 執行 SQL 查詢
$result = $conn->query($sql);
// 從查詢結果中獲取一行記錄的關聯數組（associative array）
$row = $result->fetch_assoc();
// 獲取查詢結果的記錄數
$userCount = $result->num_rows;
// -----------------------------------------
// 獲取總行數
$readrowsSql = "SELECT * FROM users";
$readrowsTotal = $conn->query($readrowsSql);
$totalrows = $readrowsTotal->num_rows;
echo $totalrows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Foodplatter我的會員</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <style>
    .card-body {
      & img {
        width: 400px;
        height: 400px;
      }
    }
  </style>
</head>

<body id="page-top">
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

      <!--分隔線-->
      <hr class="sidebar-divider my-0" />

      <!--導航項目 -首頁-->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>首頁</span>
        </a>
      </li>

      <!--分隔線-->
      <hr class="sidebar-divider" />

      <!--標題-->
      <div class="sidebar-heading">用戶管理</div>

      <!--側邊攔項目-->
      <li class="nav-item">
        <a class="nav-link" href="shopstables.php">
          <i class="bi bi-shop"></i>
          <span>商家管理</span></a>
      </li>
      <!--側邊攔項目-->
      <li class="nav-item">
        <a class="nav-link" href="certificationtables.php">
          <i class="bi bi-patch-exclamation"></i>
          <span>認證管理</span></a>
      </li>


      <!--側邊攔項目-->
      <li class="nav-item">
        <a class="nav-link" href="rejectCert.php?var=3">
          <i class="bi bi-arrow-repeat"></i>
          <span>複審核管理</span></a>
      </li>
      <!--側邊攔項目-->
      <li class="nav-item active">
        <a class="nav-link" href="userstables.php">
          <i class="bi bi-person-rolodex"></i>
          <span>會員管理</span></a>
      </li>

      <!--分隔線-->
      <hr class="sidebar-divider" />

      <!--標題-->
      <div class="sidebar-heading">策略行銷</div>

      <!--側邊攔項目-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseCoupon" aria-expanded="true" aria-controls="collapseCoupon" href="coupons.php">
          <i class="bi bi-ticket-perforated"></i>
          <span>優惠卷管理</span>
        </a>
        <div id="collapseCoupon" class="collapse" aria-labelledby="headingCoupon" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">優惠卷管理</h6>
            <a class="collapse-item" href="coupons.php">優惠卷</a>
            <a class="collapse-item" href="coupons-add.php">優惠卷新增</a>
            <a class="collapse-item" href="coupons.php">優惠卷修改、刪除</a>
          </div>
        </div>
      </li>

      <!--分隔線-->
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
          <!-- 返回按鈕 -->
          <a class="btn btn-outline-secondary d-flex align-items-center " href="userstables.php"><i class="bi bi-arrow-bar-left fa-2x "></i>回會員列表</a>
          <!-- 返回按鈕 -->
          <!-- 搜尋列 -->
          <div class="d-flex align-items-center">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light small" placeholder="搜尋使用者" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>

            <!-- 人數 -->
            <?php
            $userCount = $result->num_rows;
            ?>
          </div>

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! administrator</span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
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



        <!-- 頁面內容開始 -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">詳細資訊</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-12">
              <div class="d-flex align-items-center">
                <!-- 按鈕 -->
                <button class="btn mx-1" onclick="updateMinusUserId()"><i class="bi bi-chevron-double-left fa-2x"></i></button>
                <div class="col card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                      會員資料
                    </h6>
                  </div>
                  <!-- Card Body -->
                  <div class="d-flex card-body row pr-5 justify-content-between">
                    <div class="col-6 d-flex justify-content-center align-items-center">
                      <img class="img-profile rounded-circle" src="<?= $row["user_img"] ?>" />
                    </div>
                    <div class="col-6">
                      <table class="table  justify-content-end">
                        <tr>
                          <th scope="row">姓名</th>
                          <td><?= $row["user_name"] ?></td>
                        </tr>

                        <tr>
                          <th scope="row">性別</th>
                          <td><?php
                              if ($row["user_sex"] == null) {
                                echo "尚未填寫";
                              } elseif ($row["user_sex"] == 0) {
                                echo "生理男";
                              } elseif ($row["user_sex"] == 1) {
                                echo "生理女";
                              } else {
                                echo "尚未填寫";
                              }
                              ?></td>
                        </tr>

                        <tr>
                          <th scope="row">生日</th>
                          <td><?php
                              if ($row["user_birth"] == null || $row["user_birth"] == "0000-00-00") {
                                echo '尚未填寫';
                              } else {
                                echo $row["user_birth"];
                              }
                              ?></td>
                        </tr>
                        <tr>
                          <th scope="row">信箱</th>
                          <td><?= $row["user_email"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">電話</th>
                          <td><?= $row["user_phone"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">地址</th>
                          <td><?php
                              if ($row["user_address_all"] == null || $row["user_address_all"] == "") {
                                echo '尚未填寫';
                              } else {
                                echo $row["user_address_all"];
                              }
                              ?></td>
                        </tr>
                        <tr>
                          <th scope="row">創建時間</th>
                          <td><?= $row["created_at"] ?></td>
                        </tr>
                        <tr>
                          <th scope="row">上次修改時間</th>
                          <td><?php
                              if ($row["modified_at"] === null) {
                                echo '尚未修改';
                              } else {
                                echo $row["modified_at"];
                              }
                              ?></td>
                        </tr>
                      </table>
                    </div>

                  </div>
                  <!-- card body -->
                </div>
                <!-- 按鈕 -->
                <button class="btn mx-1" onclick="updateAddUserId()"><i class="bi bi-chevron-double-right fa-2x "></i></button>
              </div>
            </div>



          </div>

          <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function updateAddUserId() {
      var currentUserId = <?php echo $id; ?>;
      var newUserId = currentUserId + 1;
      var totalrows = <?php echo $totalrows?>;
      if (newUserId >= totalrows) {
        window.location.href = 'usersindex.php?user_id=<?php echo $totalrows?>';
      } else {
        window.location.href = 'usersindex.php?user_id=' + newUserId;
      }
    }

    function updateMinusUserId() {
      var currentUserId = <?php echo $id; ?>;
      var newUserId = currentUserId - 1;
      if (newUserId > 0) {
        window.location.href = 'usersindex.php?user_id=' + newUserId;
      } else {
        window.location.href = 'usersindex.php?user_id=1';
      }
    }
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
</body>

</html>