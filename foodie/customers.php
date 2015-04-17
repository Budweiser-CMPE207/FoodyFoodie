<?php
include 'head.php';
?>
<h3><a href="customers.php">Customers</a></h3>
<button class="btn btn-success" style="margin-left: 10px" onclick="showCustomerForm()">Add a Customer</button>

<form action="" method="get" class="form-inline" style="display: inline-block;margin-left: 10px">
    <input type="text" class="form-control" name="query" value="Customer Name">
    <button type="submit" class="btn btn-primary">Search</button>
</form>
<div id="addCustomer" style="margin: 10px; display: none">
    <form action="customers_add.php" method="post" class="form" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Customer Name">
        </div>

        <div class="form-group">
            <label for="email">Customer Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
        </div>

        <div class="form-group">
            <label for="address">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Input your phone number here like 1234567890">
        </div>

        <div class="form-group">
            <label for="address">Membership</label>
            <input type="text" class="form-control" id="membership_id" name="membership_id">
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
    $result = mysqli_query($con, "SELECT * FROM Customers WHERE name LIKE '%$query%'
      or phone LIKE '%$query%' or membership_id LIKE '%$query%' ORDER BY customer_id DESC");
}
else{
    $result = mysqli_query($con, "SELECT * FROM Customers ORDER BY customer_id DESC;");
}


echo "<table class='table table-striped table-bordered' style='margin-top: 5px'><tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Membership</th>
      </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['customer_id'] . "</td><td>"
        . $row['name'] . "</td><td>"
        . $row['email'] . "</td><td>"
        . $row['phone'] . "</td><td>"
        . $row['membership_id'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);
include "foot.php";
?>
