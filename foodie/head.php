<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="js/foodie.js"></script>
    <style>
      html body .admin{
        <?php
          if($_SESSION['foodie_username']!='admin'){
            echo "display:none;";
          }
        ?>
      }
    </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="restaurants.php">Foody Foodie, CMPE226 Team 22</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="restaurants.php">Home</a></li>
            <li><a href="orders.php">My Orders</a></li>
            <li class="admin"><a href="customers.php">Customers</a></li>
            <li class="admin"><a href="deliveryboys.php">Delivery Boys</a></li>

            <?php
              if(isset($_SESSION['userid'])){
                echo '<li><a href="login.php?action=logout">Sign Out</a></li>';
                echo '<li><a>Current User: '.$_SESSION['foodie_username'].'</a></li>';
              }else{
                echo '<li><a href="login.html">Sign In</a></li>';
              }
            ?>
            <li><a href="https://github.com/Budweiser-CMPE207/FoodyFoodie">Github</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container" style="margin-top:40px;">
