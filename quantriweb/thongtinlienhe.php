<?php
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

// Lấy danh sách liên hệ
$sql = "SELECT * FROM lienhe";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Liên Hệ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .table img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.btn-sm {
    font-size: 0.8rem;
    padding: 5px 10px;
}

    </style>
</head>
<body>
<div id="loading" style="display: none; text-align: center; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background-color: rgba(255,255,255,0.8); padding: 20px; border-radius: 8px;">
        <img src="spinner.gif" alt="Loading..." style="width: 50px;">
        <p>Đang xử lý...</p>
    </div>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Thông Tin Liên Hệ</h1>

    <!-- Form thêm mới -->
    <form id="addForm" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="newImage" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="newImage" name="image" required>
        </div>
        <div class="mb-3">
            <label for="newName" class="form-label">Tên liên hệ</label>
            <input type="text" class="form-control" id="newName" name="name" required>
        </div>
        <div class="mb-3">
            <label for="newLink" class="form-label">Đường dẫn</label>
            <input type="text" class="form-control" id="newLink" name="link" required>
        </div>
        <div class="mb-3">
            <label for="newType" class="form-label">Loại liên hệ</label>
            <select class="form-select" id="newType" name="type" required>
                <option value="hotline">Hotline</option>
                <option value="email">Email</option>
                <option value="zalo">Zalo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm liên hệ</button>
    </form>

    <!-- Danh sách liên hệ -->
    <table class="table table-bordered mt-5">
        <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên liên hệ</th>
            <th>Đường dẫn</th>
            <th>Loại liên hệ</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody id="contactList">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="row-<?php echo $row['id']; ?>">
                <td>
                    <img src="<?php echo $row['image']; ?>" alt="Icon" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                    <input type="file" class="form-control mt-2 update-image" data-id="<?php echo $row['id']; ?>">
                </td>
                <td>
                    <input type="text" class="form-control update-name" data-id="<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['ten_lienhe']); ?>">
                </td>
                <td>
                    <input type="text" class="form-control update-link" data-id="<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['duong_dan']); ?>">
                </td>
                <td>
                    <select class="form-select update-type" data-id="<?php echo $row['id']; ?>">
                        <option value="hotline" <?php echo $row['loai_lienhe'] == 'hotline' ? 'selected' : ''; ?>>Hotline</option>
                        <option value="email" <?php echo $row['loai_lienhe'] == 'email' ? 'selected' : ''; ?>>Email</option>
                        <option value="zalo" <?php echo $row['loai_lienhe'] == 'zalo' ? 'selected' : ''; ?>>Zalo</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm delete-contact" data-id="<?php echo $row['id']; ?>">Xóa</button>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    // Thêm liên hệ mới
    $('#addForm').submit(function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: 'ajax_handler.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response === 'success') {
                    alert('Thêm liên hệ thành công');
                    location.reload();
                } else {
                    alert('Thêm liên hệ thất bại');
                }
            }
        });
    });

    // Xóa liên hệ
    $('.delete-contact').click(function() {
        const id = $(this).data('id');
        if (confirm('Bạn có chắc chắn muốn xóa liên hệ này?')) {
            $.post('ajax_handler.php', { action: 'delete', id }, function(response) {
                if (response === 'success') {
                    $('#row-' + id).remove();
                } else {
                    alert('Xóa thất bại');
                }
            });
        }
    });

    // Cập nhật thông tin
    $('.update-name, .update-link, .update-type').change(function() {
        const id = $(this).data('id');
        const column = $(this).hasClass('update-name') ? 'ten_lienhe' :
                       $(this).hasClass('update-link') ? 'duong_dan' : 'loai_lienhe';
        const value = $(this).val();

        $.post('ajax_handler.php', { action: 'update', id, column, value }, function(response) {
            if (response !== 'success') {
                alert('Cập nhật thất bại');
            }
        });
    });

    // Cập nhật hình ảnh
    $('.update-image').change(function() {
        const id = $(this).data('id');
        const formData = new FormData();
        formData.append('image', this.files[0]);
        formData.append('id', id);

        $.ajax({
            url: 'ajax_handler.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response === 'success') {
                    alert('Cập nhật ảnh thành công');
                    location.reload();
                } else {
                    alert('Cập nhật ảnh thất bại');
                }
            }
        });
    });
</script>
</body>
</html>
