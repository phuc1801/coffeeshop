<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Truy vấn số lượng hàng còn và hết
$sql = "SELECT trangthai, COUNT(*) AS so_luong FROM product GROUP BY trangthai";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tạo một mảng chứa dữ liệu cho biểu đồ
$data = array(
    array('Trạng thái', 'Số lượng')
);

foreach ($products as $product) {
    // Chuyển đổi trạng thái từ số sang chuỗi
    $trang_thai = ($product['trangthai'] == 0) ? 'Hết hàng' : 'Còn hàng';
    $so_luong = (int)$product['so_luong'];

    // Thêm dữ liệu vào mảng
    $data[] = array($trang_thai, $so_luong);
}

// Chuyển đổi mảng dữ liệu thành định dạng JSON
$json_data = json_encode($data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Status Analytics</title>
    <!-- Link CSS của Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thư viện Google Charts -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-5">Thống kê số lượng hàng còn và hết</h2>
                <!-- Địa điểm cho biểu đồ -->
                <div id="pie_chart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>

    <script>
        // Load thư viện Google Charts
        google.charts.load('current', {'packages':['corechart']});

        // Callback function để vẽ biểu đồ
        google.charts.setOnLoadCallback(drawChart);

        // Hàm để vẽ biểu đồ
        function drawChart() {
            // Dữ liệu được cung cấp từ PHP
            var jsonData = <?php echo $json_data; ?>;

            // Tạo một DataTable từ dữ liệu JSON
            var data = google.visualization.arrayToDataTable(jsonData);

            // Tùy chọn cho biểu đồ
            var options = {
                title: 'Thống kê số lượng hàng còn và hết',
                pieHole: 0.4,
                // Chú thích cho biểu đồ
                legend: { position: 'bottom' }
            };

            // Tạo một biểu đồ tròn
            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

            // Vẽ biểu đồ với dữ liệu và tùy chọn đã chọn
            chart.draw(data, options);
        }
    </script>
</body>
</html>
