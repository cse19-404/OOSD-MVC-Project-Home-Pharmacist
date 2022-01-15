<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
</head>
<style>
    .bg-danger {
        color: #FF0000;
    }

    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height:15%;
        width: 13cm;
        margin: auto;
        margin-top: 2cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }

    

</style>
<?php include_once('css/baseForm.php'); ?>
<body>
<div class='container-fluid'>
        <?php if(isset($_SESSION["isPrescription"]) && $_SESSION["isPrescription"]){?>
            <a class="mybtn btn btn-primary" role = "button" href="<?=SROOT?>PrescriptionHandler/view">Go Back</a>
        <?php } elseif(isset($_SESSION["isSeasonal"]) && $_SESSION["isSeasonal"]){?>
            <a class="mybtn btn btn-primary" role = "button" href="<?=SROOT?>SeasonalOfferHandler/view">Go Back</a>
        <?php } else if(isset($_SESSION['orderfromPharm'])) { ?>
            <a class="mybtn btn btn-primary" role = "button" href="<?=SROOT?>PharmacyDashboard/searchCustomer">Go Back</a>
        <?php } else{?>
            <a class="mybtn btn btn-primary" role = "button" href="<?=SROOT?>CustomerDashboard/search">Go Back</a>
        <?php }?>
    <h1 class="header">Item Search Form</h1>
    <div class="Appcontainer">
        <div>            
            Customer Name : <span><?php if(!isset(User::currentLoggedInUser()->name)){echo $this->customerName;}
            else if(isset($_SESSION['orderfromPharm'])){
                echo $_SESSION['orderfromPharm'][0];
            }
            else{echo User::currentLoggedInUser()->name;}?></span><br><br>
            Pharmacy Name : <span><?= $this->pharmName ?></span><br><br>
        </div>
        <form action="<?=SROOT?>PrefilledformHandler/addRawItem/<?= $this->pharmId?>/<?= $this->preId?>" method="post">
            <div class="col-auto">
                <input class="form-control-plaintext" type="text" name="item-name" placeholder="Enter Item Name" required>
                <input class="form-control-plaintext" type="text" name="quantity" placeholder="Enter quantity" required>
                <input class="btn btn-danger" type="submit" value="Add">
            </div>
        </form>
        <div>
            <table class='table'>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
                <?php if (isset($_SESSION['rawData']) && !empty($_SESSION['rawData'])) {
                foreach ($_SESSION['rawData'] as $key=>$value) { ?>
                    <tr>
                        <td><?= $key?></td>
                        <td><?= $value?></td>
                    </tr>
                
                <?php } }?>
            </table>
        </div>
        <div>
            <form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId ?>/-1/<?=$this->preId?>" method="post">
                <br><br><input class="btn btn-success" type="submit" value="Submit">
            </form>
        </div>
        <form action="<?=SROOT?>PrefilledformHandler/<?php if($this->pharmId == -1)
            {echo 'nearBy';} 
            else {echo 'loadSearchForm/'.$this->pharmId ;}  ?>/clear/<?=$this->preId?>" method="post">
            <br><input class="btn btn-warning" type="submit" value="Clear Items">
        </form>
        </div>
    
</div>
</body>

</html>