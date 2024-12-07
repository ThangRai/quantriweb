<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển hướng đến trang login
    exit();
}

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role']; // Lấy role từ session

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "quantriweb";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Không tìm thấy người dùng.";
    exit();
}

// Cập nhật thông tin người dùng nếu form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_points = $_POST['points'];

    // Kiểm tra và xử lý ảnh upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $profile_image = $_FILES['profile_image'];
        
        // Kiểm tra loại file
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = pathinfo($profile_image['name'], PATHINFO_EXTENSION);
        
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            // Đặt tên file mới và di chuyển file vào thư mục uploads
            $upload_dir = 'uploads/profile_pics/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Tạo thư mục nếu chưa tồn tại
            }
            $file_name = $user_id . '.' . $file_extension;
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($profile_image['tmp_name'], $file_path)) {
                // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                $update_image_sql = "UPDATE users SET profile_pic = ? WHERE id = ?";
                $update_image_stmt = $conn->prepare($update_image_sql);
                $update_image_stmt->bind_param("si", $file_path, $user_id);
                $update_image_stmt->execute();
            } else {
                $errorMessage = "Có lỗi xảy ra khi tải ảnh lên.";
            }
        } else {
            $errorMessage = "Chỉ chấp nhận các định dạng ảnh JPG, PNG, GIF.";
        }
    }

    // Cập nhật thông tin người dùng (username, email, points)
    $update_sql = "UPDATE users SET username = ?, email = ?, points = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssii", $new_username, $new_email, $new_points, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['username'] = $new_username; // Cập nhật thông tin trong session
        $successMessage = "Cập nhật thông tin thành công!";
    } else {
        $errorMessage = "Có lỗi xảy ra khi cập nhật thông tin.";
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
    <title>Trang thông tin người dùng</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
       /* Tổng thể trang */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9fafb;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

/* Nền container */
.container {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 700px;
    padding: 30px;
    transition: all 0.3s ease-in-out;
    text-align: center;
}

/* Hiệu ứng hover cho container */
.container:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

/* Tiêu đề chính */
h2 {
    font-size: 2rem;
    color: #007bff;
    margin-bottom: 20px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Các input trong form */
input[type="text"],
input[type="email"],
input[type="number"],
button {
    width: 100%;
    padding: 15px;
    margin-bottom: 15px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    background-color: #f4f7fc;
    color: #333;
    box-sizing: border-box;
    outline: none;
    transition: all 0.3s ease;
}

/* Hiệu ứng khi hover trên các input */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="number"]:focus {
    border-color: #007bff;
    background-color: #eaf1ff;
}

/* Nút submit */
button {
    background-color: #007bff;
    color: #fff;
    border: none;
    font-size: 1.1rem;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Hiệu ứng khi hover vào nút */
button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

/* Thông báo thành công và lỗi */
div {
    font-size: 1rem;
    padding: 12px;
    border-radius: 8px;
    margin-top: 20px;
    text-align: center;
}

/* Màu sắc cho thông báo */
div[style="color: red;"] {
    background-color: #f8d7da;
    color: #721c24;
}

div[style="color: green;"] {
    background-color: #d4edda;
    color: #155724;
}

/* Phần hiển thị thông tin người dùng */
.user-info {
    font-size: 1rem;
    margin-top: 20px;
    color: #555;
}

/* Cải tiến hình ảnh người dùng nếu có */
.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 20px auto;
}

/* Hiệu ứng Popup */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    max-width: 400px;
    width: 100%;
}

.popup-content button {
    background-color: #007bff;
    color: #fff;
    border: none;
    font-size: 1rem;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.popup-content button:hover {
    background-color: #0056b3;
}

/* Các hiệu ứng loading hoặc hiển thị của phần tử */
@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hiệu ứng cho form */
form {
    animation: fadeUp 1s ease-out;
}

/* Thêm khoảng cách giữa các phần tử */
label {
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 8px;
    text-align: left;
}

/* Style cho các input */
input[type="text"],
input[type="email"],
input[type="number"] {
    font-size: 1rem;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="number"]:focus {
    outline: none;
    border-color: #007bff;
    background-color: #eaf1ff;
}

/* Thêm khoảng cách cho ảnh đại diện */
.profile-img img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông tin cá nhân</h2>

        <!-- Ảnh đại diện của người dùng -->
        <div class="profile-img">
            <img src="<?php echo !empty($user['profile_pic']) ? $user['profile_pic'] : 'path/to/default/avatar.jpg'; ?>" alt="Avatar">
        </div>

        <!-- Form cập nhật thông tin người dùng -->
        <form method="POST" enctype="multipart/form-data">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
            
            <label for="points">Điểm:</label>
            <input type="number" id="points" name="points" value="<?php echo $user['points']; ?>"><br><br>
            
            <label for="profile_image">Ảnh đại diện:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*"><br><br>
            
            <button type="submit">Cập nhật thông tin</button>
        </form>

        <!-- Thông báo thành công hoặc lỗi -->
        <?php if (!empty($errorMessage)) : ?>
            <div style="color: red;"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <div class="user-info">
            <h3>Chào mừng <?php echo $user['username']; ?>!</h3>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Vai trò: <?php echo $user['role']; ?></p>
            <p>Điểm: <?php echo $user['points']; ?></p>
        </div>
    </div>

    <!-- Popup thông báo -->
    <?php if (isset($successMessage)) : ?>
        <div class="popup" id="popup">
            <div class="popup-content">
                <p><?php echo $successMessage; ?></p>
                <button onclick="closePopup()">Xác nhận</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Hiển thị popup nếu có thông báo thành công
        <?php if (isset($successMessage)) : ?>
            document.getElementById('popup').style.display = 'flex';
        <?php endif; ?>

        // Hàm đóng popup
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
