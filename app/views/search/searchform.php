<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
</head>

<body>
    <div>
        Customer Name : <span><?php if(!isset(User::currentLoggedInUser()->name)){echo $this->customerName;}else{echo User::currentLoggedInUser()->name;}?></span><br><br>
        Pharmacy Name : <span><?= $this->pharmName ?></span>
    </div>
    <form action="<?=SROOT?>PrefilledformHandler/addRawItem/<?= $this->pharmId?>/<?= $this->preId?>" method="post">
        <input type="text" name="item-name" placeholder="Enter Item Name" required>
        <input type="text" name="quantity" placeholder="Enter quantity" required>
        <input type="submit" value="Add">
    </form>
    <div>
        <table>
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
            <br><br><input type="submit" value="Submit">
        </form>
    </div>
    <form action="<?=SROOT?>PrefilledformHandler/<?php if($this->pharmId == -1)
        {echo 'nearBy';} 
        else {echo 'loadSearchForm/'.$this->pharmId ;}  ?>/clear/<?=$this->preId?>" method="post">
        <br><br><input type="submit" value="Clear Items">
    </form>
    <?php if(isset($_SESSION["isPrescription"]) && $_SESSION["isPrescription"]){?>
        <br><br><a href="<?=SROOT?>PrescriptionHandler/view">Go Back</a>
    <?php } else{?>
        <br><br><a href="<?=SROOT?>CustomerDashboard/search">Go Back</a>
    <?php }?>
</body>

</html>