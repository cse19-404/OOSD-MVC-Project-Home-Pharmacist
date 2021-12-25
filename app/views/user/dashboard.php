<?php
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'customer' || $_SESSION['role'] === 'super_admin'){
        echo "<h1>Hi " . User::currentLoggedInUser()->name . "</h1>";
    }else{
        echo "<h1>Hi " . Pharmacy::currentLoggedInPharmacy()->name . "</h1>";
    }
    
} else {
    echo "<h1> <a href='index.php'> Log in first </a> </h1>";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
<hr><br>
        <?php if ($_SESSION['role']==='super_admin') { ?>
        <a href="<?=SROOT?>ApplicationHandler/view"><h2>View Applications</h2></a>
        <a href="view_users.php"><h2>View Users</h2></a>
        <a href="approved_applications.php"><h2>Pharmacy Account Creation</h2></a>
        <?php } ?>
        <?php if ($_SESSION['role']==='pharmacy') { ?>
        <a href="inventory.php"><h2>View Inventory</h2></a><br>
        <?php } ?>
        <a href="<?=SROOT?>register/logout"><h2>Logout</h2></a><br><br>
        <h3><?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?></h3>
</body>

</html>