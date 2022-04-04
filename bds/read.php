<?php
// Kiểm tra id xem có tồn tại
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    // include config
    require_once "config.php";

    // chọn id
    $sql = "SELECT * FROM infor WHERE id = :id";

    if ($stmt = $conn->prepare($sql)) {
        // gán giá trị vào tham số
        $stmt->bindParam(":id", $param_id);

        // đặt giá trị tham số
        $param_id = trim($_GET["id"]);

        // thực thi
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {

                // Tìm kết quả trả về dưới dạng 1 hàng.
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Lấy các giá trị
                $title = $row["title"];
                $description = $row["description"];
                $acreage = $row["acreage"];
                $price = $row["price"];
                $direction = $row["direction"];
                $status = $row["status"];
                $active = $row["active"];
                $image = $row["image"];
            }
        }
    }

    // 
    $stmt = null;
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Title:</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Acreage:</label>
                        <p><b><?php echo $row["acreage"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <p><b><?php echo $row["price"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Direction:</label>
                        <p><b><?php echo $row["direction"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <p><b><?php echo $row["status"] == 0 ? "Đã bán" : "Đang bán"; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Active:</label>
                        <p><b><?php echo $row["active"] == 0 ? "Không hoạt động" : "Hoặt động"; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>URL Image:</label>
                        <p><b><?php echo $row["image"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>