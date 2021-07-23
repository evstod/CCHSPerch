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
if ($_SERVER['REQUEST_METHOD'] == "GET") {
  $servername = "localhost";
  $username = "orderaccess";
  $password = "grIR5]ymCIV2Fn0C";
  $dbname = "perchweb";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql = "DELETE FROM orders WHERE Prim = " . $_GET['id'];
  $result = mysqli_query($conn, $sql);
}
?>
