<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $uploadDir = 'upload/';
        $uploadedFiles = [];

        // Handle image upload
        $images = ['anhmot', 'anhhai', 'anhba'];
        foreach ($images as $image) {
            if (isset($_FILES[$image]) && $_FILES[$image]['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES[$image]['tmp_name'];
                $name = basename($_FILES[$image]['name']);
                $filePath = $uploadDir . $name;
                if (move_uploaded_file($tmpName, $filePath)) {
                    $uploadedFiles[$image] = $filePath;
                } else {
                    echo "Failed to upload $name.";
                }
            }
        }

        $sql = "UPDATE home SET 
                    tieude = :tieude,
                    noidung = :noidung,
                    nguoimua = :nguoimua,
                    danhgia = :danhgia,
                    cauhoi = :cauhoi,
                    tieudemot = :tieudemot,
                    ndtieudemot = :ndtieudemot,
                    anhmot = :anhmot,
                    anhhai = :anhhai,
                    tieudehai = :tieudehai,
                    ndtieudehai = :ndtieudehai,
                    anhba = :anhba
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tieude', $_POST['tieude']);
        $stmt->bindParam(':noidung', $_POST['noidung']);
        $stmt->bindParam(':nguoimua', $_POST['nguoimua']);
        $stmt->bindParam(':danhgia', $_POST['danhgia']);
        $stmt->bindParam(':cauhoi', $_POST['cauhoi']);
        $stmt->bindParam(':tieudemot', $_POST['tieudemot']);
        $stmt->bindParam(':ndtieudemot', $_POST['ndtieudemot']);
        $stmt->bindParam(':anhmot', isset($uploadedFiles['anhmot']) ? $uploadedFiles['anhmot'] : $home['anhmot']);
        $stmt->bindParam(':anhhai', isset($uploadedFiles['anhhai']) ? $uploadedFiles['anhhai'] : $home['anhhai']);
        $stmt->bindParam(':tieudehai', $_POST['tieudehai']);
        $stmt->bindParam(':ndtieudehai', $_POST['ndtieudehai']);
        $stmt->bindParam(':anhba', isset($uploadedFiles['anhba']) ? $uploadedFiles['anhba'] : $home['anhba']);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->execute();

        echo "Cập nhật thành công!";
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

$sql1 = "SELECT * FROM home";
$stmt = $conn->prepare($sql1);
$stmt->execute();
$home = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Chỉnh sửa Home</h1>
        <form method="post" action="home.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($home['id']); ?>">
            
            <div class="form-group">
                <label for="tieude">Tiêu đề:</label>
                <input type="text" class="form-control" name="tieude" value="<?php echo htmlspecialchars($home['tieude']); ?>">
            </div>
            
            <div class="form-group">
                <label for="noidung">Nội dung:</label>
                <textarea class="form-control" name="noidung"><?php echo htmlspecialchars($home['noidung']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="nguoimua">Người mua:</label>
                <input type="number" class="form-control" name="nguoimua" value="<?php echo htmlspecialchars($home['nguoimua']); ?>">
            </div>
            
            <div class="form-group">
                <label for="danhgia">Đánh giá:</label>
                <input type="number" class="form-control" name="danhgia" value="<?php echo htmlspecialchars($home['danhgia']); ?>">
            </div>
            
            <div class="form-group">
                <label for="cauhoi">Câu hỏi:</label>
                <textarea class="form-control" name="cauhoi"><?php echo htmlspecialchars($home['cauhoi']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="tieudemot">Tiêu đề một:</label>
                <input type="text" class="form-control" name="tieudemot" value="<?php echo htmlspecialchars($home['tieudemot']); ?>">
            </div>
            
            <div class="form-group">
                <label for="ndtieudemot">Nội dung tiêu đề một:</label>
                <textarea class="form-control" name="ndtieudemot"><?php echo htmlspecialchars($home['ndtieudemot']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="anhmot">Ảnh một hiện tại:</label>
                <img src="<?php echo htmlspecialchars($home['anhmot']); ?>" alt="Ảnh một" class="img-thumbnail mb-3">
                <input type="file" class="form-control-file" name="anhmot">
            </div>
            
            <div class="form-group">
                <label for="anhhai">Ảnh hai hiện tại:</label>
                <img src="<?php echo htmlspecialchars($home['anhhai']); ?>" alt="Ảnh hai" class="img-thumbnail mb-3">
                <input type="file" class="form-control-file" name="anhhai">
            </div>
            
            <div class="form-group">
                <label for="tieudehai">Tiêu đề hai:</label>
                <input type="text" class="form-control" name="tieudehai" value="<?php echo htmlspecialchars($home['tieudehai']); ?>">
            </div>
            
            <div class="form-group">
                <label for="ndtieudehai">Nội dung tiêu đề hai:</label>
                <textarea class="form-control" name="ndtieudehai"><?php echo htmlspecialchars($home['ndtieudehai']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="anhba">Ảnh ba hiện tại:</label>
                <img src="<?php echo htmlspecialchars($home['anhba']); ?>" alt="Ảnh ba" class="img-thumbnail mb-3">
                <input type="file" class="form-control-file" name="anhba">
            </div>
            
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
