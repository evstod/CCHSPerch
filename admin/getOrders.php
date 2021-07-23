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

  $data = json_encode($result->fetch_all());
  echo "{\"iTotalRecords\": " . mysqli_num_rows($result) . ",\"iTotalDisplayRecords\": " . mysqli_num_rows($result) . ",\"data\":" . $data . "}";
?>
