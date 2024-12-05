<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "quantriweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thư mục lưu ảnh
$upload_dir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_image'])) {
    // Kiểm tra xem file có được chọn hay không
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $image_name = $_FILES['image_url']['name'];
        $image_tmp = $_FILES['image_url']['tmp_name'];
        $image_size = $_FILES['image_url']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Kiểm tra định dạng file (chỉ cho phép ảnh JPG, PNG, GIF)
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_ext, $allowed_ext)) {
            echo "<script>alert('Chỉ cho phép upload ảnh JPG, PNG, GIF!');</script>";
        } else {
            // Tạo tên file duy nhất để tránh trùng lặp
            $new_image_name = uniqid() . '.' . $image_ext;
            $image_path = $upload_dir . $new_image_name;

            // Di chuyển file từ thư mục tạm thời sang thư mục uploads
            if (move_uploaded_file($image_tmp, $image_path)) {
                // Lưu đường dẫn ảnh vào cơ sở dữ liệu
                $sql = "INSERT INTO slideshow (image_url, sort_order) VALUES (?, 0)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $image_path);
                if ($stmt->execute()) {
                    echo "<script>alert('Thêm ảnh slideshow thành công!'); window.location.href='quan_ly_slideshow.php';</script>";
                } else {
                    echo "<script>alert('Lỗi khi thêm ảnh!');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Lỗi khi upload ảnh!');</script>";
            }
        }
    } else {
        echo "<script>alert('Vui lòng chọn ảnh để upload!');</script>";
    }
}

// Lấy danh sách ảnh từ cơ sở dữ liệu
$sql = "SELECT * FROM slideshow ORDER BY sort_order ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Slideshow</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Quản Lý Slideshow</h2>

        <!-- Form Thêm ảnh slideshow -->
        <h4>Thêm ảnh vào slideshow</h4>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image_url">Ảnh Slideshow</label>
                <input type="file" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" name="add_image" class="btn btn-primary">Thêm ảnh</button>
        </form>

        <!-- Danh sách ảnh slideshow -->
        <h4 class="mt-5">Danh Sách Ảnh Slideshow</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Thứ Tự</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><img src="<?php echo $row['image_url']; ?>" width="100"></td>
                    <td><?php echo $row['sort_order']; ?></td>
                    <td>
                        <!-- Nút Xóa -->
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Xử lý xóa ảnh
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Xóa ảnh khỏi cơ sở dữ liệu
    $sql = "DELETE FROM slideshow WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Xóa ảnh thành công!'); window.location.href='quan_ly_slideshow.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa ảnh!');</script>";
    }
    $stmt->close();
}

$conn->close();
?>
