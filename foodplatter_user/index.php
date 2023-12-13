<?php
session_start();

if(!isset($_SESSION["user"])){
    header("location:user_signin.php");
    exit;
}

require_once("db-connect.php");

unset($_SESSION["error"]);

$id=$_SESSION["user"]["user_id"];


$sql="SELECT * FROM users WHERE user_id=$id AND user_valid=1";

$result=$conn->query($sql);
$userCount=$result->num_rows;
$row=$result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Foodplatter我的會員</title>

    <!--此模板的自訂字體-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!--此模板的自訂樣式-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <style>

      .card-body{
        & img{
          width: 400px;
          height: 400px;
        }
      }
      
    </style>
  </head>

  <body id="page-top">
    <!-- 登出彈出視窗 -->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">確定要登出嗎?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            如果您正準備登出，請點選下面的「登出」。
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              取消
            </button>
            <a class="btn btn-primary" href="UserSignout.php">登出</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 登出彈出視窗結束 -->

    <!--頁面包裝器-->
    <div id="wrapper" class="">
      <!--側邊欄-->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!--側邊欄 -品牌-->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.html"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="bi bi-slack"></i>
          </div>
          <div class="sidebar-brand-text mx-3">foodplatter</div>
        </a>

        <div class="d-flex align-items-center justify-content-center row">
          <img
            class="img-profile rounded-circle col-7 py-3"
            src="<?= $row["user_img"] ?>"
          />

          <span class="text-white col-12 text-center py-3">Hello ! <?= $row["user_name"]?></span>
        </div>

        
        <!--分音器-->
        <hr class="sidebar-divider my-0" />

        <!--導航項目 -儀表板-->
        <li class="nav-item active">
          <a class="nav-link" href="user_index.php">
            <i class="bi bi-house"></i>
            <span>會員資料</span>
          </a>
        </li>

        <!--分音器-->
        <hr class="sidebar-divider" />
        

        <!--導航項目 -表格-->
        <li class="nav-item">
          <a class="nav-link" href="user_order.php">
            <i class="bi bi-file-earmark"></i>
            <span>訂單</span></a
          >
        </li>
        <!--導航項目 -表格-->
        <li class="nav-item">
          <a class="nav-link" href="user_coupon.php">
            <i class="bi bi-ticket-perforated"></i>
            <span>優惠券</span></a
          >
        </li>

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
          <nav
            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
          >
            <!--側邊欄切換（頂欄）-->
            <button
              id="sidebarToggleTop"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>

            <!--頂欄中級-->
            <ul class="navbar-nav ml-auto">
              <!--導航項目 -搜尋下拉式選單（僅 XS 可見）-->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!--下拉式選單 -訊息-->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input
                        type="text"
                        class="form-control bg-light border-0 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
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
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >Hello ! <?= $row["user_name"]?></span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="<?= $row["user_img"] ?>"
                  />
                </div>

                <div class="topbar-divider d-none d-sm-block"></div>

                <a class="nav-link"
                href="#"
                data-toggle="modal"
                data-target="#logoutModal">
                  <i
                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                  ></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->



          <!-- 頁面內容開始 -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-between mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">詳細資訊</h1>
              <a
                href="user_edit.php"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                ><i class="bi bi-pencil-square"></i> 編輯</a
              >
            </div>


            

            

            <!-- Content Row -->

            <div class="row ">
              <!-- Area Chart -->
              <div class="col-12">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      會員資料
                    </h6>
                    
                  </div>

                  <!-- Card Body -->
                  <div class="card-body row pr-5">
                    <div class="col-4 d-flex justify-content-center align-items-center">
                      <img
                      class="img-profile rounded-circle"
                      src="<?= $row["user_img"] ?>"
                    />

                    </div>

                    <table class="table col-8">

                      <tr>
                        <th scope="row">姓名</th>
                        <td><?= $row["user_name"]?></td>
                      </tr>

                      <tr>
                        <th scope="row">性別</th>
                        <td><?php 
                        if($row["user_sex"]== null){
                          echo "尚未填寫";
                        }elseif($row["user_sex"]== 0){
                          echo "生理男";
                        }elseif($row["user_sex"]== 1){
                          echo "生理女";
                        }else{
                          echo "尚未填寫";
                        }
                        ?></td>
                      </tr>
          
                      <tr>
                        <th scope="row">生日</th>
                        <td><?php 
                        if($row["user_birth"]== null || $row["user_birth"]== "0000-00-00"){
                          echo '尚未填寫';
                        }else{
                          echo $row["user_birth"];
                        }
                        ?></td>
                      </tr>

                      <tr>
                        <th scope="row">信箱</th>
                        <td><?= $row["user_email"]?></td>
                      </tr>

                      <tr>
                        <th scope="row">電話</th>
                        <td><?= $row["user_phone"]?></td>
                      </tr>

                      <tr>
                        <th scope="row">地址</th>
                        <td><?php 
                        if($row["user_address_all"]== null || $row["user_address_all"]==""){
                          echo '尚未填寫';
                        }else{
                          echo $row["user_address_all"];
                        }
                        
                        ?></td>
                      </tr>

                      <tr>
                        <th scope="row">創建時間</th>
                        <td><?= $row["created_at"]?></td>
                      </tr>

                      <tr>
                        <th scope="row">上次修改時間</th>
                        <td><?php 
                        if($row["modified_at"]=== null){
                          echo '尚未修改';
                        }else{
                          echo $row["modified_at"];
                        }
                        
                        ?></td>
                      </tr>

                      
                    </table>

                
                    
                  </div>
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
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
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
