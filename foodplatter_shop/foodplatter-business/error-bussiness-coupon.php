<?php 
session_start();
require_once('pdo_connect.php');


$shop_id = $_SESSION['user']['shop_id'];
$currentUrl = $_SERVER['REQUEST_URI'];
$_SESSION['currentUrl'] = $currentUrl;

if(!isset($shop_id)):
  die('請循正常管道進入此頁');
endif;

$today = date('Y-m-d');

if(isset($_GET['category'])){
  $category = $_GET['category'];    // 1 滿額折價券; 2 滿額折抵券; 3 特定商品優惠券
  switch($category):
    case 1:
      $coupon_class = '滿額折價券';
      break;
    case 2:
      $coupon_class = '滿額折抵券';
      break;
    case 3:
      $coupon_class = '特定商品優惠券';
      break;
    endswitch;
}

if(isset($_GET['status'])){
  $status = $_GET['status'];        // 1 未上架; 2 已上架; 3 已過期
  switch($status):
    case 1:
      $coupon_status = "AND coupon_start>'$today'";
      break;
    case 2:
      $coupon_status = "AND '$today' BETWEEN coupon_start AND coupon_exp";
      break;
    case 3:
      $coupon_status = "AND coupon_exp<'$today'";
      break;
    default:
      $coupon_status = "";
    endswitch;
}

$sql = "SELECT * FROM coupon WHERE shop_id=:shop_id AND coupon_category=2 AND valid=1 ";

if(isset($category) && isset($status)):
  $sql .= "AND coupon_name=:coupon_class $coupon_status";
elseif(isset($category)):
  $sql .= "AND coupon_name=:coupon_class";
elseif(isset($status)):
  $sql .= $coupon_status;
else:
  $sql .= "";
endif;

if(isset($_GET['state']) && $_GET['state']=="1"):
  $sql .= " ORDER BY modified_at DESC";
  $state=$_GET['state']+1;
  $state_static=1;
elseif(isset($_GET['state']) && $_GET['state']=="2"):
  $sql .= " ORDER BY coupon_exp DESC";
  $state=$_GET['state']-1;
  $state_static=2;
else:
  $state=2;
  $sql .= " ORDER BY coupon_exp DESC";
endif;

if(isset($_POST['page'])):
  $pageNum = $_POST['page'];
  $_SESSION['page'] = $pageNum;
else:
  $pageNum = 1;
endif;

if(isset($_SESSION['revise']) && $_SESSION['revise']=='delete'):
  header("location: ".$_SERVER['PHP_SELF']);
  unset($_SESSION['revise']);
elseif(isset($_SESSION['revise'])):
  $_POST['page'] = $_SESSION['page'];
  $pageNum = $_POST['page'];
  unset($_SESSION['revise']);
endif;

$perPage = 7;
$stmt = $pdo->prepare($sql);
if(isset($category)):
  $stmt->bindParam('coupon_class', $coupon_class);
endif;
$stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$stmt->execute();
$rowsCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
$couponCount = count($rowsCount);  // 優惠券總數
$pageCount = ceil($couponCount/$perPage);  // 優惠券分頁數

if($pageNum==1):
  $sql .= " LIMIT 0, $perPage";
else:
  $startItem = ($pageNum-1)*7;
  $sql .= " LIMIT $startItem, $perPage";
endif;

$stmt = $pdo->prepare($sql);

if(isset($category)):
  $stmt->bindParam('coupon_class', $coupon_class);
endif;
$stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
</head>

