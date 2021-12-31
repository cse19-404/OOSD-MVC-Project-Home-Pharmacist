<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefilled Form</title>
</head>
<body>
    <div>
        Customer Name : <span><?=User::currentLoggedInUser()->name?></span><br><br>
        Pharmacy Name : <span><?=$this->pharmName?></span>
    </div>
    <div>
        <form action="<?=SROOT?>PrefilledformHandler/searchItem/<?=$this->pharmId?>" method="POST">
            <input type="text" placeholder="Enter an Item Name" name="item-name" required>
            <input type="submit" value="Search">
        </form>
        <?php if(isset($this->result) && !empty($this->result)){?>
            <div>
                <table>
                    <?php foreach($this->result as $row){?>
                        <tr>
                            <td><?php echo $row->name."(".$row->quantity_unit.")"?></td>
                            <td><?php echo "Rs " . $row->price_per_unit_quantity?></td>
                            <td><?php if(!$row->prescription_needed){?><form action="<?=SROOT?>PrefilledformHandler/addItem/<?=$row->id?>/<?=$this->pharmId?>"><input type="submit" value='Add'></form><?php }else{?>Prescription Needed<?php }?></td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        <?php }elseif(isset($this->processed)){echo "<h3>No result found</h3>";}?>
    </div>
    <div>
        <table>
            <tr>
                <th>Item Name</th>
                <th>Price per unit quantity</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
            <tr>
                <?php if(isset($this->items)) {foreach($this->items as $row){?>
                    <tr>
                        <td><?=$row->name."(".$row->quantity_unit.')'?></td>
                        <td><?=$row->price_per_unit_quantity?></td>
                        <?php if($_SESSION['tempItemId'][$row->getId()] > 0){$var = explode(",",$_SESSION['tempItemId'][$row->getId()]);}?>
                        <td><form action="<?=SROOT?>PrefilledformHandler/addQuantity/<?=$row->getId()?>/<?=$this->pharmId?>" method="post"><input type="text" onchange='this.form.submit()' name='quantity' placeholder="_" value=<?php if($_SESSION['tempItemId'][$row->getId()]>0){echo $var[0];}?>></form></td>
                        <td><?php if($_SESSION['tempItemId'][$row->getId()] > 0){ echo $row->price_per_unit_quantity * $var[0];}else{echo '-';}?></td>
                        <td><?php if($_SESSION['tempItemId'][$row->getId()] > 0){ echo $var[1];}else{echo '-';}?></td>
                    </tr>
                <?php }}?>
            </tr>
        </table>
    </div>
    <?php if($this->pharmId==-1){?>
        <br><br><a href="<?=SROOT?>PrefilledformHandler/processItems/-1">Select Another Form</a>
    <?php }else {?>
        <br><br><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$this->pharmId?>">Go Back</a>
    <?php } ?>
</body>
</html>