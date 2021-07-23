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
  <style media="screen">
    main a {
      display: block;
      width: 400px;
      height: 50px;
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
  ?>
  <body>
    <br>
    <main class="container-fluid d-flex justify-content-around align-content-center">
      <a class="btn btn-primary btn-lg" href="orders.php">Orders</a>
      <a class="btn btn-primary btn-lg disabled" href="#">Blog Editor</a>
    </main>
  </body>
</html>
