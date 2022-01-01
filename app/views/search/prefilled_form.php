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
        Customer Name : <span><?php if(!isset(User::currentLoggedInUser()->name)){echo $this->customerName;}else{echo User::currentLoggedInUser()->name;}?></span><br><br>
        Pharmacy Name : <span><?=$this->pharmName?></span>
    </div>
    <div>
        <form action="<?=SROOT?>PrefilledformHandler/searchItem/<?=$this->pharmId?>/<?=$this->preId?>" method="POST">
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
                            <td><?php if(!$row->prescription_needed || $this->preId !=-1 ){?><form action="<?=SROOT?>PrefilledformHandler/addItem/<?=$row->id?>/<?=$this->pharmId?>/<?=$this->preId?>"><input type="submit" value='Add'></form><?php }else{?>Prescription Needed<?php }?></td>
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
            <?php if(isset($this->items)) {foreach($this->items as $row){if(key_exists($row->getId(), $_SESSION['tempItemId'])){?>
                <tr>
                    <td><?=$row->name."(".$row->quantity_unit.')'?></td>
                    <td><?=$row->price_per_unit_quantity?></td>
                    <?php if($_SESSION['tempItemId'][$row->getId()] > 0){$var = explode(",",$_SESSION['tempItemId'][$row->getId()]);}?>
                    <td><?php if($_SESSION['tempItemId'][$row->getId()] > 0 && $var[1] === 'Prescription Needed' && $this->preId ==-1){echo '-';}else{?><form action="<?=SROOT?>PrefilledformHandler/addQuantity/<?=$row->getId()?>/<?=$this->pharmId?>/<?=$this->preId?>" method="post"><input type="text" onchange='this.form.submit()' name='quantity' placeholder="_" value=<?php if($_SESSION['tempItemId'][$row->getId()]>0){echo $var[0];}?>></form><?php }?></td>
                    <td><?php if($_SESSION['tempItemId'][$row->getId()] > 0 ){
                        if ($var[1] !== 'Prescription Needed' || $this->preId !=-1){
                            echo $row->price_per_unit_quantity * $var[0];}else{echo '-';
                        }
                    }?></td>
                    <td><?php if($_SESSION['tempItemId'][$row->getId()] > 0){ echo $var[1];}else{echo '-';}?></td>
                    <td><form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId?>/<?=$row->getId()?>/<?=$this->preId?>" method="POST"><input type="submit" value="Remove"></form></td>
                </tr>
            <?php }}}?>
            <?php if(isset($_SESSION['tempItemId'])){foreach($_SESSION['tempItemId'] as $key=>$value){if(!is_numeric($key)){?>
                <tr>
                    <td><?=$key?></td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td><?=$value?></td>
                    <td><form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId?>/<?=$key?>/<?=$this->preId?>" method="POST"><input type="submit" value="Remove"></form></td>
                </tr>
            <?php }}}?>
        </table>
    </div>
    <?php if($this->pharmId==-1){?>
        <br><br><a href="<?=SROOT?>PrefilledformHandler/processItems/-1/-1/<?=$this->preId?>">Select Another Form</a>
    <?php }else {if($this->preId != -1){?>
        <br><br><a href="<?=SROOT?>PrefilledformHandler/sendPrefilledForm/<?=$this->preId?>">Send to Customer</a>
        <?php }?>
        <?php if(isset($_SESSION["isSeasonal"]) && $_SESSION["isSeasonal"]){?>
            <br><br><a href="<?=SROOT?>SeasonalOfferHandler/view">Go Back</a>
        <?php }else{?>
            <br><br><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$this->pharmId?>/notclear/<?=$this->preId?>">Go Back</a>
        <?php }?>
        
    <?php } ?>
</body>
</html>