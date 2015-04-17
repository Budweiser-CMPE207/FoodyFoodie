<?php
if(!isset($_GET["restaurant_id"])){
  //redirect
  $host  = $_SERVER['HTTP_HOST'];
  $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'restaurants.php';

  header("Location: http://$host$uri/$extra");
  exit;
}

include 'db.php';

//connect to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
}

$restaurant_id = $_GET["restaurant_id"];
$cur = mysqli_fetch_array(mysqli_query($con, "SELECT name FROM Restaurants WHERE restaurant_id=$restaurant_id;"));
$cur_name = $cur['name'];

if(isset($_GET["query"])){
    $query = $_GET["query"];
    $result = mysqli_query($con, "SELECT * FROM Items WHERE restaurant_id=$restaurant_id
      and name LIKE '%$query%'
      or price LIKE '%$query%' or category LIKE '%$query%' ORDER BY item_id DESC");
}
else{
    $result = mysqli_query($con, "SELECT * FROM Items
      WHERE restaurant_id=$restaurant_id ORDER BY item_id DESC;");
}
$boys = mysqli_query($con, "SELECT * FROM DeliveryBoys;");

include 'head.php';
?>
<h3><a href="restaurants.php">Restaurants</a>->
  <a href="items.php?restaurant_id=<?=$restaurant_id ?>"><?=$cur_name ?>(<?=$restaurant_id ?>)</a></h3>
<button class="btn btn-success" style="margin-left: 10px" onclick="showItemForm()">Add an Item</button>

<form action="items.php" method="get" class="form-inline" style="display: inline-block;margin-left: 10px">
    <input type="text" class="form-control" name="query" value="drink">
    <input type="hidden" class="form-control" name="restaurant_id" value=<?=$restaurant_id ?>>
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<div id="addItem" style="margin: 10px; display: none">
    <form action="items_add.php" method="post" class="form" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Item Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Entry Name">
        </div>
        <div class="form-group">
            <label for="price">Item Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Price of Item">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="entry">
        </div>
        <input type="hidden" class="form-control" id="restaurant_id" name="restaurant_id" value="<?=$restaurant_id ?>">

        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>

<?php
echo "<table class='table table-striped table-bordered' style='margin-top: 5px'><tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Buy</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['item_id'] . "</td><td>"
        . $row['name'] . "</a></td><td>"
        . $row['price'] . "</td><td>"
        . $row['category'] . "</td>";
    echo "<td><input class='buy' data-item_id=".$row['item_id']." data-name="
      .$row['name']." data-price=".$row['price']
      ." type='number' name='qty' min='0' max='10' value=0 onchange=getOrderRequest()></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

<div id="cart" style="display:none">
  <h3>Shopping Cart</h3>
  <table id="cartTable" class='table table-striped table-bordered'>
  </table>

  <span id="cartFoot"></span>
  <div class="form-group">
      <label for="name">Address</label>
      <input type="text" class="form-control" id="address" name="address" placeholder="Your Address">
  </div>
  <div class="form-group">
      <label for="name">Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone">
  </div>
  <select id="zip_code" name="zip_code">
    <?php
      while($row = mysqli_fetch_array($boys)) {
        $delivery_boy_id = $row['delivery_boy_id'];
        $name = $row['name'];
        $zip_code = $row['zip_code'];
        echo "<option value='$delivery_boy_id'>$name:$zip_code</option>";
      }
    ?>

  </select>
  <button class="btn btn-success" style="margin-left: 10px" onclick="placeOrder()">Buy It</button>
</div>

<?php
include "foot.php";
?>
