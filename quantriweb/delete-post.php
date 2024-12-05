<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra ID của bài viết
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Thực hiện câu lệnh SQL để xóa bài viết
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        echo "Bài viết đã được xóa thành công.";
        header("Location: index.php"); // Điều hướng lại về trang danh sách
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}

?>

<?php
// Đóng kết nối
$conn->close();
?>
