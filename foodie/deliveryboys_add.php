<?php
$name = $_POST["name"];
$phone = $_POST["phone"];
$zip_code = $_POST["zip_code"];
$restaurant_id = $_POST["restaurant_id"];
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
$query = "INSERT INTO DeliveryBoys (name, phone, zip_code, restaurant_id)
     VALUES ('$name', '$phone', '$zip_code','$restaurant_id');";
mysqli_query($con,$query);
mysqli_close($con);

//redirect
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'deliveryboys.php';

header("Location: http://$host$uri/$extra");
exit;
