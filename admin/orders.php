<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/master.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

  </head>
  <style media="screen">
    html {
      background-color: #FFF;
    }
    main {
      width: 100vw;
    }
  </style>
  <?php
    session_start();
    // TODO: Figure out equivalent to ID for staff
    //check if session variables from login page were carried, if not return to login
    if (!isset($_SESSION['ID']) && !isset($_SESSION['FirstName']) && !isset($_SESSION['lastName'])) {
      header("Location: ../index.php?errorMsg=2");
      die();
    }
    if (!(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'])) {
      header("Location: ../blog.php?adminDeny=true");
      die();
    }

    $servername = "localhost";
    $username = "siteaccess";
    $password = "N7Y#\$Ms9cK@CD!";
    $dbname = "perchweb";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
  ?>
  <body>
    <main>
      <table id="orders_table">
        <thead>
          <?php
          foreach (mysqli_fetch_assoc($result) as $key => $value) {
            echo "<th>$key</th>";
          }
          ?>
        </thead>
        <tbody>
        </tbody>
      </table>
    </main>
    <script type="text/javascript">
    $(document).ready( function () {
      $('#orders_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "getOrders.php",
        "columnDefs": [
          {
            "width": "10%", "targets": 0,
            "render": function (data) {
  					return `<div class="text-center">
  						<a class="btn btn-danger text-white" style="cursor:pointer; width:70px;" onclick="Delete('deleteOrder.php?id=${data}')">Delete</a>
  						</div>`;
            }
          },
          { "width": "15%", "targets": 1 },
          { "width": "15%", "targets": 2 },
          { "width": "35%", "targets": 3 },
          { "width": "20%", "targets": 4 },
          { "width": "10%", "targets": 5 },
        ]
      });

      $('#orders_table').DataTable().order( [ 0, 'desc' ] ).draw();
    });

    function Delete(url) {
      $.ajax({
				type: "GET",
				url: url,
				success: function (data) {
					toastr.success("Order Deleted");
					$('#orders_table').ajax.reload();
				},
        failed: function (data) {
          toastr.error("Failed to Delete");
        }
			});
    }
    </script>
  </body>
</html>
