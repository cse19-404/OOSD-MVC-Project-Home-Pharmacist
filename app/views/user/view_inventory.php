
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <?php include_once('css/baseTable.php'); ?>
</head>

<body>
    <div class="container-fluid">
    <a href="<?=SROOT?>PharmacyDashboard" role="button" class="mybtn btn btn-primary">Go to Dashboard</a>
    <h1 class = 'header'>Inventory</h1>
    <hr>
    <?php if (isset($_SESSION['role']) && !strcmp($_SESSION['role'], 'pharmacy')) { ?>
        <div class="table-div">
            <table class="table">
                <thread>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Prescription Needed?</th>
                    <th>Quantity Unit</th>
                    <th>Quantity</th>
                    <th>Price per Unit Quantity(Rs.)</th>
                </thread>
                <?php
                if (isset($this->items) && !empty($this->items)){
                foreach($this->items as $row){
                    $row = (array)$row;
                    $pres = ($row['prescription_needed'] == 0) ? "No" : "Yes";
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["code"] . "</td>";
                    echo "<td>" . $pres . "</td>";
                    echo "<td>" . $row['quantity_unit'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['price_per_unit_quantity'] . "</td>";

                ?>
                    <td><a role='button' class="btn btn-info" href="<?=SROOT?>ItemHandler/viewItem/edit/<?=$row["id"]?>">Edit</a></td>
                    <td>
                        <form action="<?=SROOT?>ItemHandler/deleteItem/<?=$row["id"]?>" method="post">
                            <input type="submit" value="Remove item" class="btn btn-danger" role="button">
                        </form>
                    </td>
                    </tr>
                <?php }
                    } ?>

            </table>
        </div>
        <br><br>
        <form method="POST" action="<?=SROOT?>ItemHandler/viewItem/add">
            <input type="submit" name="Add" value="Add new Item" role='button' class="btn btn-success">
        </form>
        <br>
        <br>

    <?php } else {
        echo "<h1> <a href='index.php'> Log in first </a> </h1>";
    } ?>
    </div>
</body>

</html>