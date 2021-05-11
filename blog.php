<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/master.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </head>
  <?php
    session_start();
    // TODO: Figure out equivalent to ID for staff
    //check if session variables from login page were carried, if not return to login
    if (!isset($_SESSION['ID']) && !isset($_SESSION['FirstName']) && !isset($_SESSION['lastName'])) {
    header("Location: index.php?errorMsg=2");
  } ?>
  <body>
    <nav class="navbar navbar-expand bg-light align-content-center justify-content-center">
      <ul class="navbar-nav nav-tabs nav-justified  align-content-center justify-content-center">
        <li class="nav-item active" ><a class="nav-link" href="#">Blog</a></li>
        <li class="nav-item" ><a class="nav-link" href="order.php">Order</a></li>
      </ul>
      <div class="user-info">
        <h4><?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?></h4>
        <p class=""><a href="logout.php">Not you?</a></p>
      </div>
    </nav>
    <main class="container">
      <?php
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
      $sql = "SELECT * FROM blogpost";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $date = date_create($row['Date']);
        echo "<div class='blogpost container'>";
        if ($row['HasImage']) {
          echo "<img class='img-fluid' src='img/blogsrc/" . $row['Prim'] . ".jpg'>";
        }
        echo"<h2>" . $row['Title'] . "</h2>
              <h5>" . date_format($date,"l, F jS, Y") . "</h5>
              <p>" . $description = preg_replace("/\r\n|\r|\n/", '<br/>', $row['Body']) . "</p>
            </div>";
      }
      ?>

    </main>
  </body>
</html>
