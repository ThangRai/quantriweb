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
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
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

    // Lấy thông tin bài viết từ cơ sở dữ liệu
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
}

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    
    // Xử lý hình ảnh tải lên
    $image_url = $post['image_url'];  // Giữ ảnh cũ nếu không tải ảnh mới
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['image_url']['name']);
        
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $upload_file)) {
            $image_url = $upload_file;
        } else {
            echo "Lỗi tải ảnh lên.";
        }
    }

    // Thực hiện câu lệnh SQL để cập nhật bài viết
    $sql = "UPDATE posts SET title = ?, author = ?, content = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $author, $content, $image_url, $post_id);

    if ($stmt->execute()) {
        echo "Bài viết đã được cập nhật thành công.";
        header("Location: index.php"); // Điều hướng lại về trang danh sách
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Bài Viết</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <style>

        h1 {
            font-size: 2.5rem;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        textarea.form-control {
            resize: vertical;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            font-size: 1.2rem;
            border-radius: 8px;
            padding: 10px 20px;
            width: 100%;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .form-group img {
            border-radius: 8px;
            margin-top: 10px;
            width: 100%;
            max-width: 300px;
            height: auto;
            display: block;
            margin: 10px auto;
        }

        .upload-section {
            margin-top: 20px;
        }

        .upload-section input[type="file"] {
            padding: 5px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
            width: 100%;
        }

        .upload-section label {
            font-weight: 500;
            color: #007bff;
            cursor: pointer;
        }

        .upload-section label:hover {
            text-decoration: underline;
        }

        .form-group .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

    </style>
</head>
<body>

<div class="containereditpost">
    <h1>Sửa Bài Viết</h1>

    <!-- Form sửa bài viết -->
    <form method="POST" action="edit-post.php?id=<?php echo $post['id']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="author">Tác giả</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $post['author']; ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $post['content']; ?></textarea>
        </div>
        
        <!-- Phần tải ảnh lên -->
        <div class="upload-section form-group">
            <label for="image_url">Đường dẫn hình ảnh (Tải lên ảnh mới nếu muốn thay thế)</label>
            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
            <?php if ($post['image_url']): ?>
                <div class="mt-3">
                    <img src="<?php echo $post['image_url']; ?>" alt="Image" class="img-thumbnail" style="width: 200px;">
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật bài viết</button>
    </form>
</div>

</body>
</html>

<?php
// Đóng kết nối
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