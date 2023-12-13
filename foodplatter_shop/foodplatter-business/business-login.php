<?php
session_start();
// if (isset($_SESSION["user"])) {
//   header("location:index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Foodplatter會員登入與註冊</title>
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
  <link rel="stylesheet" href="./asset/css/main.css" />
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

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      /* 50% 透明的白色背景 */
      width: 100vw;
      /* 使覆蓋層擴展至整個容器寬度 */
      height: 100vh;
      /* 使覆蓋層擴展至整個容器高度 */
    }

    .card {
      background: #fffffff0;
      max-width: 800px;
      margin: auto;
      padding: 40px;
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
    }

    & a {
      font-size: 30px;
      font-family: "Noto Sans TC", sans-serif;
      color: #000000;
      /* padding: 20px; */
      /* background: rgba(230, 214, 201); */
    }



    .small {
      text-decoration: none;
    }
  </style>

</head>

<body class="overlay">
  <div class="col-lg-4">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="p-5">
          <div class="text-center">
            <h1 class="mb-4 title">歡迎使用廠商端系統</h1>
          </div>
          <form class="user" action="./doShopLogin.php" method="post">
            <div class="form-group">
              <input name="shop_email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="請輸入電子郵件地址..." />
            </div>
            <div class="form-group">
              <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="請輸入密碼" />
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck" />
                <label class="custom-control-label text-black" for="customCheck">記住帳號</label>
              </div>
            </div>

            <button type="submit" class="h6 btn btn-user btn-block ">登入</button>

          </form>
          <hr />
          <div class="text-center">
            <?php if (isset($_SESSION["error"]["message"])) : ?>
              <div class="my-2 text-danger"><?= $_SESSION["error"]["message"] ?></div>
            <?php endif; ?>
          </div>
          <div class="text-center">
            <a class="small forgot" href="user_signin_forget.html">忘記密碼</a>
          </div>
          <div class="text-center">
            <a class="small" href="./business-info.php">創建帳戶</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php unset($_SESSION["error"]["message"]); ?>

</body>

</html>