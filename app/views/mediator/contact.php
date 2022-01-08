<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Portral</title>
    <style>
        ul{
        margin:0;
        padding:0;
        list-style:none;
        }
        .padding-lg {
            display: block;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .our-webcoderskull .cnt-block:hover {
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            border: 0;
        }

        .our-webcoderskull .cnt-block{ 
        float:left; 
        width:100%; 
        background:#fff; 
        padding:30px 20px; 
        text-align:center; 
        border:2px solid #d5d5d5;
        margin: 0 0 28px;
        }
        .our-webcoderskull .cnt-block figure{
        width:148px; 
        height:148px; 
        border-radius:100%; 
        display:inline-block;
        margin-bottom: 15px;
        }
        .our-webcoderskull .cnt-block img{ 
        width:148px; 
        height:148px; 
        border-radius:100%; 
        }
        .our-webcoderskull .cnt-block h3{ 
        color:#2a2a2a; 
        font-size:20px; 
        font-weight:500; 
        padding:6px 0;
        text-transform:uppercase;
        }
        .our-webcoderskull .cnt-block h3 a{
        text-decoration:none;
            color:#2a2a2a;
        }
        .our-webcoderskull .cnt-block h3 a:hover{
            color:#337ab7;
        }
        .our-webcoderskull .cnt-block p{ 
        color:#2a2a2a; 
        font-size:13px; 
        line-height:20px; 
        font-weight:400;
        }
        .row{
        margin-top: 100px;
    }
        .padding-lg{
            margin-left: 150px;
            margin-right: -150px;
        }
    </style>

    <?php include_once('css/base.php'); ?>
</head>
<body>
<div class='container-fluid'>
    <?php if(!isset($this->mode)){?>
        <section class="our-webcoderskull padding-lg">
    <div class="container">
        <ul class="row">
        <li class="col-12 col-md-6 col-lg-3">
            <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>MediatorHandler/inbox';">
                <figure><img src="https://potentiainstitute.com/wp-content/uploads/2020/07/Email-Icon.png" class="img-responsive" alt=""></figure>
                <h3><a href="<?=SROOT?>MediatorHandler/inbox">Inbox</a></h3>
            </div>
        </li>
        <?php if ($_SESSION['role']==='super_admin') { ?>
        <li class="col-12 col-md-6 col-lg-3">
            
                    <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>CustomerDashboard/selectContact/customer';">
                    <figure><img src="https://www.jing.fm/clipimg/detail/63-634224_profile-clipart-end-user-customer-blue-icon-png.png" class="img-responsive" alt=""></figure>
                    <h3><a href="<?=SROOT?>CustomerDashboard/selectContact/customer">Contact a Customer</a></h3>
                    </div>
            
        </li>
        <?php } ?>  
        <?php if (!($_SESSION['role']==='pharmacy')) { ?>
        <li class="col-12 col-md-6 col-lg-3">
            
                    <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>CustomerDashboard/selectContact/pharmacy';">
                    <figure><img src="https://cdn-icons-png.flaticon.com/512/230/230194.png" class="img-responsive" alt=""></figure>
                    <h3><a href="<?=SROOT?>CustomerDashboard/selectContact/pharmacy">Contact a Pharmacy</a></h3>
                    </div>
            
        </li>
        <?php } ?> 
        <?php if (!($_SESSION['role']==='super_admin')) { ?> 
        <li class="col-12 col-md-6 col-lg-3">
            
                    <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>CustomerDashboard/selectContact/us';">
                    <figure><img src="https://media.istockphoto.com/illustrations/contact-us-glassy-cyan-blue-round-button-illustration-id816810182?b=1&k=6&m=816810182&s=612x612&w=0&h=NOD9Od-3efEsGCnSk4_mbWrQesoVmKvAgKMR2-54Xxo=" class="img-responsive" alt=""></figure>
                    <h3><a href="<?=SROOT?>CustomerDashboard/selectContact/us">Contact Us</a></h3>
                    </div>
             
        </li>
        <?php } ?> 
        </ul>
    </div>
    </section>       


    <?php }if(isset($this->mode)){
        if ($this->mode === 'pharmacy' && !($_SESSION['role']==='pharmacy')) {?>
            <div>
                <form action="<?=SROOT?>CustomerDashboard/searchPharmacy" method="post">
                    <input type="text" name="pharm-name" placeholder="Enter Pharmacy name" required>
                    <input type="submit" value="Search">
                </form>  
            </div>
            <?php if(isset($this->result) && !empty($this->result)){?>
                <div>
                    <table>
                        <?php foreach($this->result as $row){?>
                            <tr>
                                <td><a href="<?=SROOT?>CustomerDashboard/loadMailForm/pharmacy/<?=$row->id?>"><?php echo $row->name . '   ' . $row->address?></a></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
            <?php }elseif(isset($this->processed)){
                echo "<h3>No result found</h3>";
            }
        }

        if ($this->mode === 'customer' && ($_SESSION['role']==='super_admin')) {?>
            <div>
                <form action="<?=SROOT?>CustomerDashboard/searchCustomer" method="post">
                    <input type="text" name="name" placeholder="Enter Customer name">
                    <input type="submit" value="Search">
                </form>  
            </div>
            <?php if(isset($this->result) && !empty($this->result)){?>
                <div>
                    <table>
                        <?php foreach($this->result as $row){?>
                            <tr>
                                <td><a href="<?=SROOT?>CustomerDashboard/loadMailForm/customer/<?=$row->id?>"><?php echo $row->name . '   ' . $row->address?></a></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
            <?php }elseif(isset($this->processed)){
                echo "<h3>No result found</h3>";
                }
        }
    }?>

    <?php if ($_SESSION['role']==='pharmacy') {?>
        <a href="<?=SROOT?>PharmacyDashboard" role="button" class="btn btn-primary">Go to Dashboard</a>
    <?php }else{?>
        <a href="<?=SROOT?>CustomerDashboard" role="button" class="btn btn-primary">Go to Dashboard</a>
    <?php } ?>
    </div>

</body>
</html>