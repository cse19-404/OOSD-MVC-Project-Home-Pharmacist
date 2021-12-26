
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>

<body>
    <h1>Inventory</h1>
    <hr>
    <br>
    <?php if (isset($_SESSION['role']) && !strcmp($_SESSION['role'], 'pharmacy')) { ?>
        <div class="table-div">
            <table class='table'>
                <thread>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Prescription Needed?</th>
                    <th>Quantity Unit</th>
                    <th>Quantity</th>
                    <th>Price per Unit Quantity(Rs.)</th>
                </thread>
                <?php

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
                    <td><a href="<?=SROOT?>ItemHandler/viewItem/edit/<?=$row["id"]?>">Edit</a></td>
                    <td>
                        <form action="<?=SROOT?>ItemHandler/deleteItem/<?=$row["id"]?>" method="post">
                            <input type="submit" value="Remove item">
                        </form>
                    </td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <br><br>
        <form method="POST" action="<?=SROOT?>ItemHandler/viewItem/add">
            <input type="submit" name="Add" value="Add new Item">
        </form>
        <br>
        <br>
        <a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>

    <?php } else {
        echo "<h1> <a href='index.php'> Log in first </a> </h1>";
    } ?>
</body>

</html>