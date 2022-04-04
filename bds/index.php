<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    table tr td:last-child {
      text-align: center;
      width: 120px;
    }

    img {
      width: auto;
      height: 120px;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
</head>

<body>
  <div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Infomation Details</h2>
            <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New information</a>
          </div>
          <?php
          // include config
          require_once "config.php";

          // truy vấn
          $sql = "SELECT * FROM infor";
          if ($result = $conn->query($sql)) {
            // tạo các cột theo tên trường.
            if ($result->rowCount() > 0) {
              echo '<table class="table table-bordered table-striped">';
              echo "<thead>";
              echo "<tr>";
              echo "<th>#</th>";
              echo "<th>Tittle</th>";
              echo "<th>Description</th>";
              echo "<th>Acreage</th>";
              echo "<th>Price</th>";
              echo "<th>Direction</th>";
              echo "<th>Status</th>";
              echo "<th>Active</th>";
              echo "<th>Image</th>";
              echo "<th>Action</th>";
              echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              // thêm kết quả theo hàng.
              while ($row = $result->fetch()) {
                $id = $row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $acreage = $row["acreage"];
                $price = $row["price"];
                $direction = $row["direction"];
                $status = $row["status"] == 0 ? "Đã bán" : "Đang bán";
                $active = $row["active"] == 0 ? "Không hoạt động" : "Hoặt động";
                $image = $row["image"];
                echo "<tr>";
                echo "<td>" . $id . "</td>";
                echo "<td>" . $title . "</td>";
                echo "<td>" . $description . "</td>";
                echo "<td>" . $acreage . "</td>";
                echo "<td>" . $price . "</td>";
                echo "<td>" . $direction . "</td>";
                echo "<td>" . $status . "</td>";
                echo "<td>" . $active . "</td>";
                echo "<td>" .  "<img src='$image'>" . "</td>";
                echo "<td>";
                //echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="" data-toggle="modal" data-target="#view" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
              }
              echo "</tbody>";
              echo "</table>";
              // Free result set
              unset($result);
            } else {
              echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
          } else {
            echo "Oops! Something went wrong. Please try again later.";
          }
          // Close connection
          unset($conn);
          ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="modal-body">

                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
</body>

</html>