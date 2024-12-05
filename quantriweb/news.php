<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb"; // Tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn các bài viết
$sql = "SELECT id, title, content, image_url, created_at, author FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Kiểm tra nếu có bài viết nào
if ($result->num_rows > 0) {
    // Hiển thị danh sách bài viết
    echo '<div class="posts-container">'; // Thêm container bao quanh các bài viết
    while ($row = $result->fetch_assoc()) {
        // In ra bài viết
        echo '<div class="post-item">';
        
        // Nếu có hình ảnh
        if (!empty($row['image_url'])) {
            echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '" class="post-image">';
        }
        
        // Tiêu đề bài viết
        echo '<h2 class="post-title"><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
        
        
        // Nội dung bài viết (mô tả ngắn)
        echo '<p class="post-content">' . substr($row['content'], 0, 150) . '...</p>';

        // Tác giả
        echo '<p class="post-author">Tác giả: ' . $row['author'] . '</p>'; // Hiển thị tên tác giả
        
        // Ngày đăng
        echo '<p class="post-date">Ngày đăng: ' . date("d/m/Y", strtotime($row['created_at'])) . '</p>';
        
        // Nút "Xem Thêm"
        echo '<a href="post.php?id=' . $row['id'] . '" class="read-more">Xem Thêm</a>';
        
        echo '</div>';
    }
    echo '</div>'; // Đóng container
} else {
    echo "Chưa có bài viết nào!";
}

// Đóng kết nối
$conn->close();
?>


<style>
    /* Định dạng cho container chứa các bài viết */
        .posts-container {
            display: grid; /* Sử dụng CSS Grid */
            grid-template-columns: repeat(4, 1fr); /* Tạo 4 cột đều nhau */
            gap: 20px; /* Khoảng cách giữa các cột */
            max-width: 1200px; /* Chiều rộng tối đa của container */
            margin: 0 auto; /* Căn giữa container */
        }

        /* Định dạng chung cho bài viết */
        .post-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex; /* Sử dụng flexbox để căn chỉnh */
            flex-direction: column; /* Xếp các phần tử theo chiều dọc */
            height: 100%; /* Đảm bảo chiều cao của cột đầy */
            justify-content: space-between; /* Căn giữa các phần tử dọc theo chiều cao */
        }

        /* Đảm bảo chiều cao của ảnh và nội dung bằng nhau */
        .post-item img {
            width: 100%;
            height: 200px; /* Giới hạn chiều cao ảnh */
            object-fit: cover; /* Giữ tỷ lệ ảnh, cắt bớt nếu cần */
            border-radius: 8px;
            margin-bottom: 15px;
        }

        /* Tiêu đề bài viết */
        .post-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            text-decoration: none;
        }

        /* Nội dung bài viết (mô tả ngắn) */
        .post-content {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
            flex-grow: 1; /* Để cho nội dung có thể chiếm hết không gian còn lại */
        }
        /* Định dạng cho tác giả */
        .post-author {
            font-size: 1rem;
            color: #555;
            margin-bottom: 0;
            font-style: italic;
        }
        .post-date {
            font-size: 1rem;
            color: #555;
            margin-bottom: 0;
            font-style: italic;
        }
        /* Nút "Xem Thêm" */
        .read-more {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #28a745;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .read-more:hover {
            background-color: #218838;
        }

        /* Thêm một chút hiệu ứng khi hover */
        .post-item:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        /* Đối với màn hình nhỏ hơn 768px */
        @media (max-width: 768px) {
            .posts-container {
                grid-template-columns: 1fr 1fr; /* 2 cột trên màn hình nhỏ */
            }

            .post-item {
                padding: 15px;
            }

            .post-title {
                font-size: 1.5rem;
            }

            .post-content {
                font-size: 1rem;
            }

            .post-date {
                font-size: 0.9rem;
            }
            .post-author {
                font-size: 0.9rem; /* Giảm kích thước chữ cho tác giả trên màn hình nhỏ */
            }
        }

        /* Đối với màn hình nhỏ hơn 480px */
        @media (max-width: 480px) {
            .posts-container {
                grid-template-columns: 1fr; /* 1 cột trên màn hình rất nhỏ */
            }
        }

</style>
