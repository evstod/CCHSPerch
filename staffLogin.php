<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <form class="login" action="staffLogin.php" method="post">
      <img id="logo" src="img/perchlogo.jpg" alt="CCHS Perch Logo">
      <br>
      <div class="login_id login_in">
        <label for="email">District Email</label>
        <input type="email" name="email" value="" required>
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
      }
      ?>
      <div class="login_footer">
        <div class="login_staffRedir">
          <a href="index.php"><button type="button" name="button" onclick="">Student Order</button></a>
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
      $email = $_REQUEST['email'];
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
      $sql = "SELECT Email, LastName, FirstName, isAdmin FROM user_staff WHERE Email = '" . $email . "' AND PIN = '" . $pin . "'";
      $result = mysqli_query($conn, $sql);
      if ($row = mysqli_fetch_assoc($result)) {
        //User login succeed; start session
        session_start();
        $_SESSION['ID'] = $row['Email'];
        $_SESSION['LastName'] = $row['lastName'];
        $_SESSION['FirstName'] = $row['FirstName'];
        $_SESSION['isStaff'] = true;
        $_SESSION['isAdmin'] = $row['isAdmin'];
        header("Location: blog.php");
        die();
      }
      else {
        header("Location: staffLogin.php?errorMsg=1");
        die();
      }
    }
    ?>
  </body>
</html>
