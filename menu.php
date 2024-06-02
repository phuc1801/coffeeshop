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
                <form onsubmit="event.preventDefault();" role="search">
                    <label for="search">Search for stuff</label>
                    <input id="search" type="search" placeholder="Search..." autofocus required />
                    <button type="submit" class="btn-go">Go</button>    
                </form>
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
                            <a href="#!">Pricing</a>
                        </li>
                        <li>
                            <a href="#blog">Blog</a>
                        </li>
                    </ul>
                </nav>
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
                    <button class="control-btn" id="left">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button class="control-btn" id="right">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
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
                                    <?php echo htmlspecialchars($product['baohanh']); ?>
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
                            <span class="price">$<?php echo htmlspecialchars($product['gia']); ?></span>
                            <button class="btn book-btn">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>
</html>
