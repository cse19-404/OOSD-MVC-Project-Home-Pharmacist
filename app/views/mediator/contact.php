<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Portral</title>
</head>
<body>

    <?php if(!isset($this->mode)){?>
        <div>
            <a href="<?=SROOT?>MediatorHandler/inbox"><h2>Inbox</h2>
        </div>
        <div>
            <?php if ($_SESSION['role']==='super_admin') { ?>
                <div>
                    <a href="<?=SROOT?>CustomerDashboard/selectContact/customer"><h2>Contact a Customer</h2>
                </div>
            <?php } ?>  

            <?php if (!($_SESSION['role']==='pharmacy')) { ?>
                <div>
                    <a href="<?=SROOT?>CustomerDashboard/selectContact/pharmacy"><h2>Contact a Pharmacy</h2>
                </div>
            <?php } ?>
            
            <?php if (!($_SESSION['role']==='super_admin')) { ?>
                <div>
                <a href="<?=SROOT?>CustomerDashboard/selectContact/us"><h2>Contact Us</h2>
                </div>
            <?php } ?>  

        </div>
    <?php }
    if(isset($this->mode)){
        if ($this->mode === 'pharmacy' && !($_SESSION['role']==='pharmacy')) {?>
            <div>
                <form action="<?=SROOT?>CustomerDashboard/searchPharmacy" method="post">
                    <input type="text" name="pharm-name" placeholder="Enter Pharmacy name">
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
        <a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
    <?php }else{?>
        <a href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
    <?php } ?>

</body>
</html>