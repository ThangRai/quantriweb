<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Thay bằng username của DB
$password = ""; // Thay bằng mật khẩu của DB
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Khởi tạo biến thông báo lỗi
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra đầu vào
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Vui lòng điền đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ!";
    } elseif ($password !== $confirm_password) {
        $error = "Mật khẩu không khớp!";
    } else {
        try {
            // Chèn dữ liệu người dùng
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                // Chuyển hướng đến trang đăng nhập
                header("Location: login.php");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            // Kiểm tra lỗi trùng lặp
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
            } else {
                $error = "Đã xảy ra lỗi, vui lòng thử lại!";
            }
        }
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-register-image {
  background: url(https://storage.timviec365.vn/timviec365/pictures/images/register-la-gi.png);
  background-position: center;
  background-size: inherit;
}
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản!</h1>
                            </div>
                            <form class="user" action="register.php" method="POST">
                            <?php if (!empty($error)) : ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user" id="exampleInputUser" placeholder="Tên đăng nhập">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Địa chỉ email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mật khẩu">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Đăng ký tài khoản
                            </button>


                            <hr>
                            <a href="adminweb.php" class="btn btn-google btn-user btn-block">
                             <i class="fab fa-google fa-fw"></i> Login with Google
                            </a>
                           <a href="adminweb.php" class="btn btn-facebook btn-user btn-block">
                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                            </a>
                        </form>

                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Bạn đã có tài khảon? Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
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

</body>

</html>