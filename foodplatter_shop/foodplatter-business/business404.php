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

    <title>404 Error</title>

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
      .font {
        > span {
          font-size: 4.5rem;
        }
        > p {
          font-size: 2.6rem;
        }
      }
    </style>
  </head>

  <body id="page-top">
    <!--頁面包裝器-->
    <div id="wrapper" class="goodnav">
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

        <!--分音器-->
        <hr class="sidebar-divider my-0" />

        <!--導航項目 -儀表板-->
        <li class="nav-item">
          <a class="nav-link" href="business404.html">
            <span><i class="bi bi-house-fill"></i>&nbsp;&nbsp;主頁</span>
          </a>
        </li>

        <!--分音器-->
        <hr class="sidebar-divider" />

        <!--標題-->
        <div class="sidebar-heading">管理系統</div>

        <!--導航項目 -表格-->
        <li class="nav-item">
          <a class="nav-link" href="business404.html">
            <i class="bi bi-shop"></i>
            <span>商品管理</span></a
          >
        </li>
        <!--導航項目 -表格-->
        <li class="nav-item">
          <a class="nav-link" href="business404.html">
            <i class="bi bi-ticket-perforated"></i>
            <span>優惠卷管理</span></a
          >
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
                  <span
                    class="mr-2 d-none d-lg-inline text-gray-600 small"
                  ></span>
                </div>

                <div class="topbar-divider d-none d-sm-block"></div>

                <a class="nav-link" href="#">
                  <i
                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                  ></i>
                </a>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!--插眼-->
          <main>
            <div
              class="container-fluid d-flex justify-content-center align-items-center"
              style="position: absolute; top: 25%; left: 7%"
            >
              <div class="dangerous">
                <img src="./asset/img/alert.png" alt="" style="width: 450px" />
              </div>
              <div class="font">
                <span>請循正常管道進入頁面</span>
                <p>若有任何問題請聯絡客服為您服務</p>
                <p>客服電話:02-10503525</p>
              </div>
            </div>
          </main>
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Foodplatter &copy; 2023 </span>
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
