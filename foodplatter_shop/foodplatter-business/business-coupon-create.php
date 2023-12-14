<?php
require_once('./asset/connect/pdo_connect.php');
session_start();
if (isset($_SESSION["certified"]["error"])) {
  $certified_error = $_SESSION["certified"]["error"];
}
$shop_id=$_SESSION['user']['shop_id'];
$sqlA = "SELECT * FROM shopinfo WHERE shop_id=:shop_id";
$stmt = $pdo->prepare($sqlA);
$stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$stmt->execute();
$rowA = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>八方雲集後台系統</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <link  rel="stylesheet" href="btn-business.css" >
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

      <!--導航項目 -表格-->
      <li class="nav-item">
        <a class="nav-link" href="product-manage.php">
          <i class="bi bi-shop"></i>
          <span>商品管理</span></a>
      </li>
      <!--導航項目 -表格-->
      <li class="nav-item active">
        <a class="nav-link" href="./business-coupon.php">
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
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!--下拉式選單 -訊息-->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2" />
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! <?=$rowA['shop_name']?></span>
                <img class="img-profile rounded-circle" src="./asset/img/<?=$rowA["shop_img"]?>" />
              </div>

              <div class="topbar-divider d-none d-sm-block"></div>

              <a class="nav-link" href="#">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <main>
          <!-- Page Heading -->
          <h1 class="h3 mb-0 mx-4 text-gray-800">新增優惠券 <span style="color: red;font-size:1rem"><?php echo isset($certified_error) ? $certified_error : "" ?></span></h1>
          <!-- Content Row -->
          <form class="row p-5 need-validation" id="coupon-info" method="post" action="doCreateCoupon.php" novalidate>
            <div class="mb-3 col-12">
              <label for="coupon-name" class="form-label">優惠券名稱</label>
              <select class="custom-select" id="coupon-name" name="coupon-name" required>
                <option value="" selected>請選擇</option>
                <option value="滿額折價券">滿額折價券</option>
                <option value="滿額折抵券">滿額折抵券</option>
                <option value="特定商品優惠券">特定商品優惠券</option>
              </select>
              <div class="invalid-feedback">請選擇優惠券名稱</div>
            </div>
            <div class="d-none">
              <input type="text" class="form-control" id="shop-id" name="shop-id">
            </div>
            <div class="mb-3 col-12">
              <label for="coupon-intro" class="form-label">優惠說明</label>
              <input type="text" class="form-control" id="coupon-intro" name="coupon-intro"
                placeholder="中文字或英文單字，共30字以內的簡單說明" required>
              <div class="invalid-feedback">請介紹您的優惠券</div>
            </div>
            <div class="mb-3 col-4">
              <label for="coupon-threshold" class="form-label">優惠券門檻</label>
              <input type="number" class="form-control" id="coupon-threshold" name="coupon-threshold"
                placeholder="達多少元才能使用 (無門檻請填0)" required>
              <div class="invalid-feedback">請設定優惠券門檻</div>
            </div>
            <div class="mb-3 col-4">
              <label for="coupon-discount" class="form-label">優惠方式</label>
              <input type="number" class="form-control" id="coupon-discount" name="coupon-discount"
                placeholder="打折(0.9表示9折) / 折價 (直接輸入數字)" required>
              <div class="invalid-feedback">請填寫優惠方式</div>
            </div>
            <div class="mb-3 col-4">
              <label for="coupon-code" class="form-label">優惠碼</label>
              <input type="text" class="form-control" id="coupon-code" name="coupon-code" placeholder="6~10碼大寫英、數字"
                required>
              <div class="invalid-feedback">請正確填寫自訂的優惠代碼</div>
            </div>
            <div class="mb-3 col-8">
              <label for="coupon-threshold" class="form-label">優惠券有效日期</label>
              <div class="row">
                <div class="col">
                  <input type="date" class="form-control" id="coupon-start" name="coupon-start" required>
                  <div class="invalid-feedback">請選擇開始日期</div>
                </div>
                <p class="fs-3 m-2"> ~ </p>
                <div class="col">
                  <input type="date" class="form-control" id="coupon-exp" name="coupon-exp" required>
                  <div class="invalid-feedback">請選擇結束日期</div>
                </div>
              </div>
            </div>
            <div class="mb-3 col-4">
              <label for="coupon-max-count" class="form-label">發送數量</label>
              <input type="number" class="form-control" id="coupon-max-count" name="coupon-max-count" required>
              <div class="invalid-feedback">請填寫優惠券發送數量</div>
            </div>
            <div class="col d-flex justify-content-end">
              <div class="text-danger fw-500"><?php if(isset($_SEESION['error']['message'])){echo $_SESSION['error']['message'];}?></div>
              <button type="submit" id="create-coupon-btn" class="btn btn-business mx-2">新增</button>
              <a href="business-coupon.php" class="btn btn-danger">取消</a>
            </div>
          </form>
        </main>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
          <a class="btn btn-primary" href="doLogOut.php">Logout</a>
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

  <!-- 表單資料驗證 -->
  <script>
    // 抓取表單內各項內容
    const couponName = document.querySelector("#coupon-name");
    const couponIntro = document.querySelector("#coupon-intro");
    const couponThreshold = document.querySelector("#coupon-threshold");
    const couponDiscount = document.querySelector("#coupon-discount");
    const couponCode = document.querySelector("#coupon-code");
    const couponStart = document.querySelector("#coupon-start");
    const couponExp = document.querySelector("#coupon-exp");
    const couponMaxCount = document.querySelector("#coupon-max-count");
    const createCouponBtn = document.querySelector("#create-coupon-btn");
    // 設定資料驗證

    createCouponBtn.addEventListener("click", function (event) {
      event.preventDefault();

      // 各表單欄位的正則表達式
      const couponIntroRegExp = /^[\u4e00-\u9fa5\u2000-\u206Fa-zA-Z0-9'"%$#@!&*.~]{1,30}$/;
      const couponThresholdRegExp = /^\d+$/;
      const couponDiscountRegExp = /^0(\.\d{1,2})?$|^[1-9]\d*$/;
      const couponCodeRegExp = /[A-Z0-9]{6,10}/;
      const dateRegExp = /^\d{4}-\d{2}-\d{2}$/;
      const couponMaxCountRegExp = /^[1-9]\d*$/;

      // 如果未通過驗證，則添加 class="is-invalid"
      const couponIntroValid = couponIntroRegExp.test(couponIntro.value);
      const couponThresholdValid = couponThresholdRegExp.test(couponThreshold.value);
      const couponDiscountValid = couponDiscountRegExp.test(couponDiscount.value);
      const couponCodeValid = couponCodeRegExp.test(couponCode.value);
      const couponStartValid = dateRegExp.test(couponStart.value);
      const couponExpValid = dateRegExp.test(couponExp.value);
      const couponMaxCountValid = couponMaxCountRegExp.test(couponMaxCount.value);

      if (couponName.value == "") {
        couponName.classList.remove("is-valid");
        couponName.classList.add("is-invalid");
      } else {
        couponName.classList.remove("is-invalid");
        couponName.classList.add("is-valid");
      }

      if (!couponIntroValid) {
        couponIntro.classList.remove("is-valid");
        couponIntro.classList.add("is-invalid");
      } else {
        couponIntro.classList.remove("is-invalid");
        couponIntro.classList.add("is-valid");
      }

      if (!couponThresholdValid) {
        couponThreshold.classList.remove("is-valid");
        couponThreshold.classList.add("is-invalid");
      } else {
        couponThreshold.classList.remove("is-invalid");
        couponThreshold.classList.add("is-valid");
      }

      if (!couponDiscountValid) {
        couponDiscount.classList.remove("is-valid");
        couponDiscount.classList.add("is-invalid");
      } else {
        couponDiscount.classList.remove("is-invalid");
        couponDiscount.classList.add("is-valid");
      }

      if (!couponCodeValid) {
        couponCode.classList.remove("is-valid");
        couponCode.classList.add("is-invalid");
      } else {
        couponCode.classList.remove("is-invalid");
        couponCode.classList.add("is-valid");
      }

      if (!couponStartValid) {
        couponStart.classList.remove("is-valid");
        couponStart.classList.add("is-invalid");
      } else {
        couponStart.classList.remove("is-invalid");
        couponStart.classList.add("is-valid");
      }

      if (!couponExpValid) {
        couponExp.classList.remove("is-valid");
        couponExp.classList.add("is-invalid");
      } else {
        couponExp.classList.remove("is-invalid");
        couponExp.classList.add("is-valid");
      }

      if(couponStart.value>couponExp.value){
        couponStart.classList.remove("is-valid");
        couponExp.classList.remove("is-valid");
        couponStart.classList.add("is-invalid");
        couponExp.classList.add("is-invalid");
      }else{
        couponStart.classList.remove("is-invalid");
        couponExp.classList.remove("is-invalid");
        couponStart.classList.add("is-valid");
        couponExp.classList.add("is-valid");
      }

      if (!couponMaxCountValid) {
        couponMaxCount.classList.remove("is-valid");
        couponMaxCount.classList.add("is-invalid");
      } else {
        couponMaxCount.classList.remove("is-invalid");
        couponMaxCount.classList.add("is-valid");
      }

      if(couponName.value != "" && couponIntroValid && couponThresholdValid && couponDiscountValid && couponCodeValid  && couponStartValid && couponExpValid && couponStart.value<couponExp.value && couponMaxCountValid){
        document.querySelector("#coupon-info").submit();
      }
    });
  </script>
</body>

</html>