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

// Biến thông báo lỗi
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra nếu nhập thiếu thông tin
    if (empty($username) || empty($password)) {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        // Kiểm tra thông tin đăng nhập
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Lấy dữ liệu người dùng
            $user = $result->fetch_assoc();

            // Kiểm tra mật khẩu
            if ($password === $user['password']) { // Nếu mật khẩu không mã hóa
                // Lưu thông tin vào session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Chuyển hướng đến trang admin hoặc user
                if ($user['role'] === 'admin') {
                    header("Location: adminweb.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                $error = "Mật khẩu không chính xác.";
            }
        } else {
            $error = "Tên đăng nhập không tồn tại.";
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

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-login-image {
    background: url(https://cdn.pixabay.com/photo/2024/02/19/02/02/login-8582362_640.png);
    background-position: center;
    background-size: cover;
}
    </style>

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
                                        <h1 class="h4 text-gray-900 mb-4">Chào mừng trở lại!</h1>
                                        </div>
                                        <form class="user" action="login.php" method="POST">
                                            <?php if (!empty($error)) : ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $error; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="exampleInputUser" placeholder="Tên đăng nhập...">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mật khẩu">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Đăng nhập</button>
                                        
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
                                        <a class="small" href="register.php">Tạo tài khoản!</a>
                                    </div>
                                </div>
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