<?php
// delete_nhanvien.php
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Kết nối cơ sở dữ liệu và thực hiện xóa
    $conn = new mysqli("localhost", "root", "", "quantriweb");
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
