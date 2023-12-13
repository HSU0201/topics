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

                    <tr>
                      <th scope="row">店家電話：</th>
                      <td>
                        <input name="shop_tel" type="text" style="width: 37%" value="0<?= $row["shop_tel"] ?>" maxlength="10" minlength="10" />
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