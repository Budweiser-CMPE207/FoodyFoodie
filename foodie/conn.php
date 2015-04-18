<?php
include('db.php');
$conn = mysql_connect($host,$username,$password);
if (!$conn){
    die("database connection fail：" . mysql_error());
}
mysql_select_db($database, $conn);
// mysql_query("set character set 'gbk'");
// mysql_query("set names 'gbk'");
if(!isset($_POST['submit'])){
	exit('visit !');
}
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('Invalid Unser Name! <a href="javascript:history.back(-1);">return</a>');
}
if(strlen($password) < 6){
	exit('Password Not long enough! <a href="javascript:history.back(-1);">return</a>');
}
if(!preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}./', $email)){
	exit('Invalid e-mail! <a href="javascript:history.back(-1);">return</a>');
}
?>
