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
    <?php include_once('css/base.php'); ?>

    <style>
        section {
            padding-top: 4rem;
            padding-bottom: 5rem;
            background-color: #f1f4fa;
        }
        .wrap {
            display: flex;
            background: white;
            padding: 1rem 1rem 1rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 7px 7px 30px -5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .wrap:hover {
            background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);
            color: white;
        }

        .mbr-iconfont {
            font-size: 4.5rem !important;
            color: #313131;
            margin: 1rem;
            padding-right: 1rem;
        }
        .vcenter {
            margin: auto;
        }

        .mbr-section-title3 {
            text-align: left;
        }
        h2 {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .display-5 {
            font-family: 'Source Sans Pro',sans-serif;
            font-size: 1.4rem;
        }
        .mbr-bold {
            font-weight: 700;
        }

        p {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            line-height: 25px;
        }
        .display-6 {
            font-family: 'Source Sans Pro',sans-serif;
            font-size: 1re}
    </style>

</head>

<body>
<hr><br>

<section>
    <div class="container">
        <?php if ($_SESSION['role']==='super_admin') { ?>
            <div class="row mbr-justify-content-center">
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap" onclick="location.href='<?=SROOT?>ApplicationHandler/view';">
                    <div class="text-wrap vcenter">
                        <p class="mbr-fonts-style text1 mbr-text display-6"><h2>New Applications</h2></p>  
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
            <div class="col-lg-6 mbr-col-md-10">
                <div class="wrap" onclick="location.href='<?=SROOT?>UserHandler/view';">
                    <div class="text-wrap vcenter">
                        <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Users</h2></p>  
                    </div>
                </div>
            </div>         
            
            
        <?php } ?>

</section>
    <div>


            <?php if ($_SESSION['role']==='customer') { ?>
            <a href="<?=SROOT?>CustomerDashboard/search"><h2>Search</h2></a>
            <a href="<?=SROOT?>PrefilledformHandler/viewForms/prescription"><h2>Forms from Prescriptions</h2></a>
            <a href="<?=SROOT?>PrefilledformHandler/viewForms"><h2>Forms from Pharmacies</h2></a>
            <a href="<?=SROOT?>SeasonalOfferHandler/view"><h2>Seasonal Offers</h2></a>
            <a href="<?=SROOT?>CustomerDashboard/viewPurchaseHistory"><h2>Purchase Hisorty</h2></a>
            <a href="<?=SROOT?>CustomerDashboard/message"><h2>Message Potral</h2></a><br>
            <a href="<?=SROOT?>UserHandler/changedetails/customer"><h2>Change Account Details</h2></a><br>
            <?php } ?>  

            <?php if ($_SESSION['role']==='pharmacy') { ?>
            <a href="<?=SROOT?>ItemHandler/view"><h2>Inventory</h2></a><br>
            <a href="<?=SROOT?>OrderHandler/view"><h2>Orders</h2></a><br>
            <a href="<?=SROOT?>PrescriptionHandler/view"><h2>Uploaded Prescriptions</h2></a><br>
            <a href="<?=SROOT?>SeasonalOfferHandler/view"><h2>Seasonal Offers</h2></a><br>
            <a href="<?=SROOT?>PharmacyDashboard/searchCustomer"><h2>Order for a customer</h2></a><br>
            <a href="<?=SROOT?>CustomerDashboard/message"><h2>Message Potral</h2></a><br>
            <a href="<?=SROOT?>UserHandler/changedetails/pharmacy"><h2>Change Account Details</h2></a><br>
            <?php } ?>
            
            <a href="<?=SROOT?>register/logout"><h2>Logout</h2></a><br><br>
            <h3><?php if(isset($_GET['msg'])){echo $_GET['msg'];} ?></h3>
    </div>
    </div>
</body>

</html>