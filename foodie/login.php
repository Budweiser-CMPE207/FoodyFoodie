<?php
session_start();
if($_GET['action'] == "logout"){
  unset($_SESSION['userid']);
  unset($_SESSION['foodie_username']);
  //redirect
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'login.html';

  header("Location: http://$host$uri/$extra");
  exit;
}
if(!isset($_POST['submit'])){
  exit('Fail!');
}

include('db.php');
$conn = mysql_connect($host,$username,$password);
if (!$conn){
    die("database connection fail：" . mysql_error());
}
mysql_select_db($database, $conn);

$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);
$check_query = mysql_query("SELECT customer_id FROM Customers WHERE name='$username' AND password='$password' LIMIT 1");
if($result = mysql_fetch_array($check_query)){

  $_SESSION['foodie_username'] = $username;
  $_SESSION['userid'] = $result['customer_id'];
  //redirect
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'restaurants.php';

  header("Location: http://$host$uri/$extra");
  exit;
  exit;
} else {
  exit('login fail <a href="javascript:history.back(-1);">return</a> retry');
}

?>
