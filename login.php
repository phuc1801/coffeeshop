<?php
session_start();
include"connect.php";
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT username, password, type FROM account WHERE username = '$username'";
    $stmt = $conn->prepare($sql);
    $query = $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $userreal = $result['username'];
        $passreal = $result['password'];
        $type = $result['type'];
        if ($username == $userreal && $password == $passreal) {
            if($type == 1){
                $_SESSION['username'] = $username;
                $_SESSION['type'] = $type;
                header('Location: index.php');
                exit;
            }else{
                $_SESSION['username'] = $username;
                $_SESSION['type'] = $type;
                header('Location: user.php');
                exit;
            }
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
        }
    }else{
        $error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
    }
}
?>


<!-- dang ki -->
<?php 
    include "connect.php";
    $loi = "";

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        
        // Kiểm tra xem username đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check_username = "SELECT * FROM account WHERE username = ?";
        $stmt_check_username = $conn->prepare($sql_check_username); 
        $stmt_check_username->bindParam(1, $username);
        $stmt_check_username->execute();
        
        // Đếm số hàng tìm được
        $count_username = $stmt_check_username->rowCount();

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check_email = "SELECT * FROM account WHERE email = ?";
        $stmt_check_email = $conn->prepare($sql_check_email); 
        $stmt_check_email->bindParam(1, $email);
        $stmt_check_email->execute();
        
        // Đếm số hàng tìm được
        $count_email = $stmt_check_email->rowCount();

        if($count_username > 0){
            $loi = "Username đã được sử dụng, vui lòng chọn username khác.";
        } elseif ($count_email > 0) {
            $loi = "Email đã được sử dụng, vui lòng sử dụng email khác.";
        } else {
            // Thêm tài khoản mới vào cơ sở dữ liệu
            $sql_insert = "INSERT INTO account (username, password, email) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->execute([$username, $password, $email]);

            // Hiển thị thông báo đăng ký thành công
            $loi = "Đăng ký thành công!";
        }
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
        <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time();?>" />   
        <link rel="stylesheet" href="./assets/css/login.css?v=<?php echo time();?>">
        <!-- js -->
        <script src="./assets/js/login.js" defer></script>
       
    </head>
    <body>
 <!-- Header -->
 <header class="btn sign-up-btn">
   
</header>

<!-- Login -->
<div class="blur-bg-overlay">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="post">
                
                <img src="./assets/img/logo.svg" alt="logo">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="text" placeholder="Username" name="username" required>
                <input type="password" placeholder="Password"  name="password" required>
                <Button name="register">Sign up</Button>
                <button class="close-btnX1" style="display: none">Close</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="login.php">
               
                <img src="./assets/img/logo.svg" alt="logo">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="username" placeholder="Username" name="username" required="">
                <input type="password" placeholder="Password" name="password" required="">
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
                <button class="close-btnX2" style="display: none">Close</button>
                
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
               
                
                <div class="toggle-panel toggle-left">                          
                    <h1>Welcome Back!</h1>
                    <p>Nhập thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">                            
                    <h1>Hello, Friend!</h1>
                    <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>






       

       
    </body>
</html>
