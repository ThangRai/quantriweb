<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quantriweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có ID được truyền qua URL hay không
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Lấy ID từ URL và ép kiểu an toàn

    // Truy vấn để lấy thông tin bài viết
    $sql = "SELECT title, content, noidung, image_url, created_at, author FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Không tìm thấy bài viết.");
    }
} else {
    die("Không tìm thấy bài viết.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Bài Viết</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .post-meta {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 20px;
        }

        .post-meta span {
            margin-right: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .content {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <div class="post-meta">
            <span>Tác giả: <?php echo htmlspecialchars($row['author']); ?></span>
            <span>Ngày đăng: <?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($row['created_at']))); ?></span>
        </div>

        <?php if (!empty($row['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
        <?php endif; ?>

        <div class="content">
            <?php echo nl2br(htmlspecialchars($row['content'])); ?>
        </div>
        <div class="noidung">
            <?php echo nl2br(htmlspecialchars($row['noidung'])); ?>
        </div>

        <a href="index.php" class="back-btn">Quay lại</a>
    </div>
</body>
</html>
