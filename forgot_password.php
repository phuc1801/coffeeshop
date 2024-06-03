<?php 
    include "connect.php";
    $loi = "";

    if(isset($_POST['send'])){
        $email = $_POST['email'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM account WHERE email = ?";
        $stmt = $conn->prepare($sql); 
        $stmt->bindParam(1, $email);
        $stmt->execute();
        
        // Đếm số hàng tìm được
        $count = $stmt->rowCount();
        if($count == 0){
            $loi = "Email của bạn chưa đăng ký thành viên";
        } else {
            // Tạo một token reset mật khẩu ngẫu nhiên với độ dài 6 ký tự
            $token = substr(md5(rand(0, 999999)), 0, 6);  

            // Cập nhật mật khẩu mới trong cơ sở dữ liệu
            $sql = "UPDATE account SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$token, $email]);

            // Gửi email reset mật khẩu
            sendMail($email, $token);

            // Hiển thị thông báo mật khẩu mới đã được cập nhật
            $loi = "Mật khẩu mới của bạn đã được gửi tới email của bạn";
        }
    }

    function sendMail($email, $token){
        require "../PHPMailer-master/src/PHPMailer.php"; 
        require "../PHPMailer-master/src/SMTP.php"; 
        require '../PHPMailer-master/src/Exception.php'; 
        $mail = new PHPMailer\PHPMailer\PHPMailer(true); // true: enables exceptions
        try {
            $mail->SMTPDebug = 0; // 0, 1, 2: chế độ debug
            $mail->isSMTP();  
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  // SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $mail->Username = 'phucnd.wordpress@gmail.com'; // SMTP username
            $mail->Password = 'wkvj dvfr xxjf otgj';   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom('phucnd.wordpress@gmail.com', 'Nguyen Duy Phuc'); 
            $mail->addAddress($email); 
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Reset Password';
            $noidungthu = "Mật khẩu mới của bạn là: {$token}"; 
            $mail->Body = $noidungthu;
            $mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
        } catch (Exception $e) {
            echo 'Error: ', $mail->ErrorInfo;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Forgot Password</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="./assets/img/the-coffee-house.jpeg" alt="Welcome back you've been missed!">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="#!">
                                                            <img src="./assets/img/logo.svg" alt="BootstrapBrain Logo" width="175" height="57">
                                                        </a>
                                                    </div>
                                                    <h2 class="h4 text-center">Password Reset</h2>
                                                    <h3 class="fs-6 fw-normal text-secondary text-center m-0">Provide the email address associated with your account to recover your password.</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="" method="post">
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-dark btn-lg" type="submit" name="send">Reset Password</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <a href="login.php" class="link-secondary text-decoration-none">Login</a>
                                                    <a href="login.php" class="link-secondary text-decoration-none">Register</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($loi != ""): ?>
                                        <div class="alert <?php echo ($count == 0) ? 'alert-danger' : 'alert-success'; ?> mt-4">
                                            <?php echo $loi; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
