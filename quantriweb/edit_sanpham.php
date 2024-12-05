<?php
session_start(); // Khởi tạo phiên

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}

// Nếu đã đăng nhập, lấy thông tin người dùng từ session
$username = $_SESSION['username'];
$role = $_SESSION['role'];  // Nếu bạn cần lấy thông tin vai trò người dùng
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminweb.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="adminweb.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSanpham"
                    aria-expanded="true" aria-controls="collapseSanpham">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Danh Sách Sản Phẩm</span>
                </a>
                <div id="collapseSanpham" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="edit_sanpham.php">Sản Phẩm Chi Tiết</a>
                        <a class="collapse-item" href="sanpham.php">Sản Phẩm List</a>
                        <a class="collapse-item" href="add_sanpham.php">Thêm Sản Phẩm</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="nhanvien.php">
                    <i class="fas fa-user"></i>
                    <span>Danh Sách Nhân Viên</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="donhang.php">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Danh Sách Đơn Hàng</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="khachhang.php">
                    <i class="fas fa-users"></i>
                    <span>Danh Sách Khách Hàng</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu"
                    aria-expanded="true" aria-controls="collapseMenu">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Danh Sách Menu</span>
                </a>
                <div id="collapseMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="quan_ly_menu.php">Quản Lý Menu</a>
                        <!-- <a class="collapse-item" href="sanpham.php">Sản Phẩm List</a> -->
                        <!-- <a class="collapse-item" href="them_menu.php">Thêm Menu</a> -->
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlog"
                    aria-expanded="true" aria-controls="collapseBlog">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Danh Sách Blog</span>
                </a>
                <div id="collapseBlog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="danh_sach_bai_viet.php">Danh sách bài viết</a>
                   </div>
                </div>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.php">Buttons</a>
                        <a class="collapse-item" href="cards.php">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.php">Colors</a>
                        <a class="collapse-item" href="utilities-border.php">Borders</a>
                        <a class="collapse-item" href="utilities-animation.php">Animations</a>
                        <a class="collapse-item" href="utilities-other.php">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.php">Register</a>
                        <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.php">404 Page</a>
                        <a class="collapse-item" href="blank.php">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            
                            <!--Thông báo đơn hàng-->
                        <?php
                        // Kết nối cơ sở dữ liệu
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "quantriweb"; // Thay bằng tên cơ sở dữ liệu của bạn

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Kiểm tra kết nối
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Lấy danh sách đơn hàng chưa xử lý
                        $sql = "SELECT orders.id, orders.product_id, orders.quantity, orders.total_price, orders.customer_name, orders.created_at, products.name AS product_name
                                FROM orders
                                LEFT JOIN products ON orders.product_id = products.id
                                WHERE orders.status = 'Chưa xử lý' ORDER BY orders.created_at DESC LIMIT 10"; // Lấy 10 đơn hàng mới nhất
                        $result = $conn->query($sql);

                        // Tạo mảng chứa thông báo
                        $notifications = [];

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Thêm thông báo vào mảng
                                $notifications[] = [
                                    'id' => $row['id'],
                                    'product_name' => $row['product_name'],
                                    'customer_name' => $row['customer_name'],
                                    'created_at' => $row['created_at'],
                                ];
                            }
                        } else {
                            $notifications[] = "No new orders"; // Nếu không có đơn hàng mới
                        }

                        $conn->close();
                        ?>

                        <!-- HTML phần dropdown thông báo -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo count($notifications); ?>+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php if (count($notifications) > 0) { ?>
                                    <!-- Lặp qua các thông báo đơn hàng -->
                                    <?php foreach ($notifications as $notification) { ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-shopping-bag text-white"></i> <!-- Sử dụng biểu tượng cho đơn hàng -->
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?php echo $notification['created_at']; ?></div>
                                                <span class="font-weight-bold">Đơn hàng mới từ khách hàng <?php echo $notification['customer_name']; ?> - Sản phẩm: <?php echo $notification['product_name']; ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Không có đơn hàng mới</a>
                                <?php } ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Hiển thị tên người dùng từ session -->
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                                            <!-- Tổng sản phẩm -->

                    <?php
                    // Kết nối với cơ sở dữ liệu
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "quantriweb";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Kiểm tra kết nối
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    // Truy vấn tổng số sản phẩm
                    $sql = "SELECT COUNT(*) AS total_products FROM products";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $total_products = $row['total_products'];

                    // Đóng kết nối
                    $conn->close();
                    ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Tổng sản phẩm
                                        </div>
                                        <!-- Hiển thị tổng số sản phẩm -->
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $total_products; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cube fa-2x text-gray-300"></i> <!-- Icon có thể thay đổi nếu cần -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doanh thu -->

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

                    // Truy vấn tổng doanh thu từ bảng orders
                    $sql = "SELECT SUM(total_price) AS total_revenue FROM orders";
                    $result = $conn->query($sql);

                    $total_revenue = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $total_revenue = $row['total_revenue'];
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Doanh thu</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo number_format($total_revenue, 0, ',', '.'); ?> VNĐ
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thống kê -->

                    </div>


                        <!-- Tổng số lượng nhân viên -->


                        <?php
                        // Kết nối với cơ sở dữ liệu
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "quantriweb";
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Kiểm tra kết nối
                        if ($conn->connect_error) {
                            die("Kết nối thất bại: " . $conn->connect_error);
                        }

                        // Truy vấn số lượng nhân viên có role = 'user' và không lấy admin
                        $sql = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'user'"; // Lọc chỉ lấy user
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $total_users = $row['total_users'];

                        // Đóng kết nối
                        $conn->close();
                        ?>
                        <!-- Số lượng nhân viên Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Số lượng nhân viên</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <!-- Hiển thị số lượng nhân viên -->
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <!-- Tiến độ giả lập ở đây, có thể thay đổi width hoặc giá trị theo yêu cầu -->
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo ($total_users > 0) ? ($total_users / 100) * 100 : 0; ?>%" 
                                                            aria-valuenow="<?php echo ($total_users > 0) ? ($total_users / 100) * 100 : 0; ?>"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Icon có thể thay đổi theo nhu cầu -->
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
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

                        // Truy vấn số lượng đơn hàng từ bảng orders
                        $sql = "SELECT COUNT(*) AS total_orders FROM orders";
                        $result = $conn->query($sql);

                        $total_orders = 0;
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_orders = $row['total_orders'];
                        }

                        // Đóng kết nối
                        $conn->close();
                        ?>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Số lượng đơn hàng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total_orders; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                   <!-- Trung tâm -->

                   <?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quantriweb"; // Thay bằng tên CSDL của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xóa sản phẩm
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Xóa sản phẩm thành công!');</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Sửa sản phẩm
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $original_price = $_POST['original_price'];
    $current_price = $_POST['current_price'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if (!empty($image)) {
        // Tải lên ảnh mới
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        // Cập nhật cơ sở dữ liệu với ảnh mới
        $sql = "UPDATE products SET 
                name='$name', 
                original_price='$original_price', 
                current_price='$current_price', 
                image='uploads/$image' -- Chỉ lưu tên tệp
                WHERE id=$id";
    } else {
        // Không thay đổi ảnh
        $sql = "UPDATE products SET 
                name='$name', 
                original_price='$original_price', 
                current_price='$current_price'
                WHERE id=$id";
    }

    if ($conn->query($sql)) {
        echo "<script>alert('Cập nhật sản phẩm thành công!');</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}



// Lấy danh sách sản phẩm
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <style>@media (min-width: 1200px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl {
        max-width: 100%;
    }
}</style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Quản lý sản phẩm</h1>

    <!-- Nút thêm sản phẩm -->
    <div class="text-right mb-3">
        <a href="add_sanpham.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <!-- Hiển thị danh sách sản phẩm -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá hiện tại</th>
                <th>Hình ảnh</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST" enctype="multipart/form-data">
                        <td><?php echo $row['id']; ?></td>
                        <td><input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control"></td>
                        <td><input type="number" name="original_price" value="<?php echo $row['original_price']; ?>" class="form-control"></td>
                        <td><input type="number" name="current_price" value="<?php echo $row['current_price']; ?>" class="form-control"></td>
                        <td class="d-flex align-items-center justify-content-center">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 50px; height: 50px; margin-right: 10px;" />
                        <input type="file" name="image" class="form-control-file">
                        </td>
                        <td>
                            <!-- Nút sửa và xóa nằm ngang -->
                            <div class="btn-group" role="group">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="edit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </button>
                                <a href="edit_sanpham.php?delete=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </div>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>


                    
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng để đi chưa?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên làm việc hiện tại.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                    <a class="btn btn-primary" href="login.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>