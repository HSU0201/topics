<?php
require_once("./asset/connect/db_connect.php");
session_start();
if (!isset($_SESSION["user"])) {
  header("location:business-login.php");
  exit;
}


$id = $_SESSION["user"]["shop_id"];
if (isset($_SESSION["certified"]["error"])) {
  $certified_error = $_SESSION["certified"]["error"];
}

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

  <title><?= $row["shop_name"] ?> 後台系統</title>

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



    td {
      margin-left: -3rem;
    }

    .btn-danger {
      background-color: #e74a3c;
    }

    .btn-danger:hover {
      background-color: red !important;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function submitForm() {
      // 触发隐藏的提交按钮点击事件
      $('#hiddenSubmitButton').click();
    }
  </script>
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
          <a class="btn btn-primary" href="business-login.php">登出</a>
        </div>
      </div>
    </div>
  </div>
  <!-- 登出彈出視窗結束 -->
  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">確定要更改資訊嗎？</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body text-danger">
          請確定要更改的詳細資訊完整且無誤！<br>
          ＊請注意！若確定更改將會進入審核階段，店家將暫時下架等待審核完畢，若確定更改請按下"確定更改及同意下架"
        </div>
        <div class="modal-footer">
          <button class="btn btn-cancel" type="button" data-dismiss="modal">
            取消
          </button>
          <button class="btn btn-danger" onclick="submitForm()">確定更改及同意下架</button>
        </div>
      </div>
    </div>
  </div>

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
      <li class="nav-item active">
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

              <div class="nav-link" href="" id="">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hello ! <?= $row["shop_name"] ?> </span>
                <img class="img-profile rounded-circle" src="./asset/img/<?= $row["shop_img"] ?>" />
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
          <form action="./doModifyInfo.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDelete()">
            <div class=" container">
              <div class=" d-sm-flex align-items-center justify-content-between mb-4 ">


                <p class="h2 mb-0 text-gray-800">詳細資訊 <span style="color: red;font-size:1rem"><?php echo isset($certified_error) ? $certified_error : "" ?></span></p>



              </div>
              <div class="infomation " style="background-color: white;border-radius:20px">
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
                    <!-- <tr>
                      <th scope="row" style="width: 100px" class="">
                        店家名稱：
                      </th>
                      <td> <input type="text" id="optionVal" value=""></td>
                    <tr> -->
                    <th scope="row" style="width: 100px;border-top:none" class="">
                      店家名稱：
                    </th>
                    <td class="" style="border-top:none">
                      <input name="shop_name" type="text" style="width: 37%;" value="<?= $row["shop_name"] ?>" />
                    </td>
                    </tr>
                    <tr>
                      <th scope="row">店家地址：</th>
                      <td class="col-10">
                        <!-- <select class="col-2 cities" name="" id="" style="margin-right: 1rem; margin-left: -2rem">
                          <option class="option" value="1">基隆市</option>
                          <option class="option" value="2">台北市</option>
                          <option class="option" value="3">新北市</option>
                          <option class="option" value="4">桃園市</option>
                          <option class="option" value="5">新竹市</option>
                          <option class="option" value="6">新竹縣</option>
                          <option class="option" value="7">苗栗縣</option>
                          <option class="option" value="8">台中市</option>
                          <option class="option" value="9">彰化縣</option>
                          <option class="option" value="10">南投縣</option>
                          <option class="option" value="11">雲林縣</option>
                          <option class="option" value="12">嘉義市</option>
                          <option class="option" value="13">嘉義縣</option>
                          <option class="option" value="14">台南市</option>
                          <option class="option" value="15">高雄市</option>
                          <option class="option" value="16">屏東縣</option>
                          <option class="option" value="17">宜蘭縣</option>
                          <option class="option" value="18">花蓮縣</option>
                          <option class="option" value="19">台東縣</option>
                          <option class="option" value="20">澎湖縣</option>
                          <option class="option" value="21">金門縣</option>
                          <option class="option" value="22">連江縣</option>
                        </select>
                        <select class="col-2" name="" id=""> -->



                        <!-- 
                          <script>
                            const options = document.querySelectorAll(".option");
                            const selectElement = document.querySelector(".cities");
                            const optionResult = document.querySelector("#optionVal");

                            selectElement.addEventListener("change", function() {
                              for (let i = 0; i < options.length; i++) {
                                if (options[i].selected) {
                                  let optionVal = options[i].value;
                                  optionResult.value = optionVal
                                }
                              }
                            });
                          </script> -->


                        <!-- </select> -->
                        <!-- <input name="address" type="text" class="col-7" style="width: 100%; margin-left: 0.5rem" value="" /> -->
                        <?php
                        $citiesSql = "SELECT shopinfo.*,cities.* FROM shopinfo JOIN cities ON  shopinfo.cities = cities.cities_id WHERE shop_id=$id";
                        $citiesResult = $conn->query($citiesSql);
                        $citiesRow =  $citiesResult->fetch_assoc();
                        echo $citiesRow["cities_name"] . $citiesRow["towns_name"] . $row["address"]  ?>
                      </td>
                    </tr>
                    <div class="col-1" style="display: none">
                      <input name="cities" type="text" id="zipcode_box" placeholder="郵遞區號" value="<?=$row["cities"]?>" />
                    </div>
                    <tr class="">
                      <th scope="row" style="border-top:none">修改地址:</th>
                      <td style="border-top:none">
                        <div class="d-flex justify-content-start" style="max-width:800px;margin-left:-0.75rem">
                          <div class="col-2">
                            <select class="form-select" aria-label="Default select example" name="county" id="county_box">
                              <option value="">選擇縣市</option>
                            </select>
                          </div>
                          <div class="col-2">
                            <select class="form-select" aria-label="Default select example" name="district" id="district_box">
                              <option value="">選擇鄉鎮市區</option>
                            </select>
                          </div>
                          <input name="address" type="text" style="width: 50%;margin-left:3rem;" value="<?= $row["address"] ?>" />
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <th scope="row">店家電話：</th>
                      <td>
                        <input name="shop_tel" type="text" style="width: 37%" value="0<?= $row["shop_tel"] ?>" />
                      </td>
                    </tr>
                    <?php
                    $shopCategorySQL = "SELECT shopinfo.*,shop_category.* FROM shopinfo JOIN shop_category ON shop_category.shopCategory_id = shopinfo.main_category WHERE shop_id = $id";
                    $shopCategoryResult = $conn->query($shopCategorySQL);
                    $shopCategoryRow = $shopCategoryResult->fetch_assoc();
                    ?>
                    <tr>
                      <th scope="row">店家分類：</th>
                      <td class="col-10 ">
                        <div class="d-flex justify-content-between " style="max-width: 500px;">
                          <div class="" style="display: none">
                            <input name="main_category" type="text" id="category_box" value="<?= $row["main_category"] ?>" placeholder="分類代碼" />
                          </div>
                          <div class="">
                            <select class="form-select" aria-label="Default select example" name="mainCategory" id="mainCategory_box">
                              <option value="">選擇主要分類</option>
                            </select>
                          </div>
                          <div class="">
                            <select class="form-select" aria-label="Default select example" name="subCategory" id="subCategory_box">
                              <option value="">選擇次要分類</option>
                            </select>
                          </div>
                          <div class="">目前分類： <?= $shopCategoryRow["name_main"] . " " . $shopCategoryRow["name_sub"]; ?></div>
                        </div>
                      </td>

                    </tr>
                    <tr>
                      <th scope="row">店家信箱：</th>
                      <td class="col-10">
                        <input name="shop_email" type="email" style="width: 37%" value="<?= $row["shop_email"] ?>" />
                      </td>
                    </tr>

                    <tr>
                      <th scope="row " class="">銀行帳號：</th>
                      <td class="row " style="margin-left: 0rem;">
                        <input type="text" style="margin-right: 1rem;" class="col-2 " name="bank_zip" value="<?= $row["bank_zip"] ?>">
                        <input class="col-5" name="bank_account" type="text" style="width: 37%" value="<?= $row["bank_account"] ?>" />
                      </td>
                    </tr>

                    <tr>
                      <th scope="row">統一編號：</th>

                      <td><input name="shop_tax" type="text" style="width: 37%" value="<?= $row["shop_tax"] ?>" maxlength="10" minlength="10" /></td>
                    </tr>



                  </table>
                  <div class="container d-flex justify-content-end">
                    <p>創建時間：<?= $row["created_at"] ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <p>最後修改：<?= $row["modified_at"] ?></p>
                  </div>
                </div>
              </div>
              <article class=" row justify-content-center " style="margin-top: 3.5rem;">
                <p class="h2 mb-0 text-gray-800 mt-2 mb-4 col-12">店家介紹</p>

                <textarea class="h6 col-11 mb-5" style="color: black;resize:none;" name="intro" cols="140" rows="5"><?= $row["shop_intro"] ?></textarea>
              </article>
            </div>

            <div style="width: 80vw;" class="d-flex justify-content-end">
              <a class="btn btn-cancel " href="./index.php" style="margin-right:1rem">取消</a>

              <button class="btn btn-danger " type="button" data-toggle="modal" data-target="#confirmModal">確認更新資訊</button>
            </div>
            <button type="submit" class="btn btn-info" id="hiddenSubmitButton" style="display: none;">hi</button>
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
          <a class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!--更新資訊開始-->
  <!-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">确认删除</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>确定要删除吗？</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-danger" onclick="submitForm()">确认删除</button>
        </div>
      </div>
    </div> -->
  <!--更新資訊結束-->
  <!-- Bootstrap core JavaScript-->
  <script>
    // Cities of Taiwan
    const database = {
      基隆市: {
        仁愛區: "200",
        信義區: "201",
        中正區: "202",
        中山區: "203",
        安樂區: "204",
        暖暖區: "205",
        七堵區: "206",
      },
      臺北市: {
        中正區: "100",
        大同區: "103",
        中山區: "104",
        松山區: "105",
        大安區: "106",
        萬華區: "108",
        信義區: "110",
        士林區: "111",
        北投區: "112",
        內湖區: "114",
        南港區: "115",
        文山區: "116",
      },
      新北市: {
        萬里區: "207",
        金山區: "208",
        板橋區: "220",
        汐止區: "221",
        深坑區: "222",
        石碇區: "223",
        瑞芳區: "224",
        平溪區: "226",
        雙溪區: "227",
        貢寮區: "228",
        新店區: "231",
        坪林區: "232",
        烏來區: "233",
        永和區: "234",
        中和區: "235",
        土城區: "236",
        三峽區: "237",
        樹林區: "238",
        鶯歌區: "239",
        三重區: "241",
        新莊區: "242",
        泰山區: "243",
        林口區: "244",
        蘆洲區: "247",
        五股區: "248",
        八里區: "249",
        淡水區: "251",
        三芝區: "252",
        石門區: "253",
      },
      宜蘭縣: {
        宜蘭市: "260",
        頭城鎮: "261",
        礁溪鄉: "262",
        壯圍鄉: "263",
        員山鄉: "264",
        羅東鎮: "265",
        三星鄉: "266",
        大同鄉: "267",
        五結鄉: "268",
        冬山鄉: "269",
        蘇澳鎮: "270",
        南澳鄉: "272",
        釣魚臺列嶼: "290",
      },
      新竹市: {
        東區: "300",
        北區: "300",
        香山區: "300"
      },
      新竹縣: {
        竹北市: "302",
        湖口鄉: "303",
        新豐鄉: "304",
        新埔鎮: "305",
        關西鎮: "306",
        芎林鄉: "307",
        寶山鄉: "308",
        竹東鎮: "310",
        五峰鄉: "311",
        橫山鄉: "312",
        尖石鄉: "313",
        北埔鄉: "314",
        峨眉鄉: "315",
      },
      桃園市: {
        中壢區: "320",
        平鎮區: "324",
        龍潭區: "325",
        楊梅區: "326",
        新屋區: "327",
        觀音區: "328",
        桃園區: "330",
        龜山區: "333",
        八德區: "334",
        大溪區: "335",
        復興區: "336",
        大園區: "337",
        蘆竹區: "338",
      },
      苗栗縣: {
        竹南鎮: "350",
        頭份市: "351",
        三灣鄉: "352",
        南庄鄉: "353",
        獅潭鄉: "354",
        後龍鎮: "356",
        通霄鎮: "357",
        苑裡鎮: "358",
        苗栗市: "360",
        造橋鄉: "361",
        頭屋鄉: "362",
        公館鄉: "363",
        大湖鄉: "364",
        泰安鄉: "365",
        銅鑼鄉: "366",
        三義鄉: "367",
        西湖鄉: "368",
        卓蘭鎮: "369",
      },
      臺中市: {
        中區: "400",
        東區: "401",
        南區: "402",
        西區: "403",
        北區: "404",
        北屯區: "406",
        西屯區: "407",
        南屯區: "408",
        太平區: "411",
        大里區: "412",
        霧峰區: "413",
        烏日區: "414",
        豐原區: "420",
        后里區: "421",
        石岡區: "422",
        東勢區: "423",
        和平區: "424",
        新社區: "426",
        潭子區: "427",
        大雅區: "428",
        神岡區: "429",
        大肚區: "432",
        沙鹿區: "433",
        龍井區: "434",
        梧棲區: "435",
        清水區: "436",
        大甲區: "437",
        外埔區: "438",
        大安區: "439",
      },
      彰化縣: {
        彰化市: "500",
        芬園鄉: "502",
        花壇鄉: "503",
        秀水鄉: "504",
        鹿港鎮: "505",
        福興鄉: "506",
        線西鄉: "507",
        和美鎮: "508",
        伸港鄉: "509",
        員林市: "510",
        社頭鄉: "511",
        永靖鄉: "512",
        埔心鄉: "513",
        溪湖鎮: "514",
        大村鄉: "515",
        埔鹽鄉: "516",
        田中鎮: "520",
        北斗鎮: "521",
        田尾鄉: "522",
        埤頭鄉: "523",
        溪州鄉: "524",
        竹塘鄉: "525",
        二林鎮: "526",
        大城鄉: "527",
        芳苑鄉: "528",
        二水鄉: "530",
      },
      南投縣: {
        南投市: "540",
        中寮鄉: "541",
        草屯鎮: "542",
        國姓鄉: "544",
        埔里鎮: "545",
        仁愛鄉: "546",
        名間鄉: "551",
        集集鎮: "552",
        水里鄉: "553",
        魚池鄉: "555",
        信義鄉: "556",
        竹山鎮: "557",
        鹿谷鄉: "558",
      },
      嘉義市: {
        東區: "600",
        西區: "600"
      },
      嘉義縣: {
        番路鄉: "602",
        梅山鄉: "603",
        竹崎鄉: "604",
        阿里山鄉: "605",
        中埔鄉: "606",
        大埔鄉: "607",
        水上鄉: "608",
        鹿草鄉: "611",
        太保市: "612",
        朴子市: "613",
        東石鄉: "614",
        六腳鄉: "615",
        新港鄉: "616",
        民雄鄉: "621",
        大林鎮: "622",
        溪口鄉: "623",
        義竹鄉: "624",
        布袋鎮: "625",
      },
      雲林縣: {
        斗南鎮: "630",
        大埤鄉: "631",
        虎尾鎮: "632",
        土庫鎮: "633",
        褒忠鄉: "634",
        東勢鄉: "635",
        臺西鄉: "636",
        崙背鄉: "637",
        麥寮鄉: "638",
        斗六市: "640",
        林內鄉: "643",
        古坑鄉: "646",
        莿桐鄉: "647",
        西螺鎮: "648",
        二崙鄉: "649",
        北港鎮: "651",
        水林鄉: "652",
        口湖鄉: "653",
        四湖鄉: "654",
        元長鄉: "655",
      },
      臺南市: {
        中西區: "700",
        東區: "701",
        南區: "702",
        北區: "704",
        安平區: "708",
        安南區: "709",
        永康區: "710",
        歸仁區: "711",
        新化區: "712",
        左鎮區: "713",
        玉井區: "714",
        楠西區: "715",
        南化區: "716",
        仁德區: "717",
        關廟區: "718",
        龍崎區: "719",
        官田區: "720",
        麻豆區: "721",
        佳里區: "722",
        西港區: "723",
        七股區: "724",
        將軍區: "725",
        學甲區: "726",
        北門區: "727",
        新營區: "730",
        後壁區: "731",
        白河區: "732",
        東山區: "733",
        六甲區: "734",
        下營區: "735",
        柳營區: "736",
        鹽水區: "737",
        善化區: "741",
        大內區: "742",
        山上區: "743",
        新市區: "744",
        安定區: "745",
      },
      高雄市: {
        新興區: "800",
        前金區: "801",
        苓雅區: "802",
        鹽埕區: "803",
        鼓山區: "804",
        旗津區: "805",
        前鎮區: "806",
        三民區: "807",
        楠梓區: "811",
        小港區: "812",
        左營區: "813",
        仁武區: "814",
        大社區: "815",
        東沙群島: "817",
        南沙群島: "819",
        岡山區: "820",
        路竹區: "821",
        阿蓮區: "822",
        田寮區: "823",
        燕巢區: "824",
        橋頭區: "825",
        梓官區: "826",
        彌陀區: "827",
        永安區: "828",
        湖內區: "829",
        鳳山區: "830",
        大寮區: "831",
        林園區: "832",
        鳥松區: "833",
        大樹區: "840",
        旗山區: "842",
        美濃區: "843",
        六龜區: "844",
        內門區: "845",
        杉林區: "846",
        甲仙區: "847",
        桃源區: "848",
        那瑪夏區: "849",
        茂林區: "851",
        茄萣區: "852",
      },
      屏東縣: {
        屏東市: "900",
        三地門鄉: "901",
        霧臺鄉: "902",
        瑪家鄉: "903",
        九如鄉: "904",
        里港鄉: "905",
        高樹鄉: "906",
        鹽埔鄉: "907",
        長治鄉: "908",
        麟洛鄉: "909",
        竹田鄉: "911",
        內埔鄉: "912",
        萬丹鄉: "913",
        潮州鎮: "920",
        泰武鄉: "921",
        來義鄉: "922",
        萬巒鄉: "923",
        崁頂鄉: "924",
        新埤鄉: "925",
        南州鄉: "926",
        林邊鄉: "927",
        東港鎮: "928",
        琉球鄉: "929",
        佳冬鄉: "931",
        新園鄉: "932",
        枋寮鄉: "940",
        枋山鄉: "941",
        春日鄉: "942",
        獅子鄉: "943",
        車城鄉: "944",
        牡丹鄉: "945",
        恆春鎮: "946",
        滿州鄉: "947",
      },
      臺東縣: {
        臺東市: "950",
        綠島鄉: "951",
        蘭嶼鄉: "952",
        延平鄉: "953",
        卑南鄉: "954",
        鹿野鄉: "955",
        關山鎮: "956",
        海端鄉: "957",
        池上鄉: "958",
        東河鄉: "959",
        成功鎮: "961",
        長濱鄉: "962",
        太麻里鄉: "963",
        金峰鄉: "964",
        大武鄉: "965",
        達仁鄉: "966",
      },
      花蓮縣: {
        花蓮市: "970",
        新城鄉: "971",
        秀林鄉: "972",
        吉安鄉: "973",
        壽豐鄉: "974",
        鳳林鎮: "975",
        光復鄉: "976",
        豐濱鄉: "977",
        瑞穗鄉: "978",
        萬榮鄉: "979",
        玉里鎮: "981",
        卓溪鄉: "982",
        富里鄉: "983",
      },
      金門縣: {
        金沙鎮: "890",
        金湖鎮: "891",
        金寧鄉: "892",
        金城鎮: "893",
        烈嶼鄉: "894",
        烏坵鄉: "896",
      },
      連江縣: {
        南竿鄉: "209",
        北竿鄉: "210",
        莒光鄉: "211",
        東引鄉: "212"
      },
      澎湖縣: {
        馬公市: "880",
        西嶼鄉: "881",
        望安鄉: "882",
        七美鄉: "883",
        白沙鄉: "884",
        湖西鄉: "885",
      },
    };

    const county_box = document.querySelector("#county_box");
    const district_box = document.querySelector("#district_box");
    const zipcode_box = document.querySelector("#zipcode_box");
    let selected_county;

    Object.getOwnPropertyNames(database).forEach((county) => {
      county_box.innerHTML += `<option value="${county}">${county}</option>`;
    });

    county_box.addEventListener("change", () => {
      selected_county = county_box.options[county_box.selectedIndex].value;

      district_box.innerHTML = '<option value="">選擇鄉鎮市區</option>';

      zipcode_box.value = "";

      Object.getOwnPropertyNames(database[selected_county]).forEach(
        (district) => {
          district_box.innerHTML += `<option value="${district}">${district}</option>`;
        }
      );
    });

    district_box.addEventListener("change", () => {
      const selected_district =
        district_box.options[district_box.selectedIndex].value;
      const zipcode_value = database[selected_county][selected_district];

      zipcode_box.value = `${zipcode_value}`;
    });
    /* 分類表單 */
    // Cities of Taiwan
    const databaseC = {
      中式: {
        中台料理: "11",
        日韓料理: "12",
        港式料理: "13",
      },
      西式: {
        速食料理: "21",
        麵包料理: "22",
        義大利料理: "23",
        法國料理: "24",
      },
      異國: {
        印度料理: "31",
        墨西哥料理: "32",
        越南料理: "33",
        泰國料理: "34",
      },
    };

    const mainCategory_box = document.querySelector("#mainCategory_box");
    const subCategory_box = document.querySelector("#subCategory_box");
    const category_box = document.querySelector("#category_box");
    let selected_category;

    Object.getOwnPropertyNames(databaseC).forEach((mainCategory) => {
      mainCategory_box.innerHTML += `<option value="${mainCategory}">${mainCategory}</option>`;
    });

    mainCategory_box.addEventListener("change", () => {
      selected_category =
        mainCategory_box.options[mainCategory_box.selectedIndex].value;

      subCategory_box.innerHTML = '<option value="">選擇次要分類</option>';

      category_box.value = "";

      Object.getOwnPropertyNames(databaseC[selected_category]).forEach(
        (subCategory) => {
          subCategory_box.innerHTML += `<option value="${subCategory}">${subCategory}</option>`;
        }
      );
    });

    subCategory_box.addEventListener("change", () => {
      const selected_subCategory =
        subCategory_box.options[subCategory_box.selectedIndex].value;
      const categorycode_value =
        databaseC[selected_category][selected_subCategory];

      category_box.value = `${categorycode_value}`;
    });
  </script>
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