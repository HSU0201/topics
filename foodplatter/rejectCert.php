<!-- 0未審核 1已審核2以下架3審核未通過 -->
<?php
// 引入與資料庫連接的文件
require_once("foodplatter_connect.php");

// =======================================================================================================================

// 計算總註冊商家數
$allSQL = "SELECT * FROM shopinfo";
$resultAllTotal = $conn->query($allSQL);
$allResult = $resultAllTotal->num_rows;
// 已認證店家
$certSQL = "SELECT * FROM shopinfo WHERE shop_valid=1 AND certified=1";
$resultCertTotal = $conn->query($certSQL);
$certResult = $resultCertTotal->num_rows;
// 申請認證店家
$waitSQL = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=0";
$resultWaitTotal = $conn->query($waitSQL);
$waitResult = $resultWaitTotal->num_rows;
// 認證不通過店家
$notcertSQL = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=3";
$resultNocertTotal = $conn->query($notcertSQL);
$nocertResult = $resultNocertTotal->num_rows;
// 已下架店家
$removeSQL = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=2";
$resultRemoveTotal = $conn->query($removeSQL);
$removeResult = $resultRemoveTotal->num_rows;

// =======================================================================================================================

$var = $_GET["var"];
switch ($var) {
  case 0:
    $varSql = 0;
    break;
  case 1:
    $varSql = 1;
  case 2:
    $varSql = 2;
    break;
  case 3:
    $varSql = 3;
    break;
  default:
    $varSql = 0;
}
// ----------------------------------------------------------------------------------------
// 認證不通過店家
$allTotal = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=$varSql";
$resultTotal = $conn->query($allTotal);
$totalshops = $resultTotal->num_rows;

// 每頁顯示的商家數
$perPage = 10;
// 進行無條件進位的相除操作，計算總頁數
$pageCount = ceil($totalshops / $perPage);
// 檢查是否有 GET 請求中的 "search" 參數
// if (isset($_GET["search"])) {
//   // 如果有，取得 "search" 參數的值
//   $search = $_GET["search"];

//   // 使用 "search" 參數來篩選查詢
//   $sql = "SELECT * FROM shopinfo WHERE shop_name LIKE '%$search%' AND shop_valid=0 AND certified=$varSql";
// }
// // 檢查是否有分頁參數
// else
if (isset($_GET["page"]) && isset($_GET["order"])) {
  // 取得分頁參數及計算起始項目索引
  $page = $_GET["page"];
  $order = $_GET["order"];
  switch ($order) {
    case 1:
      $orderSql = "shop_id ASC";
      break;
    case 2:
      $orderSql = "shop_id DESC";
      break;
    case 3:
      $orderSql = "modified_at ASC";
      break;
    case 4:
      $orderSql = "modified_at DESC";
      break;
    default:
      $orderSql = "shop_id ASC";
  }

  $startItem = ($page - 1) * $perPage;

  // 如果沒有 "search" 參數，使用基本的查詢
  $sql = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=$varSql ORDER BY $orderSql LIMIT $startItem, $perPage";
}
// 如果沒有搜尋參數也沒有分頁參數，顯示第一頁的結果
else {
  $page = 1;
  $order = 1;
  $sql = "SELECT * FROM shopinfo WHERE shop_valid=0 AND certified=$varSql ORDER BY shop_id ASC LIMIT 0, $perPage";
}

// 執行 SQL 查詢，並將結果存儲在 $result 變數中
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>複審核管理</title>

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
      <li class="nav-item active">
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

          <?php if (isset($_GET["search"])) : ?>
            <a class="btn btn-info" href="certificationtables.php" title="回等待認證商家列表">
              <i class="bi bi-arrow-left"></i>
            </a>
          <?php endif; ?>

          <!-- 搜尋列 -->
          <div class="d-flex align-items-center">
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light small" placeholder="搜尋商家" aria-describedby="basic-addon2" name="search" />
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form> -->

            <!-- 人數 -->
            <?php
            $shopCount = $result->num_rows;
            ?>
            <!-- <div class="mx-5 d-flex">
              <?php if (isset($_GET["search"])) : ?>
                搜尋 <p class="text-success"> <?= $_GET["search"] ?> </p> 的結果,
              <?php endif; ?>
              共<?= $shopCount ?>家
            </div> -->
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
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">複審核管理</h1>

          </div>
          <!-- Page Heading -->



          <div class="row">
            <!-- 申請認證中 -->
            <a class="col-xl-4 col-md-6 mb-4 btn " href="certificationtables.php">
              <div class="card border-left-info shadow h-100 py-2 btn-light ">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-info text-uppercase mb-1">
                        申請認證中
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= $waitResult ?> 家
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi-exclamation-lg fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- 認證未通過 -->
            <a class="col-xl-4 col-md-6 mb-4 btn <?php if ($var == 3) echo "bg-warning" ?>" href="rejectCert.php?var=3">
              <div class="card border-left-warning shadow h-100 py-2 btn-light <?php if ($var == 3) echo "border-warning" ?>">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-warning text-uppercase mb-1 ">
                        認證未通過
                      </div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $nocertResult ?> 家
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi-dash-circle fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- 所有 -->
            <a class="col-xl-4 col-md-6 mb-4 btn"  href="allshopstables.php">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                        已註冊
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= $allResult ?> 家
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi-shop fa-2x text-gray-500"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>

            <!-- 已認證 -->
            <a class="col-xl-8 col-md-6 mb-4 btn" href="shopstables.php">
              <div class="card border-left-success shadow h-100 py-2 btn-light">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                        已認證
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= $certResult ?> 家
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi-check-all fa-3x text-green-800"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>

            <!-- 被下架 -->
            <a class="col-xl-4   col-md-6 mb-4 btn <?php if ($var == 2) echo "bg-danger" ?>" href="rejectCert.php?var=2">
              <div class="card border-left-danger shadow h-100 py-2 btn-light <?php if ($var == 2) echo "border-danger" ?>">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-danger text-uppercase mb-1">
                        下架
                      </div>
                      <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $removeResult ?> 家
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi bi-ban fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div>
            <?php
            // $rows = $result->fetch_all(MYSQLI_BOTH);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // var_dump($rows);
            ?>
          </div>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo ($var == 2) ? "被下架商家 列表" : (($var == 3) ? "認證未通過商家 列表" : ""); ?></h6>
              <!-- 按鈕組 -->
              <?php if (!isset($_GET["search"])) : ?>
                <div class="d-flex justify-content-end">
                  <div class="btn-group m-2">
                    <a href="rejectCert.php?var=<?= $var ?>&page=<?= $page ?>&order=1" class="btn <?php echo ($var == 2) ? "btn-outline-danger" : (($var == 3) ? "btn-outline-warning fw-bold" : ""); ?>  <?php if ($order == 1) echo "active" ?>">
                      id
                      <i class="bi bi-sort-down-alt"></i>
                    </a>
                    <a href="rejectCert.php?var=<?= $var ?>&page=<?= $page ?>&order=2" class="btn <?php echo ($var == 2) ? "btn-outline-danger" : (($var == 3) ? "btn-outline-warning fw-bold" : ""); ?>  <?php if ($order == 2) echo "active" ?>">
                      id
                      <i class="bi bi-sort-up"></i>
                    </a>
                  </div>
                  <div class="btn-group m-2">
                    <a href="rejectCert.php?var=<?= $var ?>&page=<?= $page ?>&order=3" class="btn <?php echo ($var == 2) ? "btn-outline-danger" : (($var == 3) ? "btn-outline-warning fw-bold" : ""); ?>  <?php if ($order == 3) echo "active" ?>">
                      最新修改時間
                      <i class="bi bi-sort-down-alt"></i>
                    </a>
                    <a href="rejectCert.php?var=<?= $var ?>&page=<?= $page ?>&order=4" class="btn <?php echo ($var == 2) ? "btn-outline-danger" : (($var == 3) ? "btn-outline-warning fw-bold" : ""); ?>  <?php if ($order == 4) echo "active" ?>">
                      最後修改時間
                      <i class="bi bi-sort-up"></i>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
              <!-- 按鈕組結束 -->
            </div>
            <?php if ($shopCount > 0) : ?>
              <div class="overflow-auto">
                <table class="table table-bordered text-nowrap table-striped">
                  <thead>
                    <tr>
                      <th class="align-middle text-center">ID</th>
                      <th class="align-middle text-center">圖片</th>
                      <th class="align-middle text-center">商家名稱</th>
                      <th class="align-middle text-center">主分類</th>
                      <th class="align-middle text-center">副分類</th>
                      <th class="align-middle text-center">統編</th>
                      <th class="align-middle text-center">信箱</th>
                      <th class="align-middle text-center">電話</th>
                      <th class="align-middle text-center">詳細地址</th>
                      <th class="align-middle text-center">銀行帳戶</th>
                      <th class="align-middle text-center">修改時間</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($rows as $row) : ?>
                      <tr>
                        <td class="align-middle text-center"><?= $row["shop_id"] ?></td>
                        <td class="align-middle text-center">
                          <img src="../foodplatter_shop/foodplatter-business/asset/img/<?= $row["shop_img"] ?>" style="width: 30px" alt="" />
                        </td>
                        <td class="align-middle text-center"><?= $row["shop_name"] ?></td>
                        <td class="align-middle text-center">
                          <?php
                          $mainCategory = $row["main_category"];
                          $chineseCategories = [11, 12, 13, 14];
                          $westernCategories = [21, 22, 23, 24];
                          $exoticCategories = [31, 32, 33, 34];
                          if (in_array($mainCategory, $chineseCategories)) {
                            $text = "中式";
                          } elseif (in_array($mainCategory, $westernCategories)) {
                            $text = "西式";
                          } elseif (in_array($mainCategory, $exoticCategories)) {
                            $text = "異式";
                          } else {
                            $text = "未知類型";
                          }
                          echo $text;
                          ?>
                        </td>
                        <td class="align-middle text-center">
                        <?php
                          $mainCategory = $row["main_category"];

                          $mainCategories = [
                            11 => "中台料理",
                            12 => "日韓料理",
                            13 => "港式料理",
                            21 => "速食料理",
                            22 => "麵包料理",
                            23 => "義式料理",
                            24 => "法式料理",
                            31 => "印度料理",
                            32 => "墨西哥料理",
                            33 => "越南料理",
                            34 => "泰國料理",
                          ];
                          $text = $mainCategories[$mainCategory] ?? "未知類型";
                          echo $text;
                          ?>
                        </td>


                        <td class="align-middle text-center"><?= $row["shop_tax"] ?></td>
                        <td class="align-middle text-center"><?= $row["shop_email"] ?></td>
                        <td class="align-middle text-center">0<?= $row["shop_tel"] ?></td>
                        <td class="align-middle text-wrap">
                          <?php
                          $database = [
                            '基隆市' => ['仁愛區' => '200', '信義區' => '201', '中正區' => '202', '中山區' => '203', '安樂區' => '204', '暖暖區' => '205', '七堵區' => '206'],
                            '臺北市' => ['中正區' => '100', '大同區' => '103', '中山區' => '104', '松山區' => '105', '大安區' => '106', '萬華區' => '108', '信義區' => '110', '士林區' => '111', '北投區' => '112', '內湖區' => '114', '南港區' => '115', '文山區' => '116'],
                            '新北市' => [
                              '萬里區' => '207', '金山區' => '208', '板橋區' => '220', '汐止區' => '221', '深坑區' => '222', '石碇區' => '223',
                              '瑞芳區' => '224', '平溪區' => '226', '雙溪區' => '227', '貢寮區' => '228', '新店區' => '231', '坪林區' => '232',
                              '烏來區' => '233', '永和區' => '234', '中和區' => '235', '土城區' => '236', '三峽區' => '237', '樹林區' => '238',
                              '鶯歌區' => '239', '三重區' => '241', '新莊區' => '242', '泰山區' => '243', '林口區' => '244', '蘆洲區' => '247',
                              '五股區' => '248', '八里區' => '249', '淡水區' => '251', '三芝區' => '252', '石門區' => '253'
                            ],
                            '宜蘭縣' => [
                              '宜蘭市' => '260', '頭城鎮' => '261', '礁溪鄉' => '262', '壯圍鄉' => '263', '員山鄉' => '264', '羅東鎮' => '265',
                              '三星鄉' => '266', '大同鄉' => '267', '五結鄉' => '268', '冬山鄉' => '269', '蘇澳鎮' => '270', '南澳鄉' => '272',
                              '釣魚臺列嶼' => '290'
                            ],
                            '新竹市' => ['東區' => '300', '北區' => '300', '香山區' => '300'],
                            '新竹縣' => [
                              '竹北市' => '302', '湖口鄉' => '303', '新豐鄉' => '304', '新埔鎮' => '305', '關西鎮' => '306', '芎林鄉' => '307',
                              '寶山鄉' => '308', '竹東鎮' => '310', '五峰鄉' => '311', '橫山鄉' => '312', '尖石鄉' => '313', '北埔鄉' => '314',
                              '峨眉鄉' => '315'
                            ],
                            '桃園市' => [
                              '中壢區' => '320', '平鎮區' => '324', '龍潭區' => '325', '楊梅區' => '326', '新屋區' => '327', '觀音區' => '328',
                              '桃園區' => '330', '龜山區' => '333', '八德區' => '334', '大溪區' => '335', '復興區' => '336', '大園區' => '337',
                              '蘆竹區' => '338'
                            ],
                            '苗栗縣' => [
                              '竹南鎮' => '350', '頭份市' => '351', '三灣鄉' => '352', '南庄鄉' => '353', '獅潭鄉' => '354', '後龍鎮' => '356',
                              '通霄鎮' => '357', '苑裡鎮' => '358', '苗栗市' => '360', '造橋鄉' => '361', '頭屋鄉' => '362', '公館鄉' => '363',
                              '大湖鄉' => '364', '泰安鄉' => '365', '銅鑼鄉' => '366', '三義鄉' => '367', '西湖鄉' => '368', '卓蘭鎮' => '369'
                            ],
                            '臺中市' => [
                              '中區' => '400', '東區' => '401', '南區' => '402', '西區' => '403', '北區' => '404', '北屯區' => '406', '西屯區' => '407', '南屯區' => '408',
                              '太平區' => '411', '大里區' => '412', '霧峰區' => '413', '烏日區' => '414', '豐原區' => '420', '后里區' => '421',
                              '石岡區' => '422', '東勢區' => '423', '和平區' => '424', '新社區' => '426', '潭子區' => '427', '大雅區' => '428',
                              '神岡區' => '429', '大肚區' => '432', '沙鹿區' => '433', '龍井區' => '434', '梧棲區' => '435', '清水區' => '436',
                              '大甲區' => '437', '外埔區' => '438', '大安區' => '439'
                            ],
                            '彰化縣' => [
                              '彰化市' => '500', '芬園鄉' => '502', '花壇鄉' => '503', '秀水鄉' => '504', '鹿港鎮' => '505', '福興鄉' => '506',
                              '線西鄉' => '507', '和美鎮' => '508', '伸港鄉' => '509', '員林市' => '510', '社頭鄉' => '511', '永靖鄉' => '512',
                              '埔心鄉' => '513', '溪湖鎮' => '514', '大村鄉' => '515', '埔鹽鄉' => '516', '田中鎮' => '520', '北斗鎮' => '521',
                              '田尾鄉' => '522', '埤頭鄉' => '523', '溪州鄉' => '524', '竹塘鄉' => '525', '二林鎮' => '526', '大城鄉' => '527',
                              '芳苑鄉' => '528', '二水鄉' => '530'
                            ],
                            '南投縣' => [
                              '南投市' => '540', '中寮鄉' => '541', '草屯鎮' => '542', '國姓鄉' => '544', '埔里鎮' => '545', '仁愛鄉' => '546',
                              '名間鄉' => '551', '集集鎮' => '552', '水里鄉' => '553', '魚池鄉' => '555', '信義鄉' => '556', '竹山鎮' => '557',
                              '鹿谷鄉' => '558'
                            ],
                            '嘉義市' => ['東區' => '600', '西區' => '600'],
                            '嘉義縣' => [
                              '番路鄉' => '602', '梅山鄉' => '603', '竹崎鄉' => '604', '阿里山鄉' => '605', '中埔鄉' => '606', '大埔鄉' => '607',
                              '水上鄉' => '608', '鹿草鄉' => '611', '太保市' => '612', '朴子市' => '613', '東石鄉' => '614', '六腳鄉' => '615',
                              '新港鄉' => '616', '民雄鄉' => '621', '大林鎮' => '622', '溪口鄉' => '623', '義竹鄉' => '624', '布袋鎮' => '625'
                            ],
                            '雲林縣' => [
                              '斗南鎮' => '630', '大埤鄉' => '631', '虎尾鎮' => '632', '土庫鎮' => '633', '褒忠鄉' => '634', '東勢鄉' => '635',
                              '臺西鄉' => '636', '崙背鄉' => '637', '麥寮鄉' => '638', '斗六市' => '640', '林內鄉' => '643', '古坑鄉' => '646',
                              '莿桐鄉' => '647', '西螺鎮' => '648', '二崙鄉' => '649', '北港鎮' => '651', '水林鄉' => '652', '口湖鄉' => '653',
                              '四湖鄉' => '654', '元長鄉' => '655'
                            ],
                            '臺南市' => [
                              '中西區' => '700', '東區' => '701', '南區' => '702', '北區' => '704', '安平區' => '708', '安南區' => '709',
                              '永康區' => '710', '歸仁區' => '711', '新化區' => '712', '左鎮區' => '713', '玉井區' => '714', '楠西區' => '715',
                              '南化區' => '716', '仁德區' => '717', '關廟區' => '718', '龍崎區' => '719', '官田區' => '720', '麻豆區' => '721',
                              '佳里區' => '722', '西港區' => '723', '七股區' => '724', '將軍區' => '725', '學甲區' => '726', '北門區' => '727',
                              '新營區' => '730', '後壁區' => '731', '白河區' => '732', '東山區' => '733', '六甲區' => '734', '下營區' => '735',
                              '柳營區' => '736', '鹽水區' => '737', '善化區' => '741', '大內區' => '742', '山上區' => '743', '新市區' => '744',
                              '安定區' => '745'
                            ],
                            '高雄市' => [
                              '新興區' => '800', '前金區' => '801', '苓雅區' => '802', '鹽埕區' => '803', '鼓山區' => '804', '旗津區' => '805',
                              '前鎮區' => '806', '三民區' => '807', '楠梓區' => '811', '小港區' => '812', '左營區' => '813',
                              '仁武區' => '814', '大社區' => '815', '東沙群島' => '817', '南沙群島' => '819', '岡山區' => '820', '路竹區' => '821',
                              '阿蓮區' => '822', '田寮區' => '823',
                              '燕巢區' => '824', '橋頭區' => '825', '梓官區' => '826', '彌陀區' => '827', '永安區' => '828', '湖內區' => '829',
                              '鳳山區' => '830', '大寮區' => '831', '林園區' => '832', '鳥松區' => '833', '大樹區' => '840', '旗山區' => '842',
                              '美濃區' => '843', '六龜區' => '844', '內門區' => '845', '杉林區' => '846', '甲仙區' => '847', '桃源區' => '848',
                              '那瑪夏區' => '849', '茂林區' => '851', '茄萣區' => '852'
                            ],
                            '屏東縣' => [
                              '屏東市' => '900', '三地門鄉' => '901', '霧臺鄉' => '902', '瑪家鄉' => '903', '九如鄉' => '904', '里港鄉' => '905',
                              '高樹鄉' => '906', '鹽埔鄉' => '907', '長治鄉' => '908', '麟洛鄉' => '909', '竹田鄉' => '911', '內埔鄉' => '912',
                              '萬丹鄉' => '913', '潮州鎮' => '920', '泰武鄉' => '921', '來義鄉' => '922', '萬巒鄉' => '923', '崁頂鄉' => '924',
                              '新埤鄉' => '925', '南州鄉' => '926', '林邊鄉' => '927', '東港鎮' => '928', '琉球鄉' => '929', '佳冬鄉' => '931',
                              '新園鄉' => '932', '枋寮鄉' => '940', '枋山鄉' => '941', '春日鄉' => '942', '獅子鄉' => '943', '車城鄉' => '944',
                              '牡丹鄉' => '945', '恆春鎮' => '946', '滿州鄉' => '947'
                            ],
                            '臺東縣' => [
                              '臺東市' => '950', '綠島鄉' => '951', '蘭嶼鄉' => '952', '延平鄉' => '953', '卑南鄉' => '954', '鹿野鄉' => '955',
                              '關山鎮' => '956', '海端鄉' => '957', '池上鄉' => '958', '東河鄉' => '959', '成功鎮' => '961', '長濱鄉' => '962',
                              '太麻里鄉' => '963', '金峰鄉' => '964', '大武鄉' => '965', '達仁鄉' => '966'
                            ],
                            '花蓮縣' => [
                              '花蓮市' => '970', '新城鄉' => '971', '秀林鄉' => '972', '吉安鄉' => '973', '壽豐鄉' => '974', '鳳林鎮' => '975',
                              '光復鄉' => '976', '豐濱鄉' => '977', '瑞穗鄉' => '978', '萬榮鄉' => '979', '玉里鎮' => '981', '卓溪鄉' => '982',
                              '富里鄉' => '983'
                            ],
                            '金門縣' => ['金沙鎮' => '890', '金湖鎮' => '891', '金寧鄉' => '892', '金城鎮' => '893', '烈嶼鄉' => '894', '烏坵鄉' => '896'],
                            '連江縣' => ['南竿鄉' => '209', '北竿鄉' => '210', '莒光鄉' => '211', '東引鄉' => '212'],
                            '澎湖縣' => ['馬公市' => '880', '西嶼鄉' => '881', '望安鄉' => '882', '七美鄉' => '883', '白沙鄉' => '884', '湖西鄉' => '885']
                          ];
                          $sqlcities = $row["cities"];
                          $sqladdress = $row["address"];
                          $address = "$sqlcities" . "$sqladdress";
                          foreach ($database as $county => $areas) {
                            foreach ($areas as $area => $code) {
                              if ($code === $sqlcities) {
                                echo "$county$area$sqladdress";
                                break 2;
                              }
                            }
                          }
                          ?>
                        </td>
                        <td class="align-middle text-center"><?= $row["bank_account"] ?></td>
                        <td class="align-middle text-center"><?= $row["modified_at"] ?></td>

                        <td class="align-middle text-center">
                          <?php if ($var == 3) : ?>
                            <a class="btn btn-info mx-1" href="doResetCert.php?var=3&shop_id=<?= $row["shop_id"] ?>" title="還原狀態"><i class="bi bi-arrow-clockwise"></i></a>
                            <!-- 刪除按鈕，觸發刪除確認視窗 -->
                            <a class="btn btn-danger mx-1" title="複審核不通過" type="button" data-toggle="modal" data-target="#exampleModalLong1<?= $row["shop_id"] ?>"><i class="bi bi-ban"></i></a>
                          <?php else : ?>
                            <a class="btn btn-info mx-1" href="doResetCert.php?var=2&shop_id=<?= $row["shop_id"] ?>" title="還原狀態"><i class="bi bi-arrow-clockwise"></i></a>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <!-- 刪除彈出視窗 -->
                      <div class="modal fade" id="exampleModalLong1<?= $row["shop_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="deletetable" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deletetable">複審核不通過</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              確認此廠商複審核不通過將其下架嗎?
                            </div>
                            <div class="modal-footer">
                              <a class="btn btn-secondary" type="button" data-dismiss="modal">
                                取消
                              </a>
                              <a class="btn btn-primary" href="doResetCert.php?var=3&shop_id=<?= $row["shop_id"] ?>&del=1">
                                確定下架
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 刪除彈出視窗結束 -->
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <!-- 分頁列 -->
                <!-- 檢查是否有進行搜尋，若無則顯示分頁 -->
                <?php if (!isset($_GET["search"])) : ?>
                  <div class="mx-2 py-2">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <!-- 迴圈顯示分頁數字 -->
                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                          <li class="page-item <?php if ($page == $i) echo "active" ?>">
                            <a class="page-link" href="?page=<?= $i ?>&order=<?= $order ?>">
                              <?= $i ?>
                            </a>
                          </li>
                        <?php endfor; ?>
                      </ul>
                    </nav>
                  </div>
                <?php endif; ?>
                <!-- 分頁列結束 -->

              </div>
              <!-- 商家列表結束 -->

            <?php else : ?>
              <?php if ($var == 3) : ?>
                <!-- 若無商家資料則顯示訊息 -->
                <h1 class="text-center">尚無<span class="text-warning">未認證</span>店家</h1>
              <?php else : ?>
                <!-- 若無商家資料則顯示訊息 -->
                <h1 class="text-center">尚無<span class="text-danger">下架</span>店家</h1>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

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
  <!-- 登出彈出視窗結束 -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>


</body>

</html>