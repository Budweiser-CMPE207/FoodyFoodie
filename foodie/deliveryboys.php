<?php
include 'head.php';
?>
<h3><a href="deliveryboys.php">Delivery Boys</a></h3>
<button class="btn btn-success" style="margin-left: 10px" onclick="showDeliveryboysForm()">Add a delivery boy</button>

<form action="" method="get" class="form-inline" style="display: inline-block;margin-left: 10px">
    <input type="text" class="form-control" name="query" value="Jim">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<div id="addDeliveryboy" style="margin: 10px; display: none">
    <form action="deliveryboys_add.php" method="post" class="form" role="form" enctype="multipart/form-data">
        <input type="hidden" name="user" value="Tuo Lei" />
        <div class="form-group">
            <label for="name">Delivery Boy Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your  Name">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Input your phone number here like 1234567890">
        </div>
        <div class="form-group">
            <label for="zip_code">Zip Code</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Input zip code of the area you deliver orders">
        </div>
        <div class="form-group">
            <label for="address">Restaurant ID</label>
            <input type="text" class="form-control" id="restaurant_id" name="restaurant_id" value=0>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>

<?php
include 'db.php';

//connect to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL DB: " . mysqli_connect_error();
}

if(isset($_GET["query"])){
    $query = $_GET["query"];
    $result = mysqli_query($con, "SELECT * FROM DeliveryBoys WHERE name LIKE '%$query%'
      or zip_code LIKE '%$query%' or phone LIKE '%$query%' ORDER BY restaurant_id DESC");
}
else{
    $result = mysqli_query($con, "SELECT * FROM DeliveryBoys ORDER BY restaurant_id DESC;");
}


echo "<table class='table table-striped table-bordered' style='margin-top: 5px'>    
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Zip Code</th>
        <th>Restaurant ID</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['delivery_boy_id'] . "</td><td>"
        . $row['name'] . "</td><td>"
        . $row['phone'] . "</td><td>"
        . $row['zip_code'] . "</td><td>"
        . $row['restaurant_id'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
include "foot.php";
?>