<body id="page-top">
  <!--頁面包裝器-->
  <div id="wrapper">
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
      <li class="nav-item">
        <a class="nav-link" href="./product-manage.html">
          <i class="bi bi-shop"></i>
          <span>商品管理</span></a>
      </li>
      <!--導航項目 -表格-->
      <li class="nav-item active">
        <a class="nav-link" href="./bussiness-coupon.php">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello! 八方雲集急急急</span>
                <img class="img-profile rounded-circle" src="./asset/img/eightCloud.jpg" />
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
        <main>
          <!-- Page Heading -->
          <h1 class="h3 mb-0 mx-4 my-3 text-gray-800">優惠券一覽</h1>
          <!-- 刪除確認modal -->
          <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">刪除優惠券確認</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  確定要刪除此優惠券？
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-bussiness" data-dismiss="modal">取消</button>
                  <button type="submit" class="btn btn-danger delete-coupon-modal">確定</button>
                </div>
              </div>
            </div>
          </div>
          <!-- 刪除確認modal結束 -->
          <!-- 登出確認modal -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">登出確認</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  確定要登出了嗎？
                </div>
                <div class="modal-footer">
                  <button class="btn btn-bussiness" type="button" data-dismiss="modal">取消</button>
                  <a class="btn btn-danger" href="login.php">登出</a>
                </div>
              </div>
            </div>
          </div>
          <!-- 登出確認modal結束 -->
          <div class="row">
            <div class="col d-flex justify-content-between align-items-center p-0">
              <div class="screen-and-sort d-flex mx-5">
                <div class="dropdown">
                  <button class="btn btn-bussiness dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php 
                    if(!isset($status)):
                      echo '優惠券狀態';
                    else:
                      switch($status):
                        case 1:
                          echo '未上架';
                          break;
                        case 2:
                          echo '已上架';
                          break;
                        case 3:
                          echo '已過期';
                          break;
                        endswitch;
                    endif;
                        ?>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="bussiness-coupon.php<?php if(isset($category)){echo "?category=$category";}?>">不篩選狀態</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?status=1<?php if(isset($_GET['category'])){echo "&category=$category";}?><?php if(isset($state_static)){echo "&state=$state_static";}?>">未上架</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?status=2<?php if(isset($_GET['category'])){echo "&category=$category";}?><?php if(isset($state_static)){echo "&state=$state_static";}?>">已上架</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?status=3<?php if(isset($_GET['category'])){echo "&category=$category";}?><?php if(isset($state_static)){echo "&state=$state_static";}?>">已過期</a>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-bussiness dropdown-toggle mx-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php 
                    if(!isset($category)):
                      echo '優惠券類型';
                    else:
                      switch($category):
                        case 1:
                          echo '滿額折價券';
                          break;
                        case 2:
                          echo '滿額折抵券';
                          break;
                        case 3:
                          echo '特定商品優惠券';
                          break;
                        endswitch;
                      endif;
                        ?>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="bussiness-coupon.php<?php if(isset($status)){echo "?status=$status";}?>">不篩選類型</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?<?php if(isset($_GET['status'])){echo "status=$status";}?>&category=1<?php if(isset($state_static)){echo "&state=$state_static";}?>">滿額折價券</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?<?php if(isset($_GET['status'])){echo "status=$status";}?>&category=2<?php if(isset($state_static)){echo "&state=$state_static";}?>">滿額折抵券</a>
                    <a class="dropdown-item" href="bussiness-coupon.php?<?php if(isset($_GET['status'])){echo "status=$status";}?>&category=3<?php if(isset($state_static)){echo "&state=$state_static";}?>">特定商品優惠券</a>
                  </div>
                </div>
                <a href="bussiness-coupon-create.php" class="btn btn-bussiness"><i class="bi bi-plus"></i></a>
              </div>
              <nav class="col d-flex justify-content-end mx-5 p-0" aria-label="Page navigation example">
                <ul class="pagination m-0">
                  <li class="page-item">
                    <form action="bussiness-coupon.php?<?php if(isset($status)){echo "status=$status";}?><?php if(isset($category)){echo "&category=$category";}?><?php if(isset($state_static)){echo "&state=$state_static";}?>" method="post">
                      <input type="text" class="form-control d-none" id="page" name="page" value="<?php if(isset($_POST['page'])){if($_POST['page']==1){echo $_POST['page'];}else{echo ($_POST['page']-1);}}?>" <?php if(!isset($_POST['page'])){echo 'disabled';}?>>
                      <button type="submit" class="page-link" href="#">&laquo;</button>
                    </form>
                  </li>
                  <?php for($i=0; $i<$pageCount; $i++): ?>
                  <li class="page-item <?php if($pageNum==($i+1)){echo 'active';}?>">
                    <form action="bussiness-coupon.php?<?php if(isset($status)){echo "status=$status";}?><?php if(isset($category)){echo "&category=$category";}?><?php if(isset($state_static)){echo "&&state=$state_static";}?>" method="post">
                      <input type="text" class="form-control d-none" id="page" name="page" value="<?= $i+1 ?>">
                      <button type="submit" class="page-link" href="#"><?= $i+1 ?></button>
                    </form>
                  </li>
                  <?php endfor; ?>
                  <li class="page-item">
                    <form action="bussiness-coupon.php?<?php if(isset($status)){echo "status=$status";}?><?php if(isset($category)){echo "&category=$category";}?><?php if(isset($state_static)){echo "&&state=$state_static";}?>" method="post">
                      <input type="text" class="form-control d-none" id="page" name="page" value="<?php if(isset($_POST['page'])){if($_POST['page']==$pageCount){echo $_POST['page'];}else{echo ($_POST['page']+1);}}?>" <?php if(!isset($_POST['page'])){echo 'disabled';}?>>
                      <button type="submit" class="page-link" href="#">&raquo;</button>
                    </form>
                  </li>
                </ul>
              </nav>
            </div>
            <table class="table table-hover text-nowrap mx-5 my-3">
              <thead>
                <tr class="text-center">
                  <th scope="col align-middle">名稱</th>
                  <!-- <th scope="col align-middle">優惠種類</th> -->
                  <th scope="col align-middle">說明</th>
                  <th scope="col align-middle">門檻</th>
                  <th scope="col align-middle">折扣</th>
                  <th scope="col align-middle">優惠卷代碼</th>
                  <th scope="col align-middle">有效期限</th>
                  <th scope="col align-middle">發送數量</th>
                  <th scope="col align-middle">最後修改日期<a class="btn btn-bussiness btn-sm" href="bussiness-coupon.php?<?php if(isset($status)){echo "status=$status";}?><?php if(isset($category)){echo "&category=$category";}?>&state=<?=$state?>"><i class="bi bi-caret-down-fill"></i></a></th>
                  <th scope="col align-middle">修改/刪除</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($rows as $row): ?>
                <tr class="<?php if($today>$row['coupon_exp']){echo 'text-danger';}?>" title="已上架優惠券">
                  <td scope="row" class="align-middle"><?= $row['coupon_name'] ?></td>
                  <!-- <td class="text-center align-middle">
                    <?php 
                    if($row['coupon_discount']<1){
                        echo '百分比';
                    }else{
                        echo '定額';
                    }
                    ?>
                  </td> -->
                  <td class="align-middle">
                    <?php 
                    // if($row['coupon_discount']<1):
                    //   echo '滿 '.$row['coupon_threshold'].' 元，打 '.$row['coupon_discount'].' 折';
                    // else:
                    //   echo '滿 '.$row['coupon_threshold'].' 元，折 '.$row['coupon_discount'].' 元';
                    // endif;
                    echo $row['coupon_intro'];
                    ?>
                    
                  </td>
                  <td class="text-center align-middle"><?= $row['coupon_threshold'] ?></td>
                  <td class="text-center align-middle"><?= $row['coupon_discount'] ?></td>
                  <td class="text-center align-middle"><?= $row['coupon_code'] ?></td>
                  <td class="text-center align-middle"><?= $row['coupon_start'] ?>~<?= $row['coupon_exp'] ?></td>
                  <td class="text-center align-middle"><?= $row['coupon_max_count'] ?></td>
                  <td class="text-center align-middle"><?= $row['modified_at'] ?></td>
                  <td class="d-flex justify-content-around">
                    <?php if($row['coupon_start']>$today): ?>
                    <form action="bussiness-coupon-update.php" method="post" class="d-inline-block">
                      <div class="mb-3 col-12 d-none">
                        <label for="coupon-id" class="form-label">優惠券 ID</label>
                        <input type="text" class="form-control" id="coupon-id" name="coupon-id" value="<?= $row['coupon_id']?>">
                      </div>
                      <button type="submit" class="btn btn-bussiness" title="修改"><i class="bi bi-pencil-square"></i></button>
                    </form>
                    <button type="button" class="btn btn-danger delete-coupon" data-toggle="modal" data-target="#exampleModalLong" title="刪除" value="<?= $row['coupon_id']?>"><i class="bi bi-trash-fill"></i></button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
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
    // 刪除 modal 的變數傳遞設定
    const deleteCoupons = document.querySelectorAll(".delete-coupon");
    const deleteCouponModal = document.querySelector(".delete-coupon-modal");

    var coupon_id;
    for(let i=0; i<deleteCoupons.length; i++){
      deleteCoupons[i].addEventListener("click", function(){
        coupon_id = deleteCoupons[i].getAttribute("value");
    })
    }
    
    
    deleteCouponModal.addEventListener("click", function(){
      var data = new FormData();
      data.append('coupon-id', coupon_id);

      fetch('doDeleteCoupon.php', {
        method: 'POST',  // 請求方法，這裡使用 POST
        body: data       // 要傳送的數據，這裡使用 FormData 對象
      })
      .then(response => response.text())
      .then(data => {
      // 伺服器返回的數據在 data 中
        console.log(data);
        $('#exampleModalLong').modal('hide');
        window.location.reload();
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  </script>
</body>

</html>
<?php $pdo = null; ?>