
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Chỉnh Sửa Sản Phẩm</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tiêu đề home:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['ten']); ?>" required>
            </div>
            <div class="form-group">
                <label for="baohanh">Nội dung tiêu đề:</label>
                <input type="text" class="form-control" id="baohanh" name="baohanh" value="<?php echo htmlspecialchars($row['baohanh']); ?>" required>
            </div>
            <div class="form-group">
                <label for="trangthai">Người mua:</label>
                <input type="text" class="form-control" id="trangthai" name="trangthai" value="<?php echo htmlspecialchars($row['trangthai']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gia">Đánh giá:</label>
                <input type="text" class="form-control" id="gia" name="gia" value="<?php echo htmlspecialchars($row['gia']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btn">Cập Nhật</button>
        </form>
    </div>
</body>
</html>
