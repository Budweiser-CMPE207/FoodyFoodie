<?php
include 'db.php';

//connect to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
}

// TODO should using session
$cur_customer_id = 1;

$orders = mysqli_query($con, "SELECT * FROM Orders, Restaurants
  WHERE customer_id=$cur_customer_id and Orders.restaurant_id = Restaurants.restaurant_id
  ORDER BY created_at DESC;");

include 'head.php';
?>
<h3><a href="restaurants.php">Restaurants</a></h3>

<?php
while ($order = mysqli_fetch_array($orders)){
  echo "<h4>".$order['created_at']." | ".$order['name']." | Before Tax and Discount: ".$order['raw_price']
          ." | Total: ".$order['real_price']."</h4>";

  echo "<table class='table table-striped table-bordered' style='margin-top: 5px'><tr>
          <th>Item ID</th>
          <th>Item Name</th>
          <th>Category</th>
          <th>Single Price</th>
          <th>Quantity</th>
          <th>Total Price</th>
        </tr>";
  $cur_order_id = $order['order_id'];
  $details = mysqli_query($con, "SELECT * FROM Order_Item, Items
    WHERE order_id=$cur_order_id and Order_Item.item_id = Items.item_id;");

  while ($row = mysqli_fetch_array($details)) {
      echo "<tr>";
      echo "<td>" . $row['item_id'] . "</td><td>"
          . $row['name'] . "</td><td>"
          . $row['category'] . "</td><td>"
          . $row['price'] . "</td><td>"
          . $row['qty'] . "</td><td>"
          . $row['qty']*$row['price'] . "</td>";
      echo "</tr>";
  }
  echo "</table><hr/>";
}


mysqli_close($con);
include "foot.php";
?>
