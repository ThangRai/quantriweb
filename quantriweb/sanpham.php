<?php
// Kết nối với cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em;
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

        /* Sử dụng flexbox để đưa giá gốc và giá hiện tại lên cùng một hàng */
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
                grid-template-columns: repeat(4, 1fr); /* 4 cột trên màn hình nhỏ hơn */
            }
        }

        @media (max-width: 1024px) {
            .products {
                grid-template-columns: repeat(3, 1fr); /* 3 cột trên màn hình nhỏ hơn */
            }
        }

        @media (max-width: 768px) {
            .products {
                grid-template-columns: repeat(2, 1fr); /* 2 cột trên màn hình di động */
            }
        }

        @media (max-width: 480px) {
            .products {
                grid-template-columns: 1fr; /* 1 cột trên màn hình nhỏ */
            }
        }

    </style>
</head>
<body>
    <h1>Danh Sách Sản Phẩm</h1>
    <div class="products">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" />
                    <h3><?php echo $row['name']; ?></h3>
                    
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
            <p>Chưa có sản phẩm nào.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
