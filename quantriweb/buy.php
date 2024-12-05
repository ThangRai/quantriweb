<?php
session_start();

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

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Truy vấn thông tin sản phẩm từ CSDL
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Sản phẩm không tồn tại.");
}

// Xử lý đặt hàng khi form được gửi
$error = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];

    
    if (empty($quantity) || empty($customer_name) || empty($customer_email) || empty($customer_address) || empty($customer_phone)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        $total_price = $product['current_price'] * $quantity;
        $order_sql = "INSERT INTO orders (product_id, quantity, total_price, customer_name, customer_email, customer_address, customer_phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $order_stmt = $conn->prepare($order_sql);
        $order_stmt->bind_param("iisssss", $product_id, $quantity, $total_price, $customer_name, $customer_email, $customer_address, $customer_phone);
        
        if ($order_stmt->execute()) {
            $successMessage = "Đặt hàng thành công! Chúng tôi sẽ liên hệ với bạn sớm.";
            header("refresh:3;url=index.php");
            exit();
        } else {
            $error = "Đã có lỗi xảy ra, vui lòng thử lại.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Liên kết đến CSS cập nhật -->
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }

        .product-details img {
            width: 250px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .product-details img:hover {
            transform: scale(1.05);
        }

        .product-info {
            max-width: 600px;
            padding-left: 20px;
        }

        .product-info h3 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }

        .product-info p {
            font-size: 1.2rem;
            color: #777;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
            color: #333;
            transition: border 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="number"]:focus, textarea:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        button {
            background-color: #27ae60;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #2ecc71;
        }

        .alert {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .progress-bar {
            height: 8px;
            background-color: #27ae60;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        /* Thêm hiệu ứng động cho nút "Đặt Hàng" */
        button:active {
            transform: scale(0.98);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .product-details {
                flex-direction: column;
                align-items: center;
            }

            .product-info {
                padding-left: 0;
            }

            .product-details img {
                width: 80%;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Đặt Hàng</h1>

    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <p> Bạn sẽ được chuyển hướng về trang chủ trong vài giây.</p>
    <?php endif; ?>

    <!-- Hiển thị thông tin sản phẩm -->
    <div class="product-details">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <div class="product-info">
            <h3><?php echo $product['name']; ?></h3>
            <p><strong>Giá: </strong><?php echo number_format($product['current_price'], 0, ',', '.'); ?> VNĐ</p>
        </div>
    </div>

    <!-- Form đặt hàng -->
    <form action="buy.php?id=<?php echo $product_id; ?>" method="POST">
        <div class="form-group">
            <label for="quantity">Số Lượng:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" required>
        </div>

        <div class="form-group">
            <label for="customer_name">Tên Khách Hàng:</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>

        <div class="form-group">
            <label for="customer_phone">Số Điện Thoại:</label>
            <input type="text" id="customer_phone" name="customer_phone" required>
        </div>


        <div class="form-group">
            <label for="customer_email">Email:</label>
            <input type="email" id="customer_email" name="customer_email" required>
        </div>

        <div class="form-group">
            <label for="customer_address">Địa Chỉ Giao Hàng:</label>
            <textarea id="customer_address" name="customer_address" required></textarea>
        </div>

        <button type="submit">Đặt Hàng</button>
    </form>
</div>

</body>
</html>
