<?php
// kiểm tra id
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config
    require_once "config.php";

    // câu lệnh sql
    $sql = "DELETE FROM infor WHERE id = :id";

    if ($stmt = $conn->prepare($sql)) {
        // Bind biến theo tham số
        $stmt->bindParam(":id", $param_id);

        // lấy ra id
        $param_id = trim($_POST["id"]);

        // thực thi
        if ($stmt->execute()) {
            // sau khi xoá về index
            header("location: index.php");
            exit();
        }
    }
    // set null
    $stmt = null;
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
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
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this informations record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>