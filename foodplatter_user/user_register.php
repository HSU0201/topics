<?php
session_start();

if(isset($_SESSION["user"])){
  header("location:dashboard.php");
  exit;
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>加入foodplatter會員</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="css/sb-admin-2.css" rel="stylesheet" />


  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Sans&family=Noto+Serif+TC:wght@500&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">

  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />

    <style>

    :root{
        --menu-width:300px;
        --page-space-top:100px;
        --main-green:rgb(20,64,64);
        --main-pink:rgb(230,214,201);
        --main-pink-hover:rgb(161,145,133);
    }
    body {
        background: url(images/01.jpg) center center no-repeat;
        background-size: cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: rgb(20,64,64,0.9);
        max-width: 800px;
        margin: auto;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        color:#fff;
    }

    .title{
      
      color:#fff;
      font-family: 'Hedvig Letters Sans', sans-serif;
      text-align: center;

    }

    
    & a{
      font-size: 30px;
      font-family: 'Noto Sans TC', sans-serif;
      color:#fff;
    }

    & a:hover{
      color:#fff;
      border:rgba(230, 214, 201, 0.5);
    }

    & a:active{
      color:#fff;
      border:rgba(230, 214, 201, 0.5);
    }

    .btn{
      background: var(--main-pink);
      border:var(--main-pink);
      
    }

    .btn:hover{
      background: var(--main-pink-hover);
      border:var(--main-pink-hover);
    }

    .bg{
        background: #00000040;
        width: 100vw;
        height: 100vh;
        top:0;
        left:0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    


    

    
  </style>

</head>

<body>
  <div class="bg">
  <div class="col-lg-4">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <div class="p-5">
        <div class="text-center">
            <h1 class="py-2"><i class="bi bi-slack"></i></h1>
            <h1 class="mb-4">加入foodplatter會員</h1>
        </div>
        <form class="user" action="UserRegister.php" method="post">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="name" name="name"
                        placeholder="姓名">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="phone" name="phone"
                        placeholder="手機">
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="email" name="email"
                    placeholder="信箱">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user"
                        id="password" name="password" placeholder="密碼">
                </div>
                <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user"
                        id="repassword" name="repassword" placeholder="確認密碼">
                </div>
            </div>
            <?php
                if(isset($_SESSION["error"]["message"])):?>
                <div class="text-warning py-2"><?php echo $_SESSION["error"]["message"] ?></div>
                <?php endif;?>
            <button type="submit" class="btn btn-user btn-block">
                <span class="h6">註冊會員</span>
            </button>
            
        </form>
        <hr>
        
        <div class="text-center">
            <a class="small" href="user_signin.php">已經有帳戶？按此登入</a>
        </div>
      </div>

    </div>
  </div>
    
</div>

  </div>

  <?php
    unset($_SESSION["error"]["message"])
  ?>


</body>

</html>