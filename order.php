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
    }

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
      $data = array();
      foreach ($_GET as $key => $value) {
        if ($value > 0) { //add selected items to request for checkout
          if (!str_contains($key, "_flavor")) {
            $data[$key] = $value;
          }
        }
      }
      if (sizeof($data) < 2) {
        $errormsg = "<p class='text-danger'>Select at least 1 item</p>";
      }
      else {
        header("Location: checkout.php?" . http_build_query($data));
        die();
      }
    }
   ?>
  <body>
    <nav class="navbar navbar-expand bg-light align-content-center justify-content-center">
      <ul class="navbar-nav nav-tabs nav-justified  align-content-center justify-content-center">
        <li class="nav-item" ><a class="nav-link" href="blog.php">Blog</a></li>
        <li class="nav-item active" ><a class="nav-link" href="#">Order</a></li>
      </ul>
      <div class="user-info">
        <h4><?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?></h4>
        <p class=""><a href="logout.php">Not you?</a></p>
      </div>
    </nav>
    <main class="container">
      <form class="" action="order.php" method="get">
        <input type="text" name="submitCheck" value="true" hidden disabled>
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

        //Coffee
        $sql = "SELECT * FROM coffee_flavor";
        $result = mysqli_query($conn, $sql);
        echo "<div class='section_con container'>
                <h3 class='section_label'>Coffee</h3>
                <div class='section_opt'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<input id='coffee" . $row['Prim'] . "' type='checkbox' name='coffee_flavor' value='" . $row['Name'] . "'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><label ";
          if ($row['Enabled'] == 0) {
            echo " class='disabled_label' ";
          }
          echo "for='coffee" . $row['Prim'] . "'>" . $row['Name'] . "</label>";
          echo "<input id='cnum" . $row['Prim'] . "' class='item_num' type='number' name='" . $row['Name'] . "Num' value='0'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><br>";
          echo "
          <script>
            $(function () {
                $('#coffee" . $row['Prim'] . "').on('click', function () {
                    $('#cnum" . $row['Prim'] . "').toggle(this.checked);
                    if (!$(this).is(':checked')) {
                        $('#cnum" . $row['Prim'] . "').val(0);
                    }
                    else $('#cnum" . $row['Prim'] . "').val(1);
                });
            });
          </script>";        }
        echo "</div></div><br>";


        //Tea
        $sql = "SELECT * FROM tea_flavor";
        $result = mysqli_query($conn, $sql);
        echo "<div class='section_con container'>
                <h3 class='section_label'>Tea</h3>
                <div class='section_opt'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<input id='tea" . $row['Prim'] . "' type='checkbox' name='tea_flavor' value='" . $row['Name'] . "'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><label ";
          if ($row['Enabled'] == 0) {
            echo " class='disabled_label' ";
          }
          echo "for='tea" . $row['Prim'] . "'>" . $row['Name'] . "</label>";
          echo "<input id='tnum" . $row['Prim'] . "' class='item_num' type='number' name='" . $row['Name'] . "Num' value='0'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><br>";
          echo "
          <script>
            $(function () {
                $('#tea" . $row['Prim'] . "').on('click', function () {
                    $('#tnum" . $row['Prim'] . "').toggle(this.checked);
                    if (!$(this).is(':checked')) {
                        $('#tnum" . $row['Prim'] . "').val(0);
                    }
                    else $('#tnum" . $row['Prim'] . "').val(1);
                });
            });
          </script>";
        }
        echo "</div></div><br>";


        //Misc
        $sql = "SELECT * FROM misc_flavor";
        $result = mysqli_query($conn, $sql);
        echo "<div class='section_con container'>
                <h3 class='section_label'>Other</h3>
                <div class='section_opt'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<input id='misc" . $row['Prim'] . "' type='checkbox' name='misc_flavor' value='" . $row['Name'] . "'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><label ";
          if ($row['Enabled'] == 0) {
            echo " class='disabled_label' ";
          }
          echo "for='misc" . $row['Prim'] . "'>" . $row['Name'] . "</label>";
          echo "<input id='mnum" . $row['Prim'] . "' class='item_num' type='number' name='" . $row['Name'] . "Num' value='0'";
          if ($row['Enabled'] == 0) {
            echo " disabled ";
          }
          echo "/><br>";
          echo "
          <script>
            $(function () {
                $('#misc" . $row['Prim'] . "').on('click', function () {
                    $('#mnum" . $row['Prim'] . "').toggle(this.checked);
                    if (!$(this).is(':checked')) {
                        $('#mnum" . $row['Prim'] . "').val(0);
                    }
                    else $('#mnum" . $row['Prim'] . "').val(1);
                });
            });
          </script>";
        }
        echo "</div></div>";
        ?>
        <br><br>
        <?php if (isset($errormsg)) echo $errormsg; ?>
        <input class="btn-primary btn-lg" type="submit" name="" value="Next >">
        <br>
      </form>
    </main>
  </body>
</html>
