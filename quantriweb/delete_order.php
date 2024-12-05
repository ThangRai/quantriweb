<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Xoá đơn hàng
    $sql = "DELETE FROM orders WHERE id = $order_id";

    if ($conn->query($sql) === TRUE) {
        echo "Đơn hàng đã bị xoá!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
