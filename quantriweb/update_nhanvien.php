<?php
// update_nhanvien.php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $points = $_POST['points'];

    // Kết nối cơ sở dữ liệu và thực hiện cập nhật
    $conn = new mysqli("localhost", "root", "", "quantriweb");
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ?, points = ? WHERE id = ?");
    $stmt->bind_param("sssii", $username, $email, $password, $points, $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
