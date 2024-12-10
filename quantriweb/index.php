<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quantriweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách hình ảnh từ bảng slideshow
$sql_slideshow = "SELECT * FROM slideshow";
$result_slideshow = $conn->query($sql_slideshow);

// Lấy danh sách menu từ bảng menus, sắp xếp theo thứ tự
$sql_menu = "SELECT menu_name, menu_link FROM menus ORDER BY sort_order ASC";
$result_menu = $conn->query($sql_menu);

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Lấy danh sách bài viết
$sql_news = "SELECT id, title, content, image_url, created_at, author FROM posts ORDER BY created_at DESC LIMIT 5";
$result_news = $conn->query($sql_news);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #4e73df;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .navbar .navbar-brand {
            display: flex;
            align-items: center;
            padding-right: 0;
        }
        .navbar .navbar-brand img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .navbar .navbar-brand, .navbar .nav-link {
            color: #fff !important;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        .navbar .nav-link:hover {
            color: #f8f9fc !important;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        .navbar-nav {
            display: flex;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-start;
        }
        .navbar-nav .nav-item {
            list-style: none;
            margin-left: 20px;
        }
        /* Định dạng cho ảnh trong carousel */
        .carousel-inner {
            width: 100%;
            max-height: auto;  /* Đặt chiều cao tối đa cho ảnh */
            overflow: hidden; /* Ẩn phần ảnh ngoài vùng hiển thị */
        }

        .carousel-item img {
            width: 100%; /* Làm cho ảnh chiếm toàn bộ chiều rộng của carousel */
            height: auto; /* Đảm bảo tỷ lệ khung hình của ảnh không bị biến dạng */
            object-fit: cover; /* Cắt ảnh nếu kích thước không tương thích */
            transition: transform 0.5s ease; /* Hiệu ứng chuyển động mượt mà */
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em;
            color: #333;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Hiển thị 4 cột */
            gap: 20px;
            padding: 20px;
            max-width: 1200px; /* Chiều rộng tối đa là 1200px */
            margin: 0 auto;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product h3 {
            margin: 15px 0;
            font-size: 1.2em;
            color: #333;
        }

        .product .price-container {
            display: flex;
            justify-content: space-between; /* Căn trái phải */
            align-items: center;
            margin-bottom: 10px;
        }

        .product .original-price {
            text-decoration: line-through;
            color: red;
            text-align: left;
        }

        .product .current-price {
            color: #27ae60; /* Màu xanh cho giá hiện tại */
            text-align: right;
        }

        .product .buy-btn {
            display: inline-block;
            background-color: #27ae60;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .product .buy-btn:hover {
            background-color: #2ecc71;
        }

        .product .buy-btn i {
            margin-left: 5px;
        }

        /* Responsive design */
        @media (max-width: 1200px) {
            .products {
                grid-template-columns: repeat(3, 1fr); /* 3 cột trên màn hình nhỏ hơn */
            }
        }

        @media (max-width: 1024px) {
            .products {
                grid-template-columns: repeat(2, 1fr); /* 2 cột trên màn hình nhỏ hơn */
            }
        }

        @media (max-width: 768px) {
            .products {
                grid-template-columns: repeat(1, 1fr); /* 1 cột trên màn hình di động */
            }
        }
        .news {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Hiển thị 2 cột */
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.news-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: row;
}

.news-item:hover {
    transform: translateY(-10px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.news-image {
    width: 150px; /* Chiều rộng của hình ảnh */
    height: 150px; /* Chiều cao của hình ảnh */
    object-fit: cover; /* Đảm bảo tỷ lệ ảnh */
    border-right: 1px solid #ddd;
}

.news-content {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.news-content h3 {
    margin: 0 0 10px;
    font-size: 1.2em;
    color: #333;
}

.news-content p {
    color: #666;
    font-size: 0.95em;
    margin: 0 0 10px;
}

.news-content .read-more {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    transition: color 0.3s ease;
}

.news-content .read-more:hover {
    color: #0056b3;
}
.news-author {
    font-size: 0.9em;
    color: #888;
    margin-top: 5px;
}


/* Responsive Design */
@media (max-width: 768px) {
    .news {
        grid-template-columns: repeat(1, 1fr); /* 1 cột trên màn hình nhỏ */
    }
    .news-item {
        flex-direction: column; /* Đặt ảnh và nội dung theo cột trên màn hình nhỏ */
    }
    .news-image {
        width: 100%;
        height: 200px; /* Chiều cao mới cho ảnh */
        border-right: none;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">
            <img src="./img/logo.png" alt="Logo">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php while ($row_menu = $result_menu->fetch_assoc()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $row_menu['menu_link']; ?>">
                            <?php echo $row_menu['menu_name']; ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </nav>

    <!-- Slideshow (Carousel) -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <?php
            $active = 'active';
            while ($row = $result_slideshow->fetch_assoc()):
                if (!empty($row['image_url'])):
                    $image_url = "http://localhost/quantriweb/quantriweb/" . $row['image_url'];
                    if (file_exists($row['image_url'])):
            ?>
            <div class="carousel-item <?php echo $active; ?>">
                <img src="<?php echo $image_url; ?>" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <?php 
                    $active = '';
                    endif;
                endif;
            endwhile;
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Danh sách sản phẩm -->
    <h1>Danh Sách Sản Phẩm</h1>
    <div class="products">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" />
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    
                    <!-- Sử dụng flexbox để hiển thị giá gốc và giá hiện tại trên cùng một hàng -->
                    <div class="price-container">
                        <p class="original-price"><?php echo number_format($row['original_price'], 0, ',', '.'); ?> VNĐ</p>
                        <p class="current-price"><?php echo number_format($row['current_price'], 0, ',', '.'); ?> VNĐ</p>
                    </div>
                    
                    <!-- Nút Mua Ngay có icon giỏ hàng -->
                    <a href="buy.php?id=<?php echo $row['id']; ?>" class="buy-btn">
                        Mua Ngay <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center; width:100%; font-size: 1.2em; color: #e74c3c;">Chưa có sản phẩm nào.</p>
        <?php endif; ?>
    </div>

<!-- Danh sách tin tức -->
<h1 style="margin-top: 50px;">Tin Tức Mới Nhất</h1>
<div class="news">
    <?php if ($result_news->num_rows > 0): ?>
        <?php while ($row = $result_news->fetch_assoc()): ?>
            <div class="news-item">
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="news-image" />
                <div class="news-content">
    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
    <p><?php echo htmlspecialchars($row['content']); ?></p>
    <p class="news-author">Tác giả: <?php echo htmlspecialchars($row['author']); ?></p>
    <a href="post.php?id=<?php echo $row['id']; ?>" class="read-more">Xem Thêm</a>
</div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; width:100%; font-size: 1.2em; color: #e74c3c;">Hiện chưa có tin tức nào.</p>
    <?php endif; ?>
</div>

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

    <?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách tất cả hình ảnh đối tác
$sql = "SELECT image FROM doitac";
$result = $conn->query($sql);
?>

    <style>
        .partner-gallery {
            display: flex;
            overflow-x: auto; /* Thanh cuộn ngang */
            white-space: nowrap; /* Không xuống hàng */
            justify-content: space-between;
            gap: 20px;
            margin: 20px auto;
            padding: 10px;

        }

        .partner-gallery img {
            width: 150px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
                /* Đảm bảo thanh cuộn đẹp trên một số trình duyệt */
                .partner-gallery::-webkit-scrollbar {
            height: 8px;
        }
        .partner-gallery::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .partner-gallery::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <!-- Bản đồ -->
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.687473924022!2d105.841171!3d21.006549!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abc123456789%3A0x1a2b3c4d5e6f7g8h!2sHanoi%2C%20Vietnam!5e0!3m2!1sen!2s!4v1630929123456!5m2!1sen!2s" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

    <!-- Danh sách hình ảnh đối tác -->
    <h1>Đối tác</h1>

    <!-- Danh sách hình ảnh đối tác -->
    <div class="partner-gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <img src="<?php echo $row['image']; ?>" alt="Đối Tác">
        <?php endwhile; ?>
    </div>

<?php
// Đóng kết nối
$conn->close();
?>
<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách liên hệ
$sql_lienhe = "SELECT * FROM lienhe";
$result_lienhe = $conn->query($sql_lienhe);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome cho icon -->
    <style>
        /* CSS cho các nút liên hệ cố định */
        .contact-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Thiết kế các nút liên hệ */
        .contact-buttons .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            background-color: #007bff; /* Màu nền */
            color: white;
            border-radius: 30px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Hiệu ứng zoom và shadow */
            width: 160px; /* Kích thước nút */
            height: 50px;
        }

        /* Hiệu ứng zoom khi hover */
        .contact-buttons .btn:hover {
            transform: scale(1.1); /* Phóng to nút khi di chuột */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Thêm bóng khi hover */
        }

        /* Thiết kế icon bên trong nút */
        .contact-buttons .btn i {
            margin-right: 10px; /* Khoảng cách giữa icon và text */
            font-size: 20px; /* Kích thước icon */
        }

        /* Hiệu ứng khi nút đang tải (loading) */
        .contact-buttons .btn[disabled] {
            background-color: #ddd;
            cursor: not-allowed;
        }

        /* Thiết kế nút trên nền sáng */
        .contact-buttons .btn-primary {
            background-color: #007bff;
        }

        .contact-buttons .btn-primary:hover {
            background-color: #0056b3; /* Màu khi hover */
        }

        /* Hiệu ứng khi nút có icon */
        .contact-buttons .btn img {
            width: 30px; /* Đảm bảo kích thước icon hình ảnh */
            height: 30px;
            object-fit: cover;
            border-radius: 50%; /* Nếu bạn muốn icon hình tròn */
        }
    </style>
</head>
<body>

    <!-- Nút liên hệ cố định -->
    <div class="contact-buttons">
        <?php while ($row_lienhe = $result_lienhe->fetch_assoc()): ?>
            <a href="<?php echo $row_lienhe['duong_dan']; ?>" class="btn btn-primary" target="_blank">
                <!-- Bạn có thể thay icon hoặc sử dụng ảnh -->
                <?php if ($row_lienhe['loai_lienhe'] == 'hotline'): ?>
                    <i class="fas fa-phone-alt"></i> <!-- Icon Hotline -->
                <?php elseif ($row_lienhe['loai_lienhe'] == 'email'): ?>
                    <i class="fas fa-envelope"></i> <!-- Icon Email -->
                <?php elseif ($row_lienhe['loai_lienhe'] == 'zalo'): ?>
                    <i class="fas fa-comments"></i> <!-- Icon Zalo -->
                <?php endif; ?>
                <?php echo $row_lienhe['ten_lienhe']; ?>
            </a>
        <?php endwhile; ?>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>



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

    <!-- Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
