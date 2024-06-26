<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";

// Kiểm tra xem username có tồn tại trong session hay không
if (!isset($_SESSION['username'])) {
    die('Username not found in session.');
}

$username = $_SESSION['username'];

// Truy vấn thông tin người dùng từ bảng `account`
$sql = "SELECT username, password, email, type FROM account WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found in database.');
}

// Truy vấn thông tin chi tiết mạng xã hội từ bảng `social_media`
$sql = "SELECT facebook, twitter, instagram, pinterest FROM social_media WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$social_media = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$social_media) {
    // Nếu không tìm thấy thông tin mạng xã hội, khởi tạo mảng rỗng
    $social_media = [
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'pinterest' => '',
    ];
}

// Xử lý thay đổi mật khẩu
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Kiểm tra mật khẩu hiện tại
        if ($current_password !== $user['password']) {
            $message = 'Current password is incorrect.';
        } elseif ($new_password !== $confirm_password) {
            $message = 'New passwords do not match.';
        } else {
            // Cập nhật mật khẩu mới
            $sql = "UPDATE account SET password = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$new_password, $username])) {
                $message = 'Password changed successfully.';
            } else {
                $message = 'Failed to change password.';
            }
        }
    }

    // Xử lý cập nhật thông tin mạng xã hội
    if (isset($_POST['facebook'], $_POST['twitter'], $_POST['instagram'], $_POST['pinterest'])) {
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $pinterest = $_POST['pinterest'];

        // Kiểm tra xem đã tồn tại thông tin mạng xã hội cho người dùng này chưa
        $sql = "SELECT COUNT(*) FROM social_media WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            // Chèn thông tin mới
            $sql = "INSERT INTO social_media (username, facebook, twitter, instagram, pinterest) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $facebook, $twitter, $instagram, $pinterest]);
        } else {
            // Cập nhật thông tin hiện có
            $sql = "UPDATE social_media SET facebook = ?, twitter = ?, instagram = ?, pinterest = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$facebook, $twitter, $instagram, $pinterest, $username]);
        }
        $message = 'Social media details updated successfully.';
    }
}
?>

<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Truy vấn để lấy giá trị 'type' của người dùng hiện tại
$sql3 = "SELECT type FROM account WHERE username = :username_id";
$stmt = $conn->prepare($sql3);
$stmt->bindParam(':username_id', $username_id); // Thay user_id bằng biến chứa ID của người dùng hiện tại
$stmt->execute();
$phanloai = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra giá trị của 'type' và định tuyến người dùng đến trang tương ứng
if ($phanloai['type'] == 1) {
    $redirect_url = "index.php";
} else {
    $redirect_url = "user.php";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/edit_profile.css?v=<?php echo time();?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-12">
        <!-- Page title -->
        <div class="my-5">
            <h3>My Profile</h3>
            <hr>
        </div>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <!-- Form START -->
        <form method="post">
            <div class="row mb-5 gx-5">
                <!-- Contact detail -->
                <div class="col-xxl-8 mb-5 mb-xxl-0">
                    <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                            <h4 class="mb-4 mt-0">Contact detail</h4>
                            <!-- Username -->
                            <div class="col-md-6">
                                <label class="form-label">Username *</label>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                            </div>
                            <!-- Password -->
                            <div class="col-md-6">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                            </div>
                            <!-- Account Type -->
                            <div class="col-md-6">
                                <label class="form-label">Loại tài khoản *</label>
                                <input type="text" class="form-control" name="type" value="<?php echo htmlspecialchars($user['type']); ?>">
                            </div>
                        </div> <!-- Row END -->
                    </div>
                </div>
                <!-- Upload profile -->
                <div class="col-xxl-4">
                    <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                            <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                            <div class="text-center">
                                <!-- Image upload -->
                                <div class="square position-relative display-2 mb-3">
                                    <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                </div>
                                <!-- Button -->
                                <input type="file" id="customFile" name="file" hidden="">
                                <label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
                                <button type="button" class="btn btn-danger-soft">Remove</button>
                                <!-- Content -->
                                <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row END -->

            <!-- Social media detail -->
            <div class="row mb-5 gx-5">
                <div class="col-xxl-6 mb-5 mb-xxl-0">
                    <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                            <h4 class="mb-4 mt-0">Social media detail</h4>
                            <!-- Facebook -->
                            <div class="col-md-6">
                                <label class="form-label"><i class="fab fa-fw fa-facebook me-2 text-facebook"></i>Facebook *</label>
                                <input type="text" class="form-control" name="facebook" placeholder="" aria-label="Facebook" value="<?php echo htmlspecialchars($social_media['facebook']); ?>">
                            </div>
                            <!-- Twitter -->
                            <div class="col-md-6">
                                <label class="form-label"><i class="fab fa-fw fa-twitter text-twitter me-2"></i>Twitter *</label>
                                <input type="text" class="form-control" name="twitter" placeholder="" aria-label="Twitter" value="<?php echo htmlspecialchars($social_media['twitter']); ?>">
                            </div>
                            
                            <!-- Instagram -->
                            <div class="col-md-6">
                                <label class="form-label"><i class="fab fa-fw fa-instagram text-instagram me-2"></i>Instagram *</label>
                                <input type="text" class="form-control" name="instagram" placeholder="" aria-label="Instagram" value="<?php echo htmlspecialchars($social_media['instagram']); ?>">
                            </div>
                            
                            <!-- Pinterest -->
                            <div class="col-md-6">
                                <label class="form-label"><i class="fab fa-fw fa-pinterest text-pinterest"></i>Pinterest *</label>
                                <input type="text" class="form-control" name="pinterest" placeholder="" aria-label="Pinterest" value="<?php echo htmlspecialchars($social_media['pinterest']); ?>">
                            </div>
                        </div> <!-- Row END -->
                    </div>
                </div>

                <!-- Change password -->
                <div class="col-xxl-6">
                    <div class="bg-secondary-soft px-4 py-5 rounded">
                        <div class="row g-3">
                            <h4 class="my-4">Change Password</h4>
                            <!-- Old password -->
                            <div class="col-md-6">
                                <label for="exampleInputPassword1" class="form-label">Old password *</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="current_password">
                            </div>
                            <!-- New password -->
                            <div class="col-md-6">
                                <label for="exampleInputPassword2" class="form-label">New password *</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" name="new_password">
                            </div>
                            <!-- Confirm password -->
                            <div class="col-md-12">
                                <label for="exampleInputPassword3" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control" id="exampleInputPassword3" name="confirm_password">
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row END -->
            <!-- button -->
            <div class="gap-3 d-md-flex justify-content-md-end text-center" style="margin-bottom: 50px;">
                <a href="index.php" class="btn btn-primary btn-lg">Quay lại</a>

                <button type="submit" class="btn btn-primary btn-lg">Sửa profile</button>
            </div>
        </form> <!-- Form END -->
    </div>
</div>
</div>
</body>
</html>
