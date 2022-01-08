<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Pharmacy Applications</title>
    <?php include_once('css/baseTable.php'); ?>
</head>

<body>

    <div class='container-fluid'>
        <a class="mybtn btn btn-default" role="button" href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
        <h1 class='header'>Approved Applications<hr></h1>
        <?php if(isset($_SESSION['role']) && !strcmp($_SESSION['role'],'super_admin')) { ?>
            <?php if (is_array($this->approvedApplications) && count($this->approvedApplications) > 0) { ?>
            <div class="table-div">
            <table class='table'>
                <thread>
                    <th>Email</th>
                    <th>Pharmacy Name</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Delivery Supported</th>
                    <th>Files</th>
                    <th></th>
                </thread>
                <?php

                foreach ($this->approvedApplications as $row) {
                    $row = (array) $row;
                    echo "<tr>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["pharmacy_name"] . "</td>";
                    echo "<td> Location: " . $row['latitude'] . "," . $row['longitude'] . "</td>";
                    echo "<td>".$row['address']."</td>";
                    echo "<td>".$row['contact_no']."</td>";
                    if ($row['delivery_supported']) {
                        echo "<td>" . "Yes" . "</td>";
                    } else {
                        echo "<td>" . "No" . "</td>";
                    }
                    echo "<td> <a href=" . $row['documents'] . " download>" . basename($row['documents']) . "</a>";
                ?>
                    <td><a class="btn btn-info" role="button" href=<?php echo SROOT."UserHandler/pharmAccCreat/".$row['id'];?>>Create Account</a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <?php }
        }
        else {
            echo "<h1> <a href='index.php'> Log in first </a> </h1>";
        }?>
        <br>
    </div>
</body>

</html>