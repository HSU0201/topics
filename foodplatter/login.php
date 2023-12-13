<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("location:index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>登入foodplatter</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">歡迎回來 foodplatter!</h1>
                                    </div>
                                    <?php
                                    if (isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 50) :
                                    ?>
                                        <div class="text-warning text-center">錯誤次數已達上限，請稍後再試</div>
                                    <?php else : ?>
                                        <form class="user" action="doSignin.php" method="post">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="請輸入電子郵件地址...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="請輸入密碼">
                                            </div>
                                            <?php
                                            if (isset($_SESSION["error"]["message"])) : ?>
                                                <div class="text-warning"><?php echo $_SESSION["error"]["message"] ?></div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">記住帳號</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit">
                                                登入
                                            </button>

                                        </form>
                                    <?php endif; ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">忘記密碼?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">創建帳戶!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    unset($_SESSION["error"]["message"]);
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>