<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/kebabStyle.css">
    <?php include_once('css/base.php'); ?>

    <style>
        section {
            padding-top: 4rem;
            padding-bottom: 5rem;
            background-color: rgba(226, 226, 226, 0.687);
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
            cursor: pointer;
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

        .navSettings{
        position: fixed;
        z-index: 3;
        }
        .clc{
            width: 20px;
        }
        .keb {
            width: 20px;
            height: 3px;
            background-color: black;
            margin: 4px 0;
        }

    </style>

</head>

<body>
    <header style="padding-left: 20px;">
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
    </header>

    <ul class="navSettings">
            <div class="kebabSettings">
                <div class='clc'>
                    <div class="keb"></div>
                    <div class="middle keb"></div>
                    <div class="keb"></div>
                    
                </div>
                <ul class="dropdownSettings">
                    <li class="SettingsListItem" name="changePasswords"><a class="SettingsListItem" href="<?=SROOT?>UserHandler/changedetails/<?php if($_SESSION['role'] === 'customer' || $_SESSION['role'] === 'super_admin'){echo 'customer';}else{echo 'pharmacy';}?>">Change Details</a></li>
                    <li class="SettingsListItem" name="logout"><a href="<?=SROOT?>register/logout" class="SettingsListItem">Log Out</a></li>
                </ul>
            </div>
        </ul>
        <div class = "bg kebabHide"></div>
        <script>
            var kebab = document.querySelector('.kebabSettings'),
            middle = document.querySelector('.clc'),
            cross = document.querySelector('.cross'),
            bg = document.querySelector('.bg'),
            header1 = document.querySelector('.Header1'),
            istog = false;
            dropdown = document.querySelector('.dropdownSettings');

            function tog(value){
                if(value){
                    value = false;
                }else{
                    value = true;
                }
                return value;
            }

            kebab.addEventListener('click', function() {
                istog = tog(istog);
                if(istog){
                    bg.classList.remove('kebabHide');
                }
                middle.classList.toggle('active');
                dropdown.classList.toggle('active');
                if(!istog){
                    bg.classList.add('kebabHide');
                }
                
            })
            bg.addEventListener('click', function(){
                if(istog){
                    middle.classList.toggle('active');
                    dropdown.classList.toggle('active');
                    bg.classList.add('kebabHide');
                    istog = false;
                }
            })
            header1.addEventListener('click', function(){
                if(istog){
                    middle.classList.toggle('active');
                    dropdown.classList.toggle('active');
                    istog = false;
                }
            })
        </script>
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
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>UserHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Users</h2></p>  
                        </div>
                    </div>
                </div>
            </div>   
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>ApplicationHandler/viewApproved';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Pharmacy Account Creation</h2></p>  
                        </div>
                    </div>
                </div> 
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>CustomerDashboard/message';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Message Potral</h2></p>  
                        </div>
                    </div>
                </div>     
            </div>
            
        <?php } ?>

        <?php if ($_SESSION['role']==='customer') { ?>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>CustomerDashboard/search';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Search</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>PrefilledformHandler/viewForms/prescription';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Forms from Prescriptions</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>PrefilledformHandler/viewForms';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Forms from Pharmacies</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>SeasonalOfferHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Seasonal Offers</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>CustomerDashboard/viewPurchaseHistory';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Purchase Hisorty</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>CustomerDashboard/message';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Message Potral</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($_SESSION['role']==='pharmacy') { ?>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>ItemHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Inventory</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>OrderHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Orders</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>PrescriptionHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Uploaded Prescriptions</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>SeasonalOfferHandler/view';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Seasonal Offers</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>PharmacyDashboard/searchCustomer';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Order for a customer</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>CustomerDashboard/message';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Message Potral</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</section>
</body>

</html>