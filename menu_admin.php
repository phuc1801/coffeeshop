<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 1) {
    header('Location: login.php');
    exit();
}

include "connect.php";

$sql = "SELECT * FROM product";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
session_start();
include "connect.php";

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    die('Bạn chưa đăng nhập.');
}

$username = $_SESSION['username'];

// Truy vấn thông tin người dùng từ bảng `account`
$sql1 = "SELECT username FROM account WHERE username = ?";
$stmt = $conn->prepare($sql1);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Không tìm thấy người dùng.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Embed fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Sen:wght@700&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="./assets/css/reset.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./assets/css/search.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./assets/css/menu.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time();?>">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="assets/js/profile.js" defer></script>

    <title>Document</title>
</head>
<body>
    <!-- Header -->
    <header class="header fixed">
        <div class="main-content">
            <div class="body">
                <!-- Logo -->
                <a href="index.php"> <img src="./assets/img/logo.svg" alt="Lesson." class="logo"></a>
                <!-- search -->
               
                <!-- Nav -->
                <nav class="nav">
                    <ul>
                        <li class="active">
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="#!">Menu</a>
                        </li>
                        
                        <li>
                            <a href="blog.php">Blog</a>
                        </li>
                    </ul>
                </nav>
                <div class="profile-dropdown">
                        <div onclick="toggle()" class="profile-dropdown-btn">
                        <div class="profile-img">
                            <i class="fa-solid fa-circle"></i>
                        </div>

                        <span
                            ><?php echo htmlspecialchars($user['username']); ?>
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                        </div>

                        <ul class="profile-dropdown-list">
                        <li class="profile-dropdown-list-item">
                            <a href="edit_profile.php">
                            <i class="fa-regular fa-user"></i>
                            Edit Profile
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="#">
                            <i class="fa-solid fa-wrench"></i>
                            Chỉnh sửa nội dung
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="analytics.php">
                            <i class="fa-solid fa-chart-line"></i>
                            Analytics
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="account_management.php">
                            <i class="fa-solid fa-sliders"></i>
                            Quản lý tài khoản
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="pending_orders.php">
                            <i class="fa-regular fa-circle-question"></i>
                            Duyệt đơn hàng
                            </a>
                        </li>
                        <hr />

                        <li class="profile-dropdown-list-item">
                            <a href="logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Log out
                            </a>
                        </li>
                        </ul>
                    </div>
            </div>
        </div>
    </header>
    <!-- Popular -->
    <div class="popular" id="product">
        <div class="main-content">
            <div class="popular-top">
                <div class="info">
                    <h2 class="heading lv2">Menu Cà Phê</h2>
                    <p class="desc">
                        Cà phê đặc sản thức uống đa bản sắc
                    </p>
                </div>
                <div class="controls">
                    <a href="add_product.php">
                        <button class="btn book-btn">
                            Thêm
                        </button>
                    </a>
                </div>
                
            </div>
            
            <div class="course-list1">
                <?php foreach ($products as $product): ?>
                <div class="course-item">
                    <a href="#!">
                        <img src="./assets/img/<?php echo htmlspecialchars($product['anh']); ?>" alt="<?php echo htmlspecialchars($product['ten']); ?>" class="thumb">
                    </a>
                    <div class="info">
                        <div class="head">
                            <h3 class="title">
                                <a href="#!" class="line-clamp break-all">
                                    <?php echo htmlspecialchars($product['ten']); ?>
                                </a>
                            </h3>
                            <div class="rating">
                                <img src="./assets/icons/star.svg" alt="Star" class="star">
                                <span class="value">
                                    4.5
                                </span>
                            </div>
                        </div>
                        <p class="desc line-clamp line-2 break-all">
                            <?php echo htmlspecialchars($product['baohanh']); ?>
                        </p>
                        <p class="p-list">
                            <?php echo htmlspecialchars($product['trangthai']); ?>
                        </p>
                        <div class="foot">
                            <span class="price"><?php echo htmlspecialchars($product['gia']); ?> VND</span>
                            <div class="btn-cbt">
                                <a href="edit.php?id=<?php echo $product['id']; ?>">
                                     <button class="btn-minwidth book-btn">
                                         Sửa
                                    </button>
                                </a>

                                <a href="delete.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                    <button class="btn-minwidth book-btn">
                                        Xoá
                                    </button>
                                </a>
                          
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>
</html>
