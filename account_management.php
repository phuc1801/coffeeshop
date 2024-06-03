<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";

// Kiểm tra xem người dùng đã đăng nhập với quyền quản trị chưa
if (!isset($_SESSION['username']) || $_SESSION['type'] !== 1) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập hoặc không có quyền truy cập
    exit();
}

// Xử lý yêu cầu thay đổi loại tài khoản
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_type'])) {
    $username = $_POST['username'];
    $new_type = $_POST['new_type'];

    // Cập nhật loại tài khoản
    $sql = "UPDATE account SET type = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$new_type, $username]);
}

// Truy vấn danh sách các tài khoản có loại là 0
$sql = "SELECT username, email, type FROM account WHERE type = 0";
$stmt = $conn->query($sql);
$accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Account Management</h1>
        <!-- Button to go back to menu_admin.php -->
        <a href="menu_admin.php" class="btn btn-secondary mb-3">Back to Admin Menu</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Change Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($account['username']); ?></td>
                        <td><?php echo htmlspecialchars($account['email']); ?></td>
                        <td><?php echo htmlspecialchars($account['type']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="username" value="<?php echo htmlspecialchars($account['username']); ?>">
                                <div class="form-group">
                                    <select class="form-control" name="new_type">
                                        <option value="0" <?php if ($account['type'] == 0) echo 'selected'; ?>>Normal</option>
                                        <option value="1" <?php if ($account['type'] == 1) echo 'selected'; ?>>Admin</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="change_type">Change</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
