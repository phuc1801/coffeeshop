<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['type'] != 0) {
    header('Location: login.php');
    exit();
}
include "connect.php";

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    die('Bạn chưa đăng nhập.');
}

$username = $_SESSION['username'];

// Truy vấn thông tin người dùng từ bảng `account`
$sql = "SELECT username FROM account WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('Không tìm thấy người dùng.');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Coffee Shop</title>
        <!-- Reset CSS -->
        <link rel="stylesheet" href="./assets/css/reset.css" />

        <!-- Embed fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Sen:wght@700&display=swap"
            rel="stylesheet"
        />

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


     
        <!-- Styles -->
        <link rel="stylesheet" href="./assets/css/styles.css" />   
        <link rel="stylesheet" href="./assets/css/login.css">
        <link rel="stylesheet" href="assets/css/profile.css?v=<?php echo time();?>">

        <!-- js -->
        <script src="./assets/js/slider.js" defer></script>
        <script src="./assets/js/blogslider.js" defer></script>
        <script src="./assets/js/login.js" defer></script>
        <script src="assets/js/profile.js" defer></script>
       
    </head>
    <body>
        <!-- Header -->
        <header class="header fixed">
            <div class="main-content">
                <div class="body">
                    <!-- Logo -->
                    <img
                        src="./assets/img/logo.svg"
                        alt="Lesson."
                        class="logo"
                    />

                    <!-- Nav -->
                    <nav class="nav">
                        <ul>
                            <li class="active">
                                <a href="#home">Home</a>
                            </li>
                            <li>
                                <a href="menu.php">Menu</a>
                            </li>
                            <li>
                                <a href="#product">Product</a>
                            </li>
                            <li>
                                <a href="#blog">Blog</a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Action -->
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
                            <i class="fa-regular fa-envelope"></i>
                            Inbox
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="#">
                            <i class="fa-solid fa-chart-line"></i>
                            Analytics
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                            <a href="#">
                            <i class="fa-solid fa-sliders"></i>
                            Settings
                            </a>
                        </li>

                        <li class="profile-dropdown-list-item">
                           
                                <a href="cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>
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

       
        

        <main id="home">
            <!-- Hero -->
            <div class="hero">
                <div class="main-content">
                    <div class="body">
                        <!-- Hero left -->
                        <div class="media-block">
                            <img
                                src="./assets/img/Reserve Img.svg"
                                alt="Learn without limits and spread knowledge."
                                class="img"
                            />                           
                        </div>

                        <!-- Hero right -->
                        <div class="content-block">
                            <h1 class="heading lv1">
                                Cà Phê Đâu Chỉ Là Thức Uống
                            </h1>
                            <p class="desc">
                                Cà phê hay cuộc đời đều mang vị đắng chát khó quên nhưng ẩn sâu bên trong đó luôn phảng phất hương thơm và vị ngọt.
                            </p>
                            <div class="cta-group">
                                <a href="#!" class="btn hero-cta"
                                    >Xem Sản Phẩm</a
                                >
                                <button class="watch-video">
                                    <div class="icon">
                                        <img
                                            src="./assets/icons/play.svg"
                                            alt=""
                                        />
                                    </div>
                                    <span>Video Giới Thiệu</span>
                                </button>
                            </div>
                            <p class="desc">Tương tác gần đây</p>
                            <p class="desc stats">
                                <strong>50K</strong> Người mua
                                <strong>3000+</strong> Đánh giá
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular -->
            <div class="popular" id="product">
                <div class="main-content">
                    <div class="popular-top">
                        <div class="info">
                            <h2 class="heading lv2">Cà Phê Highlight</h2>
                            <p class="desc">
                                Cà phê đặc sản thức uống đa bản sắc
                            </p>
                        </div>
                        <div class="controls">
                            <button class="control-btn" id="left">
                                <svg
                                    width="8"
                                    height="14"
                                    viewBox="0 0 8 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M7 1L1 7L7 13"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                            <button class="control-btn" id="right">
                                <svg
                                    width="8"
                                    height="14"
                                    viewBox="0 0 8 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M1 1L7 7L1 13"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="course-list">
                        <!-- Course item 1 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/latenong.jpg"
                                    alt="Basic web design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Latte Nóng
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Course item 2 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/caramen.jpg"
                                    alt="UI/UX design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Caramel Macchiato Nóng
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Course item 3 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/caramel-macchiato.jpg"
                                    alt="Web App design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                           Latte Đá
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Course item 4 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/chocolatenong.jpg"
                                    alt="Basic web design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Chocolate Nóng
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Course item 5 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/bacsiu.jpg"
                                    alt="Basic web design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Bạc Sỉu
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Course item 5 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/bacsiu.jpg"
                                    alt="Basic web design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Bạc Sỉu
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Course item 6 -->
                        <div class="course-item">
                            <a href="#!">
                                <img
                                    src="./assets/img/bacsiu.jpg"
                                    alt="Basic web design"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <div class="head">
                                    <h3 class="title">
                                        <a
                                            href="#!"
                                            class="line-clamp break-all"
                                        >
                                            Bạc Sỉu
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        <img
                                            src="./assets/icons/star.svg"
                                            alt="Star"
                                            class="star"
                                        />
                                        <span class="value">4.5</span>
                                    </div>
                                </div>
                                <p class="desc line-clamp line-2 break-all">
                                    Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà.
                                </p>
                                <div class="foot">
                                    <span class="price">$120.75</span>
                                    <button class="btn book-btn">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback -->
            <div class="feedback">
                <div class="main-content">
                    <div class="feedback-list">
                        <!-- Feedback item 1 -->
                        <div class="feedback-item">
                            <div class="info">
                                <img
                                    src="./assets/img/logo.svg"
                                    alt="Peter Moor"
                                    class="avatar"
                                />
                                <p class="title">Coffee House</p>
                                <p class="desc">Cà phê đặc sản</p>
                                <div class="dots">
                                    <span class="dot active"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                            <div class="content">
                                <img
                                    src="./assets/icons/open-quotes.svg"
                                    alt=""
                                    class="open-quotes"
                                />
                                <blockquote>
                                    Dưới ánh nắng sớm mai, hương thơm của ca phê lan tỏa, như là một giai điệu êm đềm, mời gọi ta bước vào thế giới của những suy tư sâu lắng và những cuộc trò chuyện bất tận.
                                </blockquote>
                            </div>
                        </div>

                        <!-- Feedback item 2 -->
                        <div class="feedback-item">
                            <div class="info">
                                <img
                                    src="./assets/img/feedback-avatar-2.jpg"
                                    alt="Peter Moor"
                                    class="avatar"
                                />
                                <p class="title">Peter Moor</p>
                                <p class="desc">Student of Web Design</p>
                                <div class="dots">
                                    <span class="dot"></span>
                                    <span class="dot active"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                            <div class="content">
                                <img
                                    src="./assets/icons/open-quotes.svg"
                                    alt=""
                                    class="open-quotes"
                                />
                                <blockquote>
                                    Not only does my resume look
                                    impressive—filled with the names and logos
                                    of world-class institutions—but these
                                    certificates also bring me closer to my
                                    career goals by validating the skills I've
                                    learned."
                                </blockquote>
                            </div>
                        </div>

                        <!-- Feedback item 3 -->
                        <div class="feedback-item">
                            <div class="info">
                                <img
                                    src="./assets/img/feedback-avatar-3.jpg"
                                    alt="Peter Moor"
                                    class="avatar"
                                />
                                <p class="title">Peter Moor</p>
                                <p class="desc">Student of Web Design</p>
                                <div class="dots">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot active"></span>
                                </div>
                            </div>
                            <div class="content">
                                <img
                                    src="./assets/icons/open-quotes.svg"
                                    alt=""
                                    class="open-quotes"
                                />
                                <blockquote>
                                    Not only does my resume look
                                    impressive—filled with the names and logos
                                    of world-class institutions—but these
                                    certificates also bring me closer to my
                                    career goals by validating the skills I've
                                    learned."
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features 1 -->
            <div class="features">
                <div class="main-content">
                    <div class="body">
                        <div class="images">
                            <img
                                class="lower"
                                src="./assets/img/hopcoffee.jpg"
                                alt="Learner outcomes through our awesome platform"
                            />
                            <img
                                src="./assets/img/longcoffee.jpg"
                                alt="Learner outcomes through our awesome platform"
                            />
                        </div>
                        <div class="content">
                            <h2 class="heading lv2">
                                Cà Phê Sữa Đá Hoà Tan
                            </h2>
                            <p class="desc">
                                Thật dễ dàng để bắt đầu ngày mới với tách cà phê sữa đá sóng sánh, thơm ngon như cà phê pha phin. 
                                Vị đắng thanh của cà phê hoà quyện với vị ngọt béo của sữa, giúp bạn luôn tỉnh táo và hứng khởi cho ngày làm việc thật hiệu quả.
                            </p>
                            <p class="desc">Coming Soon</p>
                            <a href="#!" class="btn cta-btn">Đăng kí trước</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features 2 -->
            <div class="features features-2nd">
                <div class="main-content">
                    <div class="body">
                        <div class="images">
                            <img
                                src="./assets/img/bottlecfsd.jpg"
                                alt="Take the next step toward your personal and professional goals with Lesson."
                            />
                        </div>
                        <div class="content">
                            <h2 class="heading lv2">
                                Chai Fresh
                            </h2>
                            <p class="desc">
                                Thức uống "đánh thức" năng lượng ngày mới hợp cho những ai mới bước vào thế giới cà phê hoặc ghiền cà phê nhưng muốn khám phá thêm nhiều hương vị mới.
                                Tiết kiệm hơn phù hợp với bình thường mới, giúp bạn tận hưởng một ngày dài trọn vẹn
                                Sản phẩm dùng ngon nhất trong ngày. Sản phẩm mặc định mức đường và không đá.
                            </p>
                            <a href="#!" class="btn cta-btn">Đăng kí trước</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog -->
            <div class="blog" id="blog">
                <div class="main-content">
                    <div class="blog-top">
                        <h2 class="heading lv2">Blog Của Chúng Tôi</h2>
                        <p class="desc">
                            Đây là một blog rất hay với hình ảnh rất chuyên nghiệp về cà phê 
                        </p>
                    </div>
                    <div class="blog-list">
                        <!-- Blog item 1 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/dami4.jpeg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 May 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        Đây là một blog rất hay với hình ảnh rất chuyên nghiệp về cà phê 
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 2 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/dami4.jpeg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 May 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        Đây là một blog rất hay với hình ảnh rất chuyên nghiệp về cà phê 
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 3 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/dami4.jpeg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 May 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        Đây là một blog rất hay với hình ảnh rất chuyên nghiệp về cà phê 
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>
                        <!-- Blog item 4 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-1.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 5 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-2.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 6 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-3.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>
                        <!-- Blog item 7 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-1.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 8 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-2.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>

                        <!-- Blog item 9 -->
                        <div class="item">
                            <a href="#!">
                                <img
                                    src="./assets/img/blog-3.jpg"
                                    alt="How to become a pro web designer in 2022 and
                                get remot job?"
                                    class="thumb"
                                />
                            </a>
                            <div class="info">
                                <span class="date">5 may 2024</span>
                                <h3 class="title">
                                    <a href="#!">
                                        How to become a pro web designer in 2022
                                        and get remot job?
                                    </a>
                                </h3>
                                <a href="#!" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="dots">
                        <span class="dot"></span>
                        <span class="dot active"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="main-content">
                <div class="row">
                    <!-- Column 1 -->
                    <div class="column">
                        <img
                            src="./assets/img/logo.svg"
                            alt="Lesson."
                            class="logo"
                        />
                        <p class="desc">
                            Cà phê hay cuộc đời đều mang vị đắng chát khó quên nhưng ẩn sâu bên trong đó luôn phảng phất hương thơm và vị ngọt.
                        </p>
                        <div class="socials">
                            <a href="#!">
                                <img
                                    src="./assets/icons/twitter.svg"
                                    alt="Twitter"
                                    class="icon"
                                />
                            </a>
                            <a href="#!">
                                <img
                                    src="./assets/icons/facebook.svg"
                                    alt="Facebook"
                                    class="icon"
                                />
                            </a>
                            <a href="#!">
                                <img
                                    src="./assets/icons/linkedin.svg"
                                    alt="Linkedin"
                                    class="icon"
                                />
                            </a>
                            <a href="#!">
                                <img
                                    src="./assets/icons/instagram.svg"
                                    alt="Instagram"
                                    class="icon"
                                />
                            </a>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="column">
                        <h3 class="title">Company</h3>
                        <ul class="list">
                            <li>
                                <a href="#!">About Us</a>
                            </li>
                            <li>
                                <a href="#!">Features</a>
                            </li>
                            <li>
                                <a href="#!">Our Pricing</a>
                            </li>
                            <li>
                                <a href="#!">Latest News</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 3 -->
                    <div class="column">
                        <h3 class="title">Support</h3>
                        <ul class="list">
                            <li>
                                <a href="#!">FAQ’s</a>
                            </li>
                            <li>
                                <a href="#!">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="#!">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#!">Contact Us</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Column 4 -->
                    <div class="column">
                        <h3 class="title">Address</h3>
                        <ul class="list">
                            <li>
                                <a href="#!">
                                    <strong>Location:</strong> Hải Phòng
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <strong>Email:</strong> email@gmail.com
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <strong>Phone:</strong> + 000 1234 567 890
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="copyright">
                    <p>Source Code: github.com/phuc1801</p>
                </div>
            </div>
        </footer>
    </body>
</html>