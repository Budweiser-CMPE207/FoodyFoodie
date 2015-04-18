<?php
  session_start();
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  if(isset($_SESSION['userid'])){
    //redirect
    $extra = 'restaurants.php';
    header("Location: http://$host$uri/$extra");
    exit;
  }else{
    $extra = 'login.html';
    header("Location: http://$host$uri/$extra");
  }
?>
