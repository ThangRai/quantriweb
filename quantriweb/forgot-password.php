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

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // Kiểm tra nếu email không rỗng
    if (empty($email)) {
        $error = "Vui lòng nhập địa chỉ email!";
    } else {
        // Kiểm tra email tồn tại trong cơ sở dữ liệu
        $sql = "SELECT id, username FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Lấy ID người dùng và tạo mã OTP
            $user = $result->fetch_assoc();
            $otp = rand(100000, 999999); // Mã OTP ngẫu nhiên

            // Lưu OTP vào cơ sở dữ liệu hoặc session (ví dụ lưu vào session)
            $_SESSION['otp'] = $otp;
            $_SESSION['user_id'] = $user['id'];

            // Gửi OTP qua Telegram
            $telegram_token = "6608663537:AAExeC77L9XmTSK3lpW0Q3zt_kGfC1qKZfA"; // Thay thế bằng token của bạn
            $telegram_chat_id = "5901907211"; // Thay thế bằng chat ID của người nhận

            // Chuẩn bị tin nhắn
            $message = "Mã OTP của bạn để đặt lại mật khẩu là: $otp";

            // Gửi tin nhắn qua Telegram
            $url = "https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$telegram_chat_id&text=" . urlencode($message);
            $response = file_get_contents($url);

        // Nếu gửi OTP thành công, chuyển hướng đến trang nhập OTP
        if ($response) {
            header('Location: reset-password.php');
            exit();
        } else {
                $error = "Không thể gửi mã OTP qua Telegram. Vui lòng thử lại!";
            }
        } else {
            $error = "Email không tồn tại!";
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

    <title>SB Admin 2 - Forgot Password</title>

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
                                        <h1 class="h4 text-gray-900 mb-2">Quên Mật Khẩu?</h1>
                                        <p class="mb-4">Chúng tôi đã gửi mã OTP đến Telegram của bạn!</p>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Nhập địa chỉ email...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Gửi OTP
                                        </button>
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

</body>
</html>
