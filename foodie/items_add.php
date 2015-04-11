<?php
$name = $_POST["name"];
$price = $_POST["price"];
$category = $_POST["category"];
$restaurant_id = $_POST["restaurant_id"];
//TODO: Insert some validation here
if($name=='' || $price < 0){
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
$query = "INSERT INTO Items (name, price, category, restaurant_id)
     VALUES ('$name', '$price','$category','$restaurant_id');";
mysqli_query($con,$query);
mysqli_close($con);

//redirect
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'items.php?restaurant_id='.$restaurant_id;

header("Location: http://$host$uri/$extra");
exit;
