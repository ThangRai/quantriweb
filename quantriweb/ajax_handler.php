<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xóa liên hệ
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM lienhe WHERE id = $id";
    echo $conn->query($sql) ? 'success' : 'error';
}

// Cập nhật thông tin
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = intval($_POST['id']);
    $column = $_POST['column'];
    $value = $conn->real_escape_string($_POST['value']);
    $sql = "UPDATE lienhe SET $column = '$value' WHERE id = $id";
    echo $conn->query($sql) ? 'success' : 'error';
}

// Thêm liên hệ mới
if (isset($_FILES['image'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $name = $conn->real_escape_string($_POST['name']);
        $link = $conn->real_escape_string($_POST['link']);
        $type = $conn->real_escape_string($_POST['type']);
        $sql = "INSERT INTO lienhe (image, ten_lienhe, duong_dan, loai_lienhe) VALUES ('$targetFilePath', '$name', '$link', '$type')";
        echo $conn->query($sql) ? 'success' : 'error';
    } else {
        echo 'error';
    }
}

// Cập nhật hình ảnh
if (isset($_FILES['image']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $targetDir = "uploads/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        $sql = "UPDATE lienhe SET image = '$targetFilePath' WHERE id = $id";
        echo $conn->query($sql) ? 'success' : 'error';
    } else {
        echo 'error';
    }
}

$conn->close();
?>
