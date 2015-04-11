<?php
include 'head.php';
?>
<h3><a href="restaurants.php">Restaurants</a></h3>
<button class="btn btn-success" style="margin-left: 10px" onclick="showRestaurantForm()">Add a Restaurant</button>

<form action="" method="get" class="form-inline" style="display: inline-block;margin-left: 10px">
    <input type="text" class="form-control" name="query" value="KFC">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<div id="addRestaurant" style="margin: 10px; display: none">
    <form action="restaurants_add.php" method="post" class="form" role="form" enctype="multipart/form-data">
        <input type="hidden" name="user" value="Tuo Lei" />
        <div class="form-group">
            <label for="name">Restaurant Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Restaurant Name">
        </div>
        <div class="form-group">
            <label for="address">Restaurant Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Location">
        </div>
        <div class="form-group">
            <label for="address">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Input your phone number here like 1234567890">
        </div>
        <div class="form-group">
            <label for="address">Description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="address">Tax Rate</label>
            <input type="text" class="form-control" id="sales_tax_rate" name="sales_tax_rate" value=0>
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
    $result = mysqli_query($con, "SELECT * FROM Restaurants WHERE name LIKE '%$query%'
      or address LIKE '%$query%' or description LIKE '%$query%' ORDER BY restaurant_id DESC");
}
else{
    $result = mysqli_query($con, "SELECT * FROM Restaurants ORDER BY restaurant_id DESC;");
}


echo "<table class='table table-striped table-bordered' style='margin-top: 5px'><tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Description</th>
        <th>Tax</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['restaurant_id'] . "</td><td>"
        ."<a href='items.php?restaurant_id=".$row['restaurant_id']."'>". $row['name'] . "</a></td><td>"
        . $row['address'] . "</td><td>"
        . $row['phone'] . "</td><td>"
        . $row['description'] . "</td><td>"
        . $row['sales_tax_rate'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
include "foot.php";
?>
