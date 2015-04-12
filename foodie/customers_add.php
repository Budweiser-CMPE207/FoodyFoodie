<?php
$customer_id = $_POST["customer_id"]
$name = $_POST["name"];
$password = $_POST["password"]
$email =$_POST["email"];
$phone = $_POST["phone"];
$membership_id = $_POST["membership_id"];

//TODO: Insert some validation here
if($name=='' || $phone==''){
  echo "Wrong input!";
  exit;
}
include 'db.php';

//connect to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
    exit;
}
$query = "INSERT INTO Customers (customer_id, name, email, password, phone, membership_id)
     VALUES ('$customer_id', '$name', '$password', '$email', '$phone','$membership_id');";
mysqli_query($con,$query);
mysqli_close($con);

//redirect
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'customers.php';

header("Location: http://$host$uri/$extra");
exit;
