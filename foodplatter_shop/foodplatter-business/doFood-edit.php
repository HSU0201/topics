<?php
require_once("./asset/connect/db_connect.php");

session_start();

// 從 GET 參數中獲取 food_id
$food_id = $_GET["food_id"];
// echo $food_id;

$id = $_SESSION["user"]["shop_id"];
if (isset($_SESSION["certified"]["error"])) {
    $certified_error = $_SESSION["certified"]["error"];
  }

// 檢查是否存在 GET 參數 "food_id"
if (!isset($_GET["food_id"])) {
  // 如果不存在，將使用者重新導向到 food_list.php
  header("location: food_list.php");
  exit();
  // 這裡加上 exit() 是為了確保程式停止執行，避免之後的代碼被執行
}


// require_once("../fd_connect.php");
// ???????????????????????

// $food_id = "1";

$sql = "SELECT food_list.*,food_category.name FROM food_list
JOIN food_category ON food_list.category_id = food_category.id
WHERE food_list.food_id=$food_id AND food_list.food_valid=1";

// $categorychooseSql= "SELECT * FROM food_category WHERE foodCategory_id=11";
// $categorychooseresult=$conn->query($categorychooseSql);
// $categorychooserows=$categorychooseresult->fetch_all(MYSQLI_ASSOC);
// 執行 SQL 查詢
// ??????????????
// $result = $conn->query($sql);

$result = $conn->query($sql);
$row = $result->num_rows;
// 從查詢結果中獲取一行記錄的關聯數組（associative array）

// ?????????????
$rows = $result->fetch_assoc();
// foreach($rows as $row){
//   echo $row['category_id'];
// }

// 獲取查詢結果的記錄數
// $foodCount = $result->num_rows;

$sqlA = "SELECT food_category.*,shopinfo.* FROM food_category JOIN shopinfo ON food_category.foodCategory_id = shopinfo.main_category WHERE shop_id = $id";
$resultCategoryA = $conn->query($sqlA);

$rowsA = $resultCategoryA->fetch_all(MYSQLI_ASSOC);



$sqlB = "SELECT * FROM shopinfo WHERE shop_id=$id";
$resultB = $conn->query($sqlB);
$shop = $resultB->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?=$shop["shop_name"]?>修改頁面</title>

  <!--此模板的自訂字體-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!--此模板的自訂樣式-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="./css/sb-admin-2.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
        #btn-color{
            background-color: #020781;
        }
        #btn-color:hover{
            background: #060cbb;
        }
    </style>
</head>



<body id="page-top">
  <!--頁面包裝器-->
  <div id="wrapper" class="">
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
          <div class="modal-body text-dark" >
            如果您準備結束目前會話，請選擇下面的「登出」。
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">
              取消
            </button>
            <a class="btn text-white " id="btn-color" href="doLogOut.php">登出</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 登出彈出視窗結束 -->

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
      <li class="nav-item active">
        <a class="nav-link" href="product-manage.php">
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
              <div class="nav-link" href="#" id="">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! <?=$shop["shop_name"]?></span>
                <img class="img-profile rounded-circle" src="./asset/img/<?=$shop["shop_img"]?>" />
              </div>

              <div class="topbar-divider d-none d-sm-block"></div>

              <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">

                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
            </li>
          </ul>
        </nav>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container">
          
            <!-- Page Heading -->

            <div class="edit-top py-2">
              <a class="btn btn-info" id="btn-color" href="product-manage.php" title="回商品資訊"><i class="bi bi-arrow-left"></i></a>
            </div>
            <h3 style="font-weight: 800; letter-spacing: 2px;">商品編輯 <span style="color: red;font-size:1rem"><?php echo isset($certified_error) ? $certified_error : "" ?></span></h3>
            <br>

            <form action="doUpdatefood.php" method="post"  enctype="multipart/form-data">
              
                <input type="hidden" name="food_id" value="<?= $rows["food_id"] ?>">
                <div class="row">
                  <div class="col-md-4">
                    <img style="max-width:400px" src="./asset/img/<?= $rows["food_img"] ?>" alt="Food Image" id="preview_progressbarTW_img">
                  </div>


                  <div class="col-md-7">
                    <table class="bg-trans table table-borderless table-white1" id="table-dark">
                      <tr>
                        <th style="color: gray; text-align: center;">商品名稱</th>
                        <td>
                          <input type="text" class="form-control" id="food_name" name="food_name" value="<?= $rows["food_name"] ?>">
                        </td>
                      </tr>
                      <tr>
                      <!-- 插眼 -->
                        <th style="color: gray; text-align: center;">商品分類</th>
                        <td>
                          <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected value="<?=$rows["category_id"]?>">請選擇商品分類</option>
                            <?php foreach($rowsA as $categorychooserow):?>
                            <option value="<?= $categorychooserow["id"] ?>"><?= $categorychooserow["name"] ?></option>
                            <?php endforeach;?> 
                          </select>
                         
                        </td>
                      </tr>
                      <tr>
                        <th style="color: gray; text-align: center;">商品介紹</th>
                        <td><input type="text" class="form-control" id="food_intro" name="food_intro" value="<?= $rows["food_intro"] ?>"></td>
                      </tr>
                      <tr>
                        <th style="color: gray; text-align: center;">商品備註</th>
                        <td><input type="text" class="form-control" id="food_note" name="food_note" value="<?= $rows["food_note"] ?>"></td>
                      </tr>
                      <tr>
                        <th style="color: gray; text-align: center;">商品售價</th>
                        <td><input type="price" class="form-control" id="food_price" name="food_price" value="<?= $rows["food_price"] ?>"></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="imgload input-group d-flex justify-content-center" style="max-width:380px"  >
                  <input type="file" class="form-control" style="max-width:320px"  name="product_image" onchange="readURL(this)" targetID="preview_progressbarTW_img" accept="image/gif, image/jpeg, image/png">
                </div>
              <div class="py-5 d-flex justify-content-end">
                

                <!-- 按鈕 -->
                <div class="d-flex" >
                  
                    <button class="btn btn-primary text-white mx-2" id="btn-color" type="submit">儲存</button>
                  <!-- </form> -->
                  <a class="btn btn-secondary text-white " href="product-manage.php">取消</a>
                 
                </div>

                <!-- 彈跳視窗 -->
                <div class="modal fade" id="alertModal<?= $row["food_id"] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        確認刪除?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <!-- 刪除按鈕，連結至執行刪除的腳本 -->
                        <a href="./doDelete.php?id=<?= $row["food_id"] ?>" class="btn btn-danger">確認</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- 彈跳視窗結束 -->
              </div>
            </form>

        </div>



      </div>
    </div>
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


</body>

</html>