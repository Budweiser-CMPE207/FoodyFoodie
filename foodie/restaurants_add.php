<?php
$name = $_POST["name"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$description = $_POST["description"];
$sales_tax_rate = $_POST["sales_tax_rate"];
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
$query = "INSERT INTO Restaurants (name, address,phone, description, sales_tax_rate)
     VALUES ('$name', '$address', '$phone','$description','$sales_tax_rate');";
mysqli_query($con,$query);
mysqli_close($con);

//redirect
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'restaurants.php';

header("Location: http://$host$uri/$extra");
exit;
