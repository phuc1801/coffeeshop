<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 0) {
    header('Location: login.php');
    exit();
}

include "connect.php";

// Check if there's a search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM product";
if ($search) {
    $sql .= " WHERE ten LIKE :search";
}

$stmt = $conn->prepare($sql);

if ($search) {
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
}

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
                <img src="./assets/img/logo.svg" alt="Lesson." class="logo">
                <!-- search -->
                <form action="menu.php" method="GET" role="search" class="menu-form">
                    <label for="search">Search for stuff</label>
                    <input id="search" type="search" name="search" placeholder="Search..." autofocus required />
                    <button type="submit" class="btn-go">Go</button>
                </form>
                <!-- Nav -->
                <nav class="nav">
                    <ul>
                        <li class="active">
                            <a href="user.php">Home</a>
                        </li>
                        <li>
                            <a href="menu.php">Menu</a>
                        </li>
                        
                        <li>
                            <a href="blog2.php">Blog</a>
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
                            <a href="cart.php">
                            <i class="fa-regular fa-circle-question"></i>
                            Giỏ hàng
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
                            <span class="price"><?php echo htmlspecialchars($product['gia']); ?> VNĐ</span>
                            <form action="add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                <button class="btn book-btn" type="submit">
                                    Book Now
                                </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
