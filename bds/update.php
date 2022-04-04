<?php
// Include config file
require_once "config.php";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
  // Get hidden input value
  $id = $_POST["id"];
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
  $active = trim($_POST["status"]);

  // Prepare an update statement
  $sql = "UPDATE infor SET title=:title, description=:description, acreage=:acreage, price=:price, direction=:direction, status=:status, active=:active, image=:image WHERE id=:id";

  if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":title", $param_title);
    $stmt->bindParam(":description", $param_description);
    $stmt->bindParam(":acreage", $param_acreage);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":direction", $param_direction);
    $stmt->bindParam(":status", $param_status);
    $stmt->bindParam(":active", $param_active);
    $stmt->bindParam(":image", $param_image);
    $stmt->bindParam(":id", $param_id);

    // Set parameters
    $param_title = $title;
    $param_description = $description;
    $param_acreage = $acreage;
    $param_price = $price;
    $param_direction = $direction;
    $param_status = $status;
    $param_active = $active;
    $param_image = $image;
    $param_id = $id;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
      // Records updated successfully. Redirect to landing page
      header("location: index.php");
      exit();
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }
  }
  // 
  $stmt = null;
  $conn = null;
} else {
  // Check existence of id parameter before processing further
  if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $id =  trim($_GET["id"]);

    // Prepare a select statement
    $sql = "SELECT * FROM infor WHERE id = :id";
    if ($stmt = $conn->prepare($sql)) {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":id", $param_id);

      // Set parameters
      $param_id = $id;

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        if ($stmt->rowCount() == 1) {
          // Retrieve individual field value
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          // gán giá trị
          $title = $row["title"];
          $description = $row["description"];
          $acreage = $row["acreage"];
          $price = $row["price"];
          $direction = $row["direction"];
          $status = $row["status"];
          $active = $row["active"];
          $image = $row["image"];
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // 
    $stmt = null;
    $conn = null;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Record</title>

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
            <h2 class="mt-5">Update Record</h2>
            <p>Please edit the input values and submit to update the employee record.</p>
            <form class="needs-validation" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" required>
              </div>
              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $description; ?>" required>
              </div>
              <div class="form-group">
                <label>Acreage</label>
                <input type="number" name="acreage" class="form-control" value="<?php echo $acreage; ?>" required>
              </div>
              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo $price; ?>" required>
              </div>
              <div class="form-group">
                <label>Direction</label>
                <select name="direction" class="custom-select" required>
                <option selected><?php echo $direction; ?></option>
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
                  <input class="form-check-input" type="radio" name="status" id="daban" value="0" required
                   <?php if($status == 0 ) echo "checked"?> >
                  <label class="form-check-label" for="daban">
                    Đã bán
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="dangban" value="1" required
                  <?php if($status == 1 ) echo "checked"?> >
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
                <input type="text" name="image" class="form-control" value="<?php echo $image; ?>">
              </div>
              <input type="hidden" name="id" value="<?php echo $id; ?>" />
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