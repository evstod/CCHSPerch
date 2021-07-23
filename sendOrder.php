<?php
function testInput($value)
{
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}

if (!$_SERVER['REQUEST_METHOD'] == "POST") {
  header("Location: blog.php");
  die();
}

session_start();

if (isset($_SESSION['isStaff']) && $_SESSION['isStaff']) {
  $userType = "Staff";
}
else $userType = "Student";

$userID = $_SESSION['ID'];

$contents = "";
foreach ($_POST as $key => $value) {
  if (str_contains($key, "_num")) {
    $contents .= "$value - ";
  }
  else if (str_contains($key, "_format")) {
    $contents .= "$value\n";
  }
  else break;
}
$orderType = $_POST['orderType'];
if ($orderType == "deliver") {
  $deliver = 1;
}
else $deliver = 0;
$contents .= "Total Cost: ". $_POST['total'] . "\r\n";
if ($orderType == "deliver") {
  $contents .= "Delivery requested to ROOM\r\n"; // TODO: Add input from room delivery num
}
$notes = testInput($_POST['addNotes']);

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
$sql = "INSERT INTO orders VALUES (NULL, \"$userType\", \"$userID\", \"$contents\", \"$notes\", \"$deliver\")";
$result = mysqli_query($conn, $sql);

if (mysqli_error($conn) == "") {
  header("Location: blog.php?orderSuccess=1");
}
else {
  header("Location: blog.php?orderSuccess=0");
}
?>
