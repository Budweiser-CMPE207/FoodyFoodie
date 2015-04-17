<?php
include 'db.php';

//connect to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
}

// TODO should using session
$cur_customer_id = 1;

$data = json_decode(file_get_contents('php://input'), true);
$orders = $data['orders'];

$delivery = $data['delivery'];
$address = $delivery['address'];
$phone = $delivery['phone'];
$delivery_boy_id = $delivery['delivery_boy_id'];

$restaurant_id = $data['restaurant_id'];

//GET info for cur restaurant
$restaurant_query = "SELECT sales_tax_rate FROM Restaurants WHERE restaurant_id=$restaurant_id";
$result = mysqli_query($con, $restaurant_query);
$row = mysqli_fetch_assoc($result);
$tax_rate = $row['sales_tax_rate'];


// Create an Order
$add_order_query = "INSERT INTO Orders (customer_id, restaurant_id)
     VALUES ('$cur_customer_id', '$restaurant_id');";

mysqli_query($con,$add_order_query);
$cur_order_id = mysqli_insert_id($con);

$add_delivery_query = "INSERT INTO Deliveries (delivery_id, address, phone, delivery_boy_id, status)
     VALUES ('$cur_order_id', '$address', '$phone', '$delivery_boy_id', 'assigned');";
mysqli_query($con,$add_delivery_query);

// Create each Order_Item
foreach($orders as $key => $value){
  $item_id = $value['item_id'];
  $qty = $value['qty'];

  $add_order_item_query = "INSERT INTO Order_Item (order_id, item_id, qty)
       VALUES ('$cur_order_id', '$item_id', '$qty');";

  mysqli_query($con,$add_order_item_query);
}

// Update total row price and after tax discount price
// TODO discount not handled
$order_items = mysqli_query($con, "SELECT * FROM Order_Item, Items
  WHERE order_id=$cur_order_id and Order_Item.item_id = Items.item_id;");

$raw_price = 0;

while ($row = mysqli_fetch_array($order_items)) {
    $raw_price = $raw_price + ($row['price'] * $row['qty']);
}
$real_price = $raw_price * (1 + $tax_rate);

$update_query = "UPDATE Orders SET raw_price = $raw_price, real_price=$real_price
  WHERE order_id=$cur_order_id";

mysqli_query($con,$update_query);

mysqli_close($con);

//redirect
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'orders.php';

header("Location: http://$host$uri/$extra");
exit;
?>
