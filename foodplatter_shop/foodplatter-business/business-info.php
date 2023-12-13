<?php
session_start();
if (isset($_SESSION["shop"]["name"])) {
  $shop_name = $_SESSION["shop"]["name"];
}
if (isset($_SESSION["shop"]["email"])) {
  $shop_email = $_SESSION["shop"]["email"];
}
if (isset($_SESSION["shop"]["password"])) {
  $shop_password = $_SESSION["shop"]["password"];
}
if (isset($_SESSION["shop"]["tel"])) {
  $shop_tel = $_SESSION["shop"]["tel"];
}
if (isset($_SESSION["shop"]["tax"])) {
  $shop_tax = $_SESSION["shop"]["tax"];
}
if (isset($_SESSION["shop"]["zip"])) {
  $shop_zip = $_SESSION["shop"]["zip"];
}

if (isset($_SESSION["shop"]["bank"])) {
  $shop_bank = $_SESSION["shop"]["bank"];
}
if (isset($_SESSION["shop"]["address"])) {
  $shop_address = $_SESSION["shop"]["address"];
}

if (isset($_SESSION["shop"]["introduce"])) {
  $shop_introduce = $_SESSION["shop"]["introduce"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>foodplatter會員登入或註冊</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Sans&family=Noto+Serif+TC:wght@500&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet" />
  <link href="./asset/css/main.css" rel="stylesheet" />
  <style>
    :root {
      --menu-width: 300px;
      --page-space-top: 100px;
    }

    body {
      background: url(./asset/img/bussiness-login.png) center center no-repeat;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    main {
      display: flex;
      flex-direction: column;
    }

    .card {
      position: relative;

      background: #fffffff0;
      max-height: 80vh;
      min-width: 1000px;
      /* border: 1px solid #ccc; */
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      color: #fff;
    }

    .title {
      font-size: 2rem;
      color: #000000;
      font-family: "Hedvig Letters Sans", sans-serif;
      text-align: center;
      text-shadow: 0px 0px 10px rgb(0, 0, 0);
    }

    .bluid {
      background-color: #02078e;
      color: white;
      padding-block: 0.5rem;

      margin: auto;
      border: none;
      border-radius: 30px;
      font-size: 1.5rem;
    }

    .bluid:hover {
      background: #060cbb;
      border: #060cbb;
    }
  </style>
</head>

<body>
  <main>
    <form action="dobusinessInfo.php" method="post" enctype="multipart/form-data">
      <div class="found">
        <h1 class="mb-4 title text-white">建立廠商端帳號</h1>
      </div>
      <div class="card container" style="overflow: auto;">
        <?php if (isset($_SESSION["error"]["message"])) : ?>
          <div class="col-12 text-danger text-center fs-5" style="margin-top:2rem"><?= $_SESSION["error"]["message"] ?></div>
        <?php endif; ?>
        <div class="">
          <div class="p-5">
            <div class="row ">
              <div class="row mt-3 ms-1">

                <div class="col-12">
                  <p class="text-secondary">店家信箱</p>
                </div>
                <div class="col-12">
                  <input value="<?php echo isset($shop_email) ?  $shop_email : ""  ?>" name="shop_email" type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="請輸入電子郵件地址..." />
                </div>
              </div>
              <br />
              <div class="row mt-3 ms-1">
                <div class="col-12">
                  <p class="text-secondary">密碼</p>
                </div>
                <div class="col-6">
                  <input name="password" type="password" class="form-control form-control-user" aria-describedby="emailHelp" />
                </div>
                <div class="col-6">
                  <input name="repassword" type="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="請重新輸入密碼" />
                </div>
              </div>
              <div class="row mt-3 ms-1">
                <div class="col-12">
                  <p class="text-secondary">店家資訊</p>
                </div>
                <div class="col-6">

                  <input name="shop_name" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="店家名稱(連鎖店舖) " value="<?php echo isset($shop_name) ?  $shop_name : ""  ?>" />

                </div>
                <div class="col-3">
                  <input name="shop_tel" type="tel" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo isset($shop_tel) ?  $shop_tel : ""  ?>" aria-describedby="emailHelp" placeholder="請輸入貴公司電話號碼" />
                </div>
                <div class="col-3">
                  <input name="shop_tax" value="<?php echo isset($shop_tax) ?  $shop_tax : ""  ?>" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="請輸入貴公司統一編號" />

                </div>
                <div class="row mt-3 ms-1">

                </div>
                <div class="col-2">
                  <input name="bank_zip" value="<?php echo isset($shop_zip) ?  $shop_zip : ""  ?>" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="銀行代碼" />
                </div>
                <div class="col-4">
                  <input name="bank_account" value="<?php echo isset($shop_bank) ?  $shop_bank : ""  ?>" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="請輸入貴公司銀行帳號" />
                </div>
              </div>
              <div class="row mt-3 ms-1">
                <div class="col-12">
                  <p class="text-secondary">商家地址</p>
                </div>
                <div class="col-1" style="display: none">
                  <input name="cities" type="text" id="zipcode_box" placeholder="郵遞區號" />
                </div>
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
                <div class="col-8">
                  <input name="address" value="<?php echo isset($shop_address) ?  $shop_address : ""  ?>" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="請輸入貴公司詳細地址" />
                </div>
              </div>
              <div class="row mt-3 ms-1">
                <div class="col-12">
                  <p class="text-secondary">商家分類</p>
                </div>
                <div class="col-1" style="display: none">
                  <input name="main_category" type="text" id="category_box" placeholder="分類代碼" />
                </div>
                <div class="col-6">
                  <select class="form-select" aria-label="Default select example" name="mainCategory" id="mainCategory_box">
                    <option value="">選擇主要分類</option>
                  </select>
                </div>
                <div class="col-6">
                  <select class="form-select" aria-label="Default select example" name="subCategory" id="subCategory_box">
                    <option value="">選擇次要分類</option>
                  </select>
                </div>
              </div>
              <div class="row mt-3 ms-1">
                <div class="col-12">
                  <p class="text-secondary">詳細介紹</p>
                </div>
                <div class="col-12">
                  <textarea name="shop_intro" id="" cols="100" rows="5" style="resize: none"><?php echo isset($shop_introduce) ?  $shop_introduce : ""  ?></textarea>
                </div>
                <div class="col-12 mt-3">
                  <p class="text-secondary">上傳店面外觀</p>

                </div>
                <div class="col-12 d-flex flex-column">
                  <input class="col-8 btn mb-3 " type="file" name="product_image" data-target="preview_product_image" style="width:20vw ;" />

                  <img id="preview_product_image" src="./asset/img/upload.png" style="max-width:35vw;;border-radius:20px" alt="">
                </div>
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
              <!-- <div class="row mt-5  justify-content-around ">

                <div class="col-5">
                  <p class="text-secondary">詳細介紹</p>
                </div>

                <div class="col-5">
                  <p class="text-secondary">上傳店面外觀</p>
                </div>
              </div>
              <div class="d-flex justify-content-around mt-4">
                <div class=""> <textarea name="shop_intro" id="" cols="45" rows="10" style="resize: none"></textarea></div>
                <div class="d-flex flex-column mt-3 align-items-center">

                  <input class="col-8 btn" type="file" name="product_image" data-target="preview_product_image" style="margin-top: -3rem" />

                  <img src="./asset/img/soyMilkKing.jpeg" style="width:20vw;height:12vw" alt="">

                </div>
              </div> -->
              <!-- <div class="d-flex  flex-column mt-3 ">

                <div class="d-flex col-12 justify-content-between">
                  <div class="">
                    <textarea name="shop_intro" id="" cols="50" rows="10" style="resize: none"></textarea>
                  </div>
                  <div class="d-flex flex-column ">

                    <img src="./asset/img/soyMilkKing.jpeg" style="width:250px" alt="">
                    <input class="col-8 btn" type="file" name="product_image" data-target="preview_product_image" />
                  </div>
                </div>
              </div> -->
              <div class="d-flex flex-column align-items-center">
                <button type="submit" class=" bluid col-1 mt-2">
                  註冊
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>

    </form>
  </main>
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
  <?php unset($_SESSION["error"]["message"]);
  unset($_SESSION["shop"]);
  ?>

</body>

</html>