<?php
include('conn.php');
$check_query = mysql_query("SELECT * FROM Customers WHERE name='$username' LIMIT 1;");

if(mysql_fetch_array($check_query)){
	echo "usename error ".$username." can not use! <a href='javascript:history.back(-1);'>return</a>";
	exit;
}

$password = MD5($password);
$sql = "INSERT INTO Customers (name,password,email) VALUES ('$username','$password','$email')";
if(mysql_query($sql,$conn)){
	//redirect
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'login.html';

  header("Location: http://$host$uri/$extra");
  exit;
} else {
    echo 'add data fail：',mysql_error(),'<br />';
    echo 'click <a href="javascript:history.back(-1);">return</a> retry';
}
?>
