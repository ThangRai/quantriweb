<?php
session_start();

// Kết nối DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$error = "";
$successMessage = "";

// Kiểm tra nếu người dùng đã nhập OTP và mật khẩu mới
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'], $_POST['new_password'])) {
    $otp = trim($_POST['otp']);
    $new_password = trim($_POST['new_password']);
    
    // Kiểm tra OTP
    if (empty($otp) || empty($new_password)) {
        $error = "Vui lòng nhập mã OTP và mật khẩu mới!";
    } elseif ($otp != $_SESSION['otp']) {
        // Kiểm tra mã OTP
        $error = "Mã OTP không đúng!";
    } else {
        // Cập nhật mật khẩu mới mà không mã hóa
        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_password, $user_id);
        
        if ($stmt->execute()) {
            $successMessage = "Mật khẩu đã được thay đổi thành công!";
            unset($_SESSION['otp']); // Xóa OTP sau khi thay đổi mật khẩu thành công
        } else {
            $error = "Có lỗi xảy ra. Vui lòng thử lại!";
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

    <title>SB Admin 2 - Reset Password</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Đặt Lại Mật Khẩu</h1>
                                        <p class="mb-4">Vui lòng nhập mã OTP và mật khẩu mới của bạn.</p>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="otp" class="form-control form-control-user" placeholder="Nhập mã OTP...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="new_password" class="form-control form-control-user" placeholder="Nhập mật khẩu mới...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Đổi mật khẩu</button>
                                    </form>

                                    <!-- Thông báo thành công hoặc lỗi -->
                                    <?php if (!empty($error)) : ?>
                                        <div style="color: red;"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($successMessage)) : ?>
                                        <div style="color: green;"><?php echo $successMessage; ?></div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        <?php if (!empty($successMessage)) : ?>
            // Nếu mật khẩu được thay đổi thành công, hiển thị thông báo và quay lại trang login sau 3 giây
            setTimeout(function() {
                alert("Mật khẩu đã được thay đổi thành công!");
                window.location.href = "login.php";  // Chuyển hướng về trang đăng nhập
            }, 3000); // 3 giây
        <?php endif; ?>
    </script>

</body>
</html>
