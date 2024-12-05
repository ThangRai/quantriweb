<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quantriweb");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ form gửi lên
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; // Không mã hóa mật khẩu
$points = $_POST['points'];
$role = $_POST['role']; // Role mặc định là 'user'

// Thực hiện câu lệnh INSERT
$sql = "INSERT INTO users (username, email, password, points, role) VALUES ('$username', '$email', '$password', '$points', '$role')";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

// Đóng kết nối
$conn->close();
?>
