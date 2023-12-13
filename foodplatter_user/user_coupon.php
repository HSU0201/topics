<?php
session_start();

// 只要沒有user資料，就要回到燈入夜面
if(!isset($_SESSION["user"])){
    header("location:user_signin.php");
    exit;
}

require_once("db-connect.php");

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

    <title>Foodplatter會員優惠券</title>

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
    <div id="wrapper" class="">
      <!--側邊欄-->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!--側邊欄-品牌-->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="user_index.php"
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

        
        <hr class="sidebar-divider my-0" />

        <!--導航項目-會員頭貼-nav開始-->
        <li class="nav-item ">
          <a class="nav-link" href="user_index.php">
            <i class="bi bi-house"></i>
            <span>會員資料</span>
          </a>
        </li>

        <hr class="sidebar-divider" />

      
        <li class="nav-item">
          <a class="nav-link" href="user_order.php">
            <i class="bi bi-file-earmark"></i>
            <span>訂單</span></a
          >
        </li>
        
        <li class="nav-item active">
          <a class="nav-link" href="user_coupon.php">
            <i class="bi bi-ticket-perforated"></i>
            <span>優惠券</span></a
          >
        </li>

        <!--側邊欄切換器-->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!--側邊欄結束-->


      <!--內容-->
      <div id="content-wrapper" class="d-flex flex-column">
        
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

            <!--頂欄中間-->
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
                    >Hello ! <?=$row["user_name"]?></span
                  >
                  <img
                    class="img-profile rounded-circle"
                    src="<?= $row["user_img"]?>"
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

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div
              class="d-sm-flex align-items-center justify-content-start mb-4"
            >
              <h1 class="h3 mb-0 text-gray-800">訂單</h1>
              
            </div>

            <div class="py-2">
              <form action="">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search..." name="search">
                      <button class="btn btn-info text-white" type="submit" id=""><i class="bi bi-search"></i></button>
                  </div>
              </form>
            </div>

            <div class="pb-2 d-flex justify-content-between orders my-2">

              <div>

                <h6 class="m-0 font-weight-bold text-primary">
                  共有個結果
                </h6>
              </div>
              <div class="btn-group">
                  
      
                  <a class="btn btn-info text-white" href="">date<i class="bi bi-sort-down-alt"></i></a>
      
                  <a class="btn btn-info text-white" href="">date<i class="bi bi-sort-down-alt"></i></a>
      
              </div>
              
            </div>

            
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <ul class="nav nav-tabs my-1">
                  <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="">全部</a>
                  </li>
  
                  
                  <li class="nav-item">
                      <a class="nav-link" href="">店家</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="">平台</a>
                  </li>
                  
  
                  

                </ul>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered text-nowrap table-striped ">
                    <thead>
                      <tr>
                        
                        <th>優惠卷名稱</th>
                        <th>優惠卷介紹</th>
                        <th>優惠卷代碼</th>
                        <th>優惠券說明</th>
                        <th>開始日期</th>
                        <th>到期日期</th>
                        <th>可使用次數</th>
                        <th>低消金額</th>
                        <th>使用條件</th>
                        <th>狀態</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td class="align-middle">打卡優惠</td>
                        <td class="align-middle text-wrap">設立外帶自取點，允許顧客在特定地點自取並享受折扣。</td> 
                        <td class="align-middle">CID7a2G4b8</td>                    
                        <td class="align-middle">百分比</td>
                        
                        <td class="align-middle">2023-12-01</td>
                        <td class="align-middle">2023-12-30</td>
                        <td class="align-middle">10</td>
                        <td class="align-middle">500</td>
                        <td class="align-middle">早餐店</td>
                        <td class="align-middle">可使用</td>
                        
                        
                      </tr>
                      
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example text-end">
                      <ul class="pagination">
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>

                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
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
