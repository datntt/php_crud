<?php
//include config
require_once "config.php";

// tạo các biến với giá trị trống
$title = $description = $acreage = $price = $direction = $status = $active = $image = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // lấy các giá trị nhập vào từ form
  //string
  $title = trim($_POST["title"]);
  $description = trim($_POST["description"]);
  $direction = trim($_POST["direction"]);
  $image = trim($_POST["image"]);
  // double
  $acreage = trim($_POST["acreage"]);
  $price = trim($_POST["price"]);
  // bolean
  $status = trim($_POST["status"]);
  $input_active = trim($_POST["active"]);
  if ($input_active == 1) {
    $active = 1;
  } else {
    $active = 0;
  }

  $sql = "INSERT INTO infor (title, description, acreage, price, direction, status, active, image)
   VALUES ('$title', '$description', $acreage, $price, '$direction', $status, $active, '$image')";
  // thực thi câu lệnh sql
  if ($conn->exec($sql) == true) {
    header("location: index.php");
    exit();
  }

  $conn = null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>

  <!-- CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .wrapper {
      width: 600px;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <head></head>

  <body>
    <div class="wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mt-5">Create Record</h2>
            <p>Please fill this form and submit to add infomation record to the database.</p>
            <!-- submit vào trạng hiện tại -->
            <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Acreage</label>
                <input type="number" name="acreage" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Direction</label>
                <select name="direction" class="custom-select" required>
                <option selected disabled value="">Chọn</option>
                  <option value="Đông">Đông</option>
                  <option value="Tây">Tây</option>
                  <option value="Nam">Nam</option>
                  <option value="Bắc">Bắc</option>
                  <option value="Đông Tứ Trạch">Đông Tứ Trạch</option>
                  <option value="Tây Tứ Trạch">Tây Tứ Trạch</option>
                </select>
              </div>
              <div class="form-group">
                <label>Status</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="daban" value="0" required>
                  <label class="form-check-label" for="daban">
                    Đã bán
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="dangban" value="1" required>
                  <label class="form-check-label" for="dangban">
                    Đang bán
                  </label>
                </div>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" name="active" value="1" class="form-check-input" id="act" checked>
                <label class="form-check-label" for="act">Active</label>
              </div>
              <div class="form-group">
                <label>Image</label>
                <input type="text" name="image" class="form-control">
              </div>
              <input type="submit" class="btn btn-primary" value="Submit">
              <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
  <footer></footer>
</body>

</html>