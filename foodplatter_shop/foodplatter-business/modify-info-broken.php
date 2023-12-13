<?php
require_once("./asset/connect/db_connect.php");
$id = 2;
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

  <title>八方雲集後台系統</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="./asset/css/main.css" />
  <style>
    img {
      width: 10vw;
      border-radius: 30px;
    }



    input {
      margin-left: -2rem;
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
          <button class="btn btn-cancel" type="button" data-dismiss="modal">
            取消
          </button>
          <a class="btn btn-primary " href="./business-login.php">登出</a>
        </div>
      </div>
    </div>
  </div>
  <!-- 登出彈出視窗結束 -->
  <!-- 確認修改彈出視窗 -->
  <!-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">確認更改店家資訊</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-danger">
          <p>您確認要更改商家資訊嗎？更改後店家將會進入審核狀態並且下架 <br>
            若您已經確定好更改的詳細資訊請按下"確定更改以及同意下架"</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cancel" data-dismiss="modal">取消</button>
          <button type="submit" class="btn bg-danger">確定更改以及同意下架</button>
        </div>
      </div>
    </div>
  </div> -->
  <!-- 確認修改彈出視窗結束 -->
  <!--頁面包裝器-->
  <div id=" wrapper" class="goodnav">
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
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">
          <span><i class="bi bi-house-fill"></i>&nbsp;&nbsp;主頁</span>
        </a>
      </li>

      <!--分音器-->
      <hr class="sidebar-divider" />

      <!--標題-->
      <div class="sidebar-heading">管理系統</div>

      <!--導航項目 -表格-->
      <li class="nav-item">
        <a class="nav-link" href="./product-manage.html">
          <i class="bi bi-shop"></i>
          <span>商品管理</span></a>
      </li>
      <!--導航項目 -表格-->
      <li class="nav-item">
        <a class="nav-link" href="./business-coupon.html">
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
              <a class="nav-link dropdown-toggle" href="" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! 八方雲集急急急</span>
                <img class="img-profile rounded-circle" src="./asset/img/eightCloud.jpg" />
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
          <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">


              <p class="h2 mb-0 text-gray-800">詳細資訊</p>
             
            </div>
            <div class="infomation">
              <div class="card-body row">
                <div class="container-fluid row col-4 align-items-center justify-content-center" style="margin-inline: -1rem 1rem">
                  <img id="preview_product_image" class="business-img col-12" style="height: 300px; margin: 1rem" src="./asset/img/<?= $row["shop_img"] ?>" />

                  <input class="col-8 btn" type="file" name="product_image" data-target="preview_product_image" style="margin-top: -3rem" />
                </div>
                <script>
                  var input = document.querySelector('input[name=product_image]');
                  input.addEventListener("change", function(e) {
                    readURL(e.target);
                  })

                  function readURL(input) {
                    if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                        var imgId = input.getAttribute('data-target')
                        var img = document.querySelector('#' + imgId)
                        img.setAttribute('src', e.target.result);
                      }
                      reader.readAsDataURL(input.files[0]);
                    }
                  }
                </script>
                <table class="table col-lg-8">
                  <tr>
                    <th scope="row" style="width: 100px" class="">
                      店家名稱：
                    </th>
                    <td class="">
                      <input name="shop_name" type="text" style="width: 100%" value="<?= $row["shop_name"] ?>" />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">店家地址：</th>
                    <td class="col-10">
                      <select class="col-2" name="" id="" style="margin-right: 1rem; margin-left: -2rem"></select>
                      <select class="col-2" name="" id=""></select>
                      <input name="address" type="text" class="col-7" style="width: 100%; margin-left: 0.5rem" value="<?= $row["address"] ?>" />
                    </td>
                  </tr>

                  <tr>
                    <th scope="row">店家電話：</th>
                    <td>
                      <input name="shop_tel" type="text" style="width: 37%" value="<?= $row["shop_tel"] ?>" />
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">店家分類：</th>
                    <td class="col-10">
                      <select class="col-2" name="" id="" style="margin-right: 1rem; margin-left: -2rem"></select>
                      <select class="col-2" name="" id=""></select>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">店家信箱：</th>
                    <td class="col-10">
                      <input name="shop_email" type="text" style="width: 60%" value="<?= $row["shop_email"] ?>" />
                    </td>
                  </tr>

                  <tr>
                    <th scope="row" class="">銀行帳號：</th>
                    <td class="">
                      <input name="bank_account" type="text" style="width: 37%" value="<?= $row["bank_account"] ?>" />
                    </td>
                  </tr>

                  <tr>
                    <th scope="row">統一編號：</th>

                    <td><?= $row["shop_tax"] ?></td>
                  </tr>

                  <tr>
                    <th scope="row">創建時間：</th>
                    <td><?= $row["created_at"] ?></td>
                  </tr>

                  <tr>
                    <th scope="row">最後修改：</th>
                    <td><?= $row["modified_at"] ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </main>

        <article class="container-fluid row justify-content-center">
          <p class="h2 mb-0 text-gray-800 mt-2 mb-4 col-12">店家介紹</p>

          <textarea class="h6 col-11 mb-5" style="color: black;resize:none" cols="140" rows="5"><?= $row["shop_intro"] ?></textarea>
        </article>
        </form>
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
      <!--內容包裝結束-->
    </div>
    <!--頁尾包裝器-->
  </div>

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