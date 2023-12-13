<?php
session_start();

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

    <title>Foodplatter會員資料編輯</title>

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

      .pic{
        & img{
          width: 50px;
          height: 50px;

        }
        & input[type="radio"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
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

  

    <div id="wrapper" class="">
      <!--側邊欄-->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!--側邊欄-品牌-->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="index.php"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="bi bi-slack"></i>
          </div>
          <div class="sidebar-brand-text mx-3">foodplatter</div>
        </a>
        
        <!-- 會員頭貼 -->
        <div class="d-flex align-items-center justify-content-center row">
          <img
            class="img-profile rounded-circle col-7 py-3"
            src="<?= $row["user_img"] ?>"
          />

          <span class="text-white col-12 text-center py-3">Hello ! <?= $row["user_name"]?></span>
        </div>

        <hr class="sidebar-divider my-0" />

        <!-- nav -->
        <li class="nav-item active">
          <a class="nav-link" href="user_index.php">
            
            <span><i class="bi bi-house"></i>會員資料</span>
          </a>
        </li>

        <hr class="sidebar-divider" />
        
        <li class="nav-item">
          <a class="nav-link" href="user_order.php">
            
            <span><i class="bi bi-file-earmark"></i>訂單</span></a
          >
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="user_coupon.php">
            
            <span><i class="bi bi-ticket-perforated"></i>優惠券</span></a
          >
        </li>

        <!--側邊欄切換器（側邊欄）-->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!--側邊欄尾-->


      <!--內容-->
      <div id="content-wrapper" class="d-flex flex-column">
        
        <div id="content">
          <!--頂欄-->
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

            <!--中間頂欄-->
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
          <!-- 頂欄結束 -->



          <!-- 頁面內容開始 -->
          <div class="container-fluid">
            
            <div
              class="d-sm-flex align-items-center justify-content-start mb-4"
            >
              <a class="btn btn-primary mr-3" href="user_index.php"><i class="bi bi-arrow-left"></i></a>
              <h1 class="h3 mb-0 text-gray-800 ">詳細資訊</h1>
              
            </div>

            <div class="row">
              
              <div class="col-12">
                <div class="card shadow mb-4">
                  
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                  >
                    <h6 class="m-0 font-weight-bold text-primary">
                      會員資料修改
                    </h6>
                    
                  </div>

                  <form class="" action="UserUpdate.php" method="post">
                      <div class="card-body row">

                        <!-- 會員資訊修改 -->
                          <div class="col-4">
                            

                            <div class="justify-content-center d-flex">
                              
                              <img
                                class="img-profile rounded-circle mainpic"
                                src="<?= $row["user_img"] ?>"/>
                            </div>
                            

                            <h6 class="pt-5">點擊即可變換頭貼</ㄋ>

                            <div class="thumb d-flex justify-content-around my-3">
                              <div class="pic mx-2"><input id="head1" type="radio" name="head" value="images/head/1.svg"><label for="head1"><img
                                class="subpic object-fit-cover"
                                data-color="1"
                                src="images/head/1.svg"
                                alt=""
                              /></label>
                              </div>

                              <div class="pic mx-2"><input id="head2" type="radio" name="head" value="images/head/2.svg"><label for="head2"><img
                                  class="subpic object-fit-cover"
                                  data-color="2"
                                  src="images/head/2.svg"
                                  alt=""
                                /></label>
                              </div>

                              <div class="pic mx-2"><input id="head3" type="radio" name="head" value="images/head/3.svg"><label for="head3"><img
                                  class="subpic object-fit-cover"
                                  data-color="3"
                                  src="images/head/3.svg"
                                  alt=""
                                /></label>
                              </div>

                              <div class="pic mx-2"><input id="head4" type="radio" name="head" value="images/head/4.svg"><label for="head4"><img
                                  class="subpic object-fit-cover"
                                  data-color="4"
                                  src="images/head/4.svg"
                                  alt=""
                                /></label>
                              </div>

                              <div class="pic mx-2"><input id="head5" type="radio" name="head" value="images/head/5.svg"><label for="head5"><img
                                  class="subpic object-fit-cover"
                                  data-color="4"
                                  src="images/head/5.svg"
                                  alt=""
                                /></label>
                              </div>
                            </div>
                          </div>
                        <div class="col-8">
                          <table class="table">
                            <input type="hidden" name="id" value="<?=$row["user_id"]?>">
                            
                            <tr>
                                <th><span class="text-danger">*</span>姓名</th>
                                <td>
                                    <input class="form-control" type="text" name="name" value="<?= $row["user_name"]?>">
                                </td>
                                
                                
                            </tr>

                            <tr>
                                <th>生理性別(非必填)</th>
                                <td class="d-flex">
                                  <div class="form-check mr-5">
                                    <input <?php if($row["user_sex"]==0){echo "checked";} ?> class="form-check-input" type="radio" name="sex" id="sex" value=0>
                                    <label class="form-check-label" for="sex">
                                      生理男
                                    </label>
                                  </div>
                                  <div class="form-check mr-5">
                                    <input <?php if($row["user_sex"]==1){echo "checked";}?> class="form-check-input" type="radio" name="sex" id="sex" value=1>
                                    <label class="form-check-label" for="sex">
                                      生理女
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input <?php if($row["user_sex"]==2 || $row["user_sex"]==null){echo "checked";}?> class="form-check-input" type="radio" name="sex" id="sex" value=2>
                                    <label class="form-check-label" for="sex">
                                      不填寫
                                    </label>
                                  </div>
                                </td>
                            </tr>

                            <tr>
                                <th>生日(非必填)</th>
                                <td class="d-flex">
                                  <label for="birth1" class="mr-5">
                                    <input id="birth1" type="radio" name="birth0" value="1" onclick="enableDateInput('.date1')" <?php if($row["user_birth"] !== null || $row["user_birth"] !== "0000-00-00"){ echo "checked";}?>>
                                    <input type="date" name="birth" class="date1" value="<?=$row["user_birth"]?>" readonly>
                                      
                                  </label>

                                  <label for="birth2">
                                    <input id="birth2" type="radio" name="birth0" value=null onclick="removeDateInput('.date1')" <?php if($row["user_birth"] == null || $row["user_birth"] == "0000-00-00"){ echo "checked";}?>>
                                    不填寫  
                                  </label>

                                </td>
                            </tr>
            
                            <tr>
                                <th><span class="text-danger">*</span>信箱
                                </th>
                                <td><input class="form-control" type="text" name="email" value="<?= $row["user_email"]?>"></td>
                            </tr>
                            <tr>
                                <th><span class="text-danger">*</span>電話</th>
                                <td><input class="form-control" type="text" name="phone" value="<?= $row["user_phone"]?>"></td>
                            </tr>

                            
                            

                            <tr>
                                <th>地址(非必填)<br><small>若有填寫，未來將根據您的所在地，<br>更快速的推薦餐廳給您!</small></th>
                                <td>
                                  
                                  <div class="dropdown">
                                    
                                      <select class="mr-3" name="county" id="county_box">
                                          <option value="">選擇縣市</option>
                                      </select>
                                    
                                      <select class="mr-3" name="district" id="district_box">
                                          <option value="">選擇鄉鎮市區</option>
                                      </select>
                                    詳細地址:
                                      <input type="hidden" id="zipcode_box" name="zip" placeholder="郵遞區號" >
                                  </div>
                                  <div class="row d-flex align-items-center">
                                    <div class="col-4 row">
                                      <div class="col-auto county_box"><?php echo $row["user_county"]?></div>
                                      <div class="col-auto district_box"><?php echo $row["user_district"]?></div>

                                    </div>
                                    
                                    <div class="col-8">
                                      <input class="form-control mt-3" type="text" name="address" value="<?php echo $row["user_address"]?>">

                                    </div>

                                  </div>
                                  
                                  
                                  <input type="hidden" id="countyText" name="county_text" value="">
                                  <input type="hidden" id="districtText" name="district_text" value="">
                                  
                                  
                                  
                                </td>
                            </tr>
                            <tr>
                              <th scope="row">創建時間</th>
                              <td><?= $row["created_at"]?></td>
                            </tr>

                            
                            
                          </table>
                          <?php
                          if(isset($_SESSION["error"]["message"])):?>
                          <div class="text-danger"><?php echo $_SESSION["error"]["message"] ?></div>
                          <?php endif;?>

                        </div>
                        

                      </div>

                      
                      <div class="p-3 d-flex justify-content-end">
                          <div>
                            <a class="btn btn-secondary text-white" href="user_index.php">取消</a>
                            <button class="btn btn-primary text-white" type="submit">
                                儲存
                            </button>
                          
                          
                          </div>
                          
                      </div>
                  </form>
                    
                  
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

    <!-- 下拉選單 -->
    <script>
      // Cities of Taiwan
      const database = {
          '基隆市': {'仁愛區': '200', '信義區': '201', '中正區': '202', '中山區': '203', '安樂區': '204', '暖暖區': '205', '七堵區': '206'},
          '臺北市': {'中正區': '100', '大同區': '103', '中山區': '104', '松山區': '105', '大安區': '106', '萬華區': '108', '信義區': '110', '士林區': '111', '北投區': '112', '內湖區': '114', '南港區': '115', '文山區': '116'},
          '新北市': {
          '萬里區': '207', '金山區': '208', '板橋區': '220', '汐止區': '221', '深坑區': '222', '石碇區': '223',
          '瑞芳區': '224', '平溪區': '226', '雙溪區': '227', '貢寮區': '228', '新店區': '231', '坪林區': '232',
          '烏來區': '233', '永和區': '234', '中和區': '235', '土城區': '236', '三峽區': '237', '樹林區': '238',
          '鶯歌區': '239', '三重區': '241', '新莊區': '242', '泰山區': '243', '林口區': '244', '蘆洲區': '247',
          '五股區': '248', '八里區': '249', '淡水區': '251', '三芝區': '252', '石門區': '253'
          },
          '宜蘭縣': {
          '宜蘭市': '260', '頭城鎮': '261', '礁溪鄉': '262', '壯圍鄉': '263', '員山鄉': '264', '羅東鎮': '265',
          '三星鄉': '266', '大同鄉': '267', '五結鄉': '268', '冬山鄉': '269', '蘇澳鎮': '270', '南澳鄉': '272',
          '釣魚臺列嶼': '290'
          },
          '新竹市': {'東區': '300', '北區': '300', '香山區': '300'},
          '新竹縣': {
          '竹北市': '302', '湖口鄉': '303', '新豐鄉': '304', '新埔鎮': '305', '關西鎮': '306', '芎林鄉': '307',
          '寶山鄉': '308', '竹東鎮': '310', '五峰鄉': '311', '橫山鄉': '312', '尖石鄉': '313', '北埔鄉': '314',
          '峨眉鄉': '315'
          },
          '桃園市': {
          '中壢區': '320', '平鎮區': '324', '龍潭區': '325', '楊梅區': '326', '新屋區': '327', '觀音區': '328',
          '桃園區': '330', '龜山區': '333', '八德區': '334', '大溪區': '335', '復興區': '336', '大園區': '337',
          '蘆竹區': '338'
          },
          '苗栗縣': {
          '竹南鎮': '350', '頭份市': '351', '三灣鄉': '352', '南庄鄉': '353', '獅潭鄉': '354', '後龍鎮': '356',
          '通霄鎮': '357', '苑裡鎮': '358', '苗栗市': '360', '造橋鄉': '361', '頭屋鄉': '362', '公館鄉': '363',
          '大湖鄉': '364', '泰安鄉': '365', '銅鑼鄉': '366', '三義鄉': '367', '西湖鄉': '368', '卓蘭鎮': '369'
          },
          '臺中市': {
          '中區': '400', '東區': '401', '南區': '402', '西區': '403', '北區': '404', '北屯區': '406', '西屯區': '407', '南屯區': '408',
          '太平區': '411', '大里區': '412', '霧峰區': '413', '烏日區': '414', '豐原區': '420', '后里區': '421',
          '石岡區': '422', '東勢區': '423', '和平區': '424', '新社區': '426', '潭子區': '427', '大雅區': '428',
          '神岡區': '429', '大肚區': '432', '沙鹿區': '433', '龍井區': '434', '梧棲區': '435', '清水區': '436',
          '大甲區': '437', '外埔區': '438', '大安區': '439'
          },
          '彰化縣': {
          '彰化市': '500', '芬園鄉': '502', '花壇鄉': '503', '秀水鄉': '504', '鹿港鎮': '505', '福興鄉': '506',
          '線西鄉': '507', '和美鎮': '508', '伸港鄉': '509', '員林市': '510', '社頭鄉': '511', '永靖鄉': '512',
          '埔心鄉': '513', '溪湖鎮': '514', '大村鄉': '515', '埔鹽鄉': '516', '田中鎮': '520', '北斗鎮': '521',
          '田尾鄉': '522', '埤頭鄉': '523', '溪州鄉': '524', '竹塘鄉': '525', '二林鎮': '526', '大城鄉': '527',
          '芳苑鄉': '528', '二水鄉': '530'
          },
          '南投縣': {
          '南投市': '540', '中寮鄉': '541', '草屯鎮': '542', '國姓鄉': '544', '埔里鎮': '545', '仁愛鄉': '546',
          '名間鄉': '551', '集集鎮': '552', '水里鄉': '553', '魚池鄉': '555', '信義鄉': '556', '竹山鎮': '557',
          '鹿谷鄉': '558'
          },
          '嘉義市': {'東區': '600', '西區': '600'},
          '嘉義縣': {
          '番路鄉': '602', '梅山鄉': '603', '竹崎鄉': '604', '阿里山鄉': '605', '中埔鄉': '606', '大埔鄉': '607',
          '水上鄉': '608', '鹿草鄉': '611', '太保市': '612', '朴子市': '613', '東石鄉': '614', '六腳鄉': '615',
          '新港鄉': '616', '民雄鄉': '621', '大林鎮': '622', '溪口鄉': '623', '義竹鄉': '624', '布袋鎮': '625'
          },
          '雲林縣': {
          '斗南鎮': '630', '大埤鄉': '631', '虎尾鎮': '632', '土庫鎮': '633', '褒忠鄉': '634', '東勢鄉': '635',
          '臺西鄉': '636', '崙背鄉': '637', '麥寮鄉': '638', '斗六市': '640', '林內鄉': '643', '古坑鄉': '646',
          '莿桐鄉': '647', '西螺鎮': '648', '二崙鄉': '649', '北港鎮': '651', '水林鄉': '652', '口湖鄉': '653',
          '四湖鄉': '654', '元長鄉': '655'
          },
          '臺南市': {
          '中西區': '700', '東區': '701', '南區': '702', '北區': '704', '安平區': '708', '安南區': '709',
          '永康區': '710', '歸仁區': '711', '新化區': '712', '左鎮區': '713', '玉井區': '714', '楠西區': '715',
          '南化區': '716', '仁德區': '717', '關廟區': '718', '龍崎區': '719', '官田區': '720', '麻豆區': '721',
          '佳里區': '722', '西港區': '723', '七股區': '724', '將軍區': '725', '學甲區': '726', '北門區': '727',
          '新營區': '730', '後壁區': '731', '白河區': '732', '東山區': '733', '六甲區': '734', '下營區': '735',
          '柳營區': '736', '鹽水區': '737', '善化區': '741', '大內區': '742', '山上區': '743', '新市區': '744',
          '安定區': '745'
          },
          '高雄市': {
          '新興區': '800', '前金區': '801', '苓雅區': '802', '鹽埕區': '803', '鼓山區': '804', '旗津區': '805',
          '前鎮區': '806', '三民區': '807', '楠梓區': '811', '小港區': '812', '左營區': '813',
          '仁武區': '814', '大社區': '815', '東沙群島': '817', '南沙群島': '819', '岡山區': '820', '路竹區': '821',
          '阿蓮區': '822', '田寮區': '823',
          '燕巢區': '824', '橋頭區': '825', '梓官區': '826', '彌陀區': '827', '永安區': '828', '湖內區': '829',
          '鳳山區': '830', '大寮區': '831', '林園區': '832', '鳥松區': '833', '大樹區': '840', '旗山區': '842',
          '美濃區': '843', '六龜區': '844', '內門區': '845', '杉林區': '846', '甲仙區': '847', '桃源區': '848',
          '那瑪夏區': '849', '茂林區': '851', '茄萣區': '852'
          },
          '屏東縣': {
          '屏東市': '900', '三地門鄉': '901', '霧臺鄉': '902', '瑪家鄉': '903', '九如鄉': '904', '里港鄉': '905',
          '高樹鄉': '906', '鹽埔鄉': '907', '長治鄉': '908', '麟洛鄉': '909', '竹田鄉': '911', '內埔鄉': '912',
          '萬丹鄉': '913', '潮州鎮': '920', '泰武鄉': '921', '來義鄉': '922', '萬巒鄉': '923', '崁頂鄉': '924',
          '新埤鄉': '925', '南州鄉': '926', '林邊鄉': '927', '東港鎮': '928', '琉球鄉': '929', '佳冬鄉': '931',
          '新園鄉': '932', '枋寮鄉': '940', '枋山鄉': '941', '春日鄉': '942', '獅子鄉': '943', '車城鄉': '944',
          '牡丹鄉': '945', '恆春鎮': '946', '滿州鄉': '947'
          },
          '臺東縣': {
          '臺東市': '950', '綠島鄉': '951', '蘭嶼鄉': '952', '延平鄉': '953', '卑南鄉': '954', '鹿野鄉': '955',
          '關山鎮': '956', '海端鄉': '957', '池上鄉': '958', '東河鄉': '959', '成功鎮': '961', '長濱鄉': '962',
          '太麻里鄉': '963', '金峰鄉': '964', '大武鄉': '965', '達仁鄉': '966'
          },
          '花蓮縣': {
          '花蓮市': '970', '新城鄉': '971', '秀林鄉': '972', '吉安鄉': '973', '壽豐鄉': '974', '鳳林鎮': '975',
          '光復鄉': '976', '豐濱鄉': '977', '瑞穗鄉': '978', '萬榮鄉': '979', '玉里鎮': '981', '卓溪鄉': '982',
          '富里鄉': '983'
          },
          '金門縣': {'金沙鎮': '890', '金湖鎮': '891', '金寧鄉': '892', '金城鎮': '893', '烈嶼鄉': '894', '烏坵鄉': '896'},
          '連江縣': {'南竿鄉': '209', '北竿鄉': '210', '莒光鄉': '211', '東引鄉': '212'},
          '澎湖縣': {'馬公市': '880', '西嶼鄉': '881', '望安鄉': '882', '七美鄉': '883', '白沙鄉': '884', '湖西鄉': '885'}
      };

      const county_box = document.querySelector('#county_box');
      const district_box = document.querySelector('#district_box');
      const zipcode_box = document.querySelector('#zipcode_box');
      let selected_county;

      const countyText = document.querySelector('#countyText');
      const districtText = document.querySelector('#districtText');

      const countyBox = document.querySelector('.county_box');
      const districtBox = document.querySelector('.district_box');

      // 從資料庫中獲取已經選擇的縣市和鄉鎮市區的值
      // const selectedCountyFromDatabase = "<?php //echo $county_text; ?>";
      // const selectedDistrictFromDatabase = "<?php //echo $district_text; ?>";

      // 遍歷 database 對象，生成縣市下拉選單的選項
      Object.getOwnPropertyNames(database).forEach((county) => {
          // 檢查是否與資料庫的值匹配，如果匹配，就加上 selected 屬性
          // const selectedAttr = (county === selectedCountyFromDatabase) ? 'selected' : '';
          county_box.innerHTML += `<option value="${county}">${county}</option>`;
      });

      county_box.addEventListener('change', () => {
          selected_county = county_box.options[county_box.selectedIndex].value;

          district_box.innerHTML = '<option value="">選擇鄉鎮市區</option>';

          zipcode_box.value = '';

          Object.getOwnPropertyNames(database[selected_county]).forEach((district) => {
              // 檢查是否與資料庫的值匹配，如果匹配，就加上 selected 屬性
              // const selectedAttr = (district === selectedDistrictFromDatabase) ? 'selected' : '';
              district_box.innerHTML += `<option value="${district}">${district}</option>`;
          });
          // countyText.value = county.options[county.selectedIndex].text;
          const selectedCountyText = county_box.options[county_box.selectedIndex].text;
          console.log('選擇的縣市：', selectedCountyText);
          countyText.value = selectedCountyText;
          countyBox.innerText = selectedCountyText;
      })

      district_box.addEventListener('change', () => {
          const selected_district = district_box.options[district_box.selectedIndex].value;
          const zipcode_value = database[selected_county][selected_district]

          zipcode_box.value = `${zipcode_value}`;
          // districtText.value = district.options[district.selectedIndex].text;
          const selectedDistrictText = district_box.options[district_box.selectedIndex].text;
          console.log('選擇的鄉鎮市區：', selectedDistrictText);
          districtText.value = selectedDistrictText;
          districtBox.innerText = selectedDistrictText;
      })

      

      
      
    </script>
    
    <!-- 選擇是否填日期 -->
    <script>
      function enableDateInput(inputId) {
          var dateInput = document.querySelector(inputId);
          
          if (dateInput) {
              dateInput.removeAttribute('readonly');
          }
          
      }

      function removeDateInput(removeId){
        var removeInput = document.querySelector(removeId);
        if (removeInput) {
            removeInput.setAttribute('readonly','true');
            removeInput.value = '';
        }
      }
    </script>
    


    <!-- 變換圖片 -->
    <script>
        const mainpic=document.querySelector(".mainpic")
        const subpics=document.querySelectorAll(".subpic")

        console.log(subpics);
        console.log(subpics.length);
        for(let i=0;i<subpics.length;i++){
            // 事件監聽器
            subpics[i].addEventListener("click",function(){
                console.log("click");
                let imgUrl=subpics[i].src;
                mainpic.src=imgUrl;
        
            })
        }

        
    </script>

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
