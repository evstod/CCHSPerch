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
  .orderNotes ul li input {
    width: 35px;
    border: none;
  }
  main {
    background-color: inherit;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin-top: 20px;
  }
  main div {
    background-color: #FFF;
    border-radius: 25px;
    padding: 25px;
    margin-left: 10px;
    flex-shrink: 1;
    flex-grow: 1;
  }
  main:first-child {
    margin-left: 0;
  }
  @media only screen
    and (min-device-width: 375px)
    and (max-device-width: 812px) {
    main {
      flex-direction: column !important;
    }
  }

  .container>div {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-between;
  }
  .orderType_con {
    width: 100%;
  }
  .orderBtn_con {
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    justify-content: flex-end;

    width: 100%;
  }
  .orderBtn_con input {
    margin-left: 30px;
  }
  </style>
  <?php
    session_start();
    // TODO: Figure out equivalent to ID for staff
    //check if session variables from login page were carried, if not return to login
    if (!isset($_SESSION['ID']) && !isset($_SESSION['FirstName']) && !isset($_SESSION['lastName'])) {
    header("Location: index.php?errorMsg=2");
    }
   ?>
   <form class="" action="sendOrder.php" method="post">
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
         <div class="orderNotes">
           <h2>Your Order</h2>
           <h5>Each item is $1</h5>
           <ul class="border-info">
             <?php
             $total = 0;
             foreach ($_GET as $key => $value) {
               $key = str_replace("Num", "", $key);
               $keyFormat = str_replace("_", " ", $key);
               echo "<li><input disabled type='number' name='" . $key . "_num' value='" . $value . "' />" . $keyFormat . "</li>";
               echo "<input hidden type='number' name='" . $key . "_num' value='" . $value . "' />";
               echo "<input hidden type='text' name='" . $key . "_format' value='" . $keyFormat . "' />";
               $total += intval($value);
             }
             ?>
             <input hidden type="text" name="total" value="<?php echo $total; ?>">
           </ul>
           <br>
           <div class="orderType_con">
             <input type="radio" name="orderType" value="pickup" id="pickup" checked><label for="pickup"> Pickup</label><br>
             <input type="radio" name="orderType" value="deliver" id="deliver" <?php if (!isset($_SESSION['isStaff'])) {echo "disabled";} ?>><label for="deliver"> Delivery Cart <?php if (!isset($_SESSION['isStaff'])) {echo "<span class='text-danger'>By Staff Order Only</span>";} ?></label>
             <p id="deliverNote" class="text-danger hidden">Please put your room number in Additional Notes</p>
             <script type="text/javascript">
             $(function () {
                 $('#deliver').on('click', function () {
                     $('#deliverNote').toggle(this.checked);
                 });
             });
             </script>
           </div>
         </div>
         <div class="orderSubmit">
           <textarea name="addNotes" rows="8" cols="60" placeholder="Additional Notes, special instructions,..."></textarea>
           <br>
           <div class="orderBtn_con">
             <h3 class="orderTotal float-right">Total: <b>$<?php echo $total; ?></b></h3>
             <input type="submit" name="" value="Place Order" class="btn-lg btn-primary">
           </div>
         </div>
       </main>
     </body>
   </form>
</html>
