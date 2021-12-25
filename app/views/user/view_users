<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
    <?php if(isset($_SESSION['role']) && !strcmp($_SESSION['role'],'super_admin')) { ?>
    <h2>Customer Details<hr></h2>
    
    <?php if (count($this->$results_customers)> 0) { ?>
    <div class="table-div">
        <table class="table">
            <thead>
                <th>Username</th>
                <th>Name</th>
                <th>NIC</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Location</th>
            </thead>
            <?php 
            
            foreach ($this->results_customers as $row) {
                $row = (array) $row;
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["nic"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["mobile_number"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td> Location: " . $row['latitude'] . "," . $row['longitude'] . "</td>";
            }
            ?>
        </table>
    </div>
    <?php }
    else {
        echo "<h3>No Users to display</h3>";
    }?>

    <h2>Pharmacy Details<hr></h2>
    
    <?php if (count($this->$results_pharmacies) > 0) { ?>
    <div class="table-div">
        <table class="table">
            <thead>
                <th>Username</th>
                <th>Pharmacy Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Location</th>
                <th>Delivery Supported</th>
            </thead>
            <?php 
            
            foreach ($this->results_pharmacies as $row) {
                $row = (array) $row;
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["contact_number"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td> Location: " . $row['latitude'] . "," . $row['longitude'] . "</td>";
                if ($row['delivery_supported']){
                    echo "<td>" . "Yes" . "</td>";
                } else {
                    echo "<td>" . "No" . "</td>";
                }
            }
            
            ?>
        </table>
    </div>
    <?php }
    else {
        echo "<h3>No Pharmarcies to display</h3>";
    }?>
    <?php }
    else {
        echo "<h1> <a href='login.php'> Log in first </a> </h1>";
    }
    ?>
</body>
</html>