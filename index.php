<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <form class="login" action="index.php" method="post">
      <h1>*CCHS PERCH LOGO*</h1>
      <br><br><br>
      <div class="login_id login_in">
        <label for="stud_id">Student ID</label>
        <input type="username" name="stud_id" value="" required>
      </div>
      <div class="login_pin login_in">
        <label for="pin">PIN</label>
        <input type="password" name="pin" value="" required>
      </div>
      <?php
      if (isset($_GET['errorMsg'])) {
        if ($_GET['errorMsg'] == 1) {
          echo "<div class='login_error'>No record found for ID and PIN combination. If this is in error, please contact the Tech Department</div>";
        }
        if ($_GET['errorMsg'] == 2) {
          echo "<div class='login_error'>Session failed.</div>";
        }
      }
      ?>
      <div class="login_footer">
        <div class="login_staffRedir">
          <a href="staffLogin.php"><button type="button" name="button" onclick="">Staff Order</button></a>
        </div>
        <div class="login_submitCon">
          <input type="submit" name="" value="Login">
        </div>
      </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      function testInput($value)
      {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
      }
      $id = $_REQUEST['stud_id'];
      $pin = $_REQUEST['pin'];

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
      $sql = "SELECT ID, LastName, FirstName FROM user_student WHERE ID = '" . $id . "' AND PIN = '" . $pin . "'";
      $result = mysqli_query($conn, $sql);

      if ($row = mysqli_fetch_assoc($result)) {
        //User login succeed; start session
        session_start();
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['LastName'] = $row['LastName'];
        $_SESSION['FirstName'] = $row['FirstName'];
        header("Location: blog.php");
        die();
      }
      else {
        header("Location: index.php?errorMsg=1");
        die();
      }
    }
    ?>
  </body>
</html>
