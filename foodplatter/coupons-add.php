<?php
session_start();

if (!isset($_SESSION["admin"])) {
  header("location:login.php");
  exit;
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

  <title>優惠卷新增</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
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
      <li class="nav-item active">
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
      <!--側邊攔項目-->
      <li class="nav-item">
        <a class="nav-link" href="rejectCert.php?var=3">
          <i class="bi bi-arrow-repeat"></i>
          <span>複審核管理</span></a>
      </li>
      <!--側邊攔項目-->
      <li class="nav-item">
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
            <a class="collapse-item" href="coupons-edit.php">優惠卷修改、刪除</a>
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
          <!-- 返回優惠卷列表 -->
          <a type="button" class="btn btn-secondary mx-3" href="coupons.php">回上一頁</a>
          <?php
          if (isset($_SESSION["error"]["message"])) : ?>
            <div class="text-danger"><?php echo $_SESSION["error"]["message"] ?></div>
          <?php endif; ?>
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

        <!-- Begin Page Content -->
        <div class="container">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">優惠卷新增</h1>
          </div>
          <!-- 優惠卷新增表單 -->
          <div class="card p-5 mb-5">
            <form action="doAddCoupon.php" method="post">
              <div class="mb-3">
                <label for="coupon_name" class="form-label">優惠卷名稱</label>
                <input type="text" class="form-control" id="coupon_name" name="coupon_name" placeholder="請輸入優惠卷名稱" />
              </div>
              <div class="mb-3">
                <label for="coupon_introduce" class="form-label">優惠卷介紹</label>
                <textarea class="form-control" id="coupon_introduce" name="coupon_introduce" rows="3" placeholder="請輸入優惠卷介紹"></textarea>
              </div>
              <div class="mb-3">
                <label for="coupon_code" class="form-label">優惠卷代碼</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="請輸入優惠卷代碼" />
                <a type="button" class="btn text-info" onclick="generateRandomCode()">產生隨機代碼</a>
                <!-- 登出彈出視窗結束 -->
                <script>
                  function generateRandomCode() {
                    // 生成隨機代碼的函數
                    var randomCode = generateRandomString(10); // 這裡的8表示生成10位的亂碼，你可以根據需要調整

                    // 將隨機代碼設置到input元素中
                    document.getElementById('coupon_code').value = randomCode;
                  }

                  function generateRandomString(length) {
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for (var i = 0; i < length; i++) {
                      result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                  }
                </script>
              </div>
              <div class="mb-3">
                <label for="coupon_threshold" class="form-label">優惠卷低消門檻(選填)</label>
                <input type="text" class="form-control" id="coupon_threshold" name="coupon_threshold" placeholder="請輸入優惠卷低消門檻(選填)" />
              </div>

              <div class="mb-3">
                <label for="coupon_discount" class="form-label">優惠卷折扣金額</label>
                <input type="text" class="form-control" id="coupon_discount" name="coupon_discount" placeholder="請輸入優惠卷折扣金額" />
              </div>
              <div class="mb-3">
                <label for="coupon_start" class="form-label">優惠卷使用日期</label>
                <div class="d-flex align-items-center">
                  <input id="coupon_start" name="coupon_start" type="date" class="form-control" />
                  <div class="mx-3">~</div>
                  <input id="coupon_exp" name="coupon_exp" type="date" class="form-control" />
                </div>
                <script>
                  //取得日期輸入元素
                  const coupon_startInput = document.getElementById('coupon_start');
                  const coupon_expInput = document.getElementById('coupon_exp');

                  //新增事件監聽器，當日期改變時觸發
                  coupon_startInput.addEventListener('input', updateDateRange);
                  coupon_expInput.addEventListener('input', updateDateRange);

                  //更新日期範圍的驗證
                  function updateDateRange() {
                    const coupon_start = new Date(coupon_startInput.value);
                    const coupon_exp = new Date(coupon_expInput.value);

                    //如果結束日期小於開始日期，則將結束日期設為開始日期
                    if (coupon_exp < coupon_start) {
                      coupon_expInput.value = coupon_startInput.value;
                    }
                  }
                </script>
              </div>
              <div class="mb-3">
                <label for="coupon_max_count" class="form-label">總數量</label>
                <input type="text" class="form-control" id="coupon_max_count" name="coupon_max_count" placeholder="請輸入總數量" />
              </div>
              <div class="mb-3">
                <label for="coupon_used_count" class="form-label">每一用戶使用次數</label>
                <input type="text" class="form-control" id="coupon_used_count" name="coupon_used_count" placeholder="請輸入每一用戶使用次數" />
              </div>

              <!-- 儲存和取消按鈕 -->
              <div class="py-2 d-flex justify-content-end">
                <div>
                  <a class="btn btn-success text-white" href="coupons.php">取消</a>
                  <button class="mx-3 btn btn-success text-white" type="submit">儲存</button>
                </div>
              </div>
            </form>
          </div>
          <!-- ******************************************************** -->
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
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
          <a class="btn btn-primary" href="doSignout.php">登出</a>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>