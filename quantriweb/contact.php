<?php
// Cấu hình CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

// Kết nối tới CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Cấu hình Telegram Bot
$telegramBotToken = "6608663537:AAExeC77L9XmTSK3lpW0Q3zt_kGfC1qKZfA";
$telegramChatId = "5901907211";

// Xử lý form khi người dùng gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $phone = htmlspecialchars($_POST['phone']);

    // Lưu vào CSDL
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    if ($stmt->execute()) {
        $successMessage = "Thông tin của bạn đã được lưu và gửi đi thành công!";
    } else {
        $errorMessage = "Lỗi khi lưu thông tin vào CSDL: " . $stmt->error;
    }

    // Nội dung tin nhắn gửi đến Telegram
    $telegramMessage = "📩 **Thông tin liên hệ mới**:\n\n" .
                       "👤 Tên: $name\n" .
                       "📧 Email: $email\n" .
                       "📞 Số điện thoại: $phone\n" .
                       "💬 Lời nhắn:\n$message";

    // Gửi tin nhắn đến Telegram
    $telegramUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage";
    $data = [
        'chat_id' => $telegramChatId,
        'text' => $telegramMessage,
        'parse_mode' => 'Markdown',
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($telegramUrl, false, $context);

    // Kiểm tra trạng thái gửi
    if (!$response) {
        $errorMessage = "Đã xảy ra lỗi khi gửi thông tin qua Telegram.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body và tiêu đề chính */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
            font-size: 2.5rem;
        }

        /* Container chính */
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Hai cột ngang */
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Cột thông tin liên hệ và form */
        .contact-info, .contact-form {
            flex: 1;
            min-width: 45%; /* Đảm bảo chia đôi màn hình lớn */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Thông tin liên hệ */
        .contact-info h4 {
            margin-bottom: 15px;
            color: #555;
        }

        .contact-info p {
            font-size: 1rem;
            line-height: 1.6;
            color: #666;
        }

        /* Form liên hệ */
        .contact-form h4 {
            margin-bottom: 20px;
            color: #555;
        }

        .form-group input, .form-group textarea {
            width: 96%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 8px rgba(40, 167, 69, 0.2);
        }

        .btn-submit {
            background-color: #28a745;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
            transform: scale(1.02);
        }

        /* Bản đồ */
        .map-container {
            margin-top: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: 0;
        }

        /* Đáp ứng màn hình nhỏ */
        @media (max-width: 768px) {
            /* Thiết lập lại chiều rộng cho các cột */
            .contact-row {
                flex-direction: column;
            }

            .contact-info, .contact-form {
                padding: 15px; /* Giảm padding khi trên di động */
            }

            h1 {
                font-size: 2rem; /* Giảm kích thước font tiêu đề trên di động */
            }

            /* Thay đổi kích thước các trường input và button */
            .form-group input, .form-group textarea {
                font-size: 1rem; /* Giảm kích thước font trong input và textarea */
                padding: 8px; /* Giảm padding để form gọn hơn */
            }

            .btn-submit {
                font-size: 1.1rem; /* Giảm kích thước font cho nút submit */
                padding: 8px 15px; /* Giảm padding cho nút submit */
            }

            /* Thay đổi kích thước bản đồ */
            .map-container iframe {
                height: 300px; /* Giảm chiều cao bản đồ trên di động */
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem; /* Giảm kích thước tiêu đề cho các màn hình nhỏ hơn */
            }

            /* Điều chỉnh các input và textarea thêm */
            .form-group input, .form-group textarea {
                padding: 6px; /* Giảm padding thêm một chút trên màn hình cực nhỏ */
            }

            .btn-submit {
                font-size: 1rem; /* Giảm kích thước nút submit */
                padding: 6px 12px; /* Giảm padding cho nút submit */
            }
        }

                .footer {
                    background-color: #343a40; /* Màu nền tối */
                    color: #ffffff; /* Màu chữ trắng */
                    text-align: center; /* Căn giữa nội dung */
                    padding: 30px 0; /* Padding trên và dưới */
                    position: relative; /* Đảm bảo footer ở dưới cùng trang */
                    bottom: 0;
                    width: 100%;
                }

                .footer a {
                    color: #ffffff; /* Màu chữ cho liên kết */
                    text-decoration: none; /* Bỏ gạch chân mặc định */
                    font-weight: bold; /* Làm chữ liên kết đậm */
                }

                .footer a:hover {
                    color: #f8f9fa; /* Màu chữ sáng hơn khi hover */
                    text-decoration: underline; /* Gạch chân khi hover */
                }

                .footer .container {
                    max-width: 1200px; /* Kích thước tối đa của container */
                    margin: 0 auto; /* Căn giữa container */
                }

    </style>
</head>
<body>

<div class="container contact-container">
    <h1>Liên Hệ Với Chúng Tôi</h1>

    <div class="contact-row">
        <!-- Thông tin liên hệ -->
        <div class="contact-info">
            <h4>Thông tin liên hệ</h4>
            <p>📍 Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</p>
            <p>📞 Số điện thoại: 0901234567</p>
            <p>📧 Email: contact@example.com</p>
        </div>

        <!-- Form liên hệ -->
        <div class="contact-form">
            <h4>Gửi Thông Tin Liên Hệ</h4>
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success"><?= $successMessage; ?></div>
            <?php elseif (isset($errorMessage)): ?>
                <div class="alert alert-danger"><?= $errorMessage; ?></div>
            <?php endif; ?>
            <form method="POST" action="contact.php">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ và tên của bạn" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại của bạn" required>
                </div>
                <div class="form-group">
                    <label for="message">Lời nhắn</label>
                    <textarea id="message" name="message" class="form-control" rows="5" placeholder="Nhập lời nhắn của bạn" required></textarea>
                </div>
                <button type="submit" class="btn-submit">Gửi Thông Tin</button>
            </form>
        </div>
    </div>

    <!-- Bản đồ -->
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.687473924022!2d105.841171!3d21.006549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abc123456789%3A0x1a2b3c4d5e6f7g8h!2sHanoi%2C%20Vietnam!5e0!3m2!1sen!2s!4v1630929123456!5m2!1sen!2s" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</div>
    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2024 Website của bạn. Tất cả quyền được bảo vệ.</p>
            <p>
                <a href="privacy-policy.php" class="text-white">Chính sách bảo mật</a> | 
                <a href="terms-of-service.php" class="text-white">Điều khoản sử dụng</a>
            </p>
        </div>
    </footer>

</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
