<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefilled Form</title>
</head>
<script>
    function deliveryCheck(delivery, proceed){  
        if(delivery == 0){
            alert("Sorry! This Pharmacy Doesn\'t Support Delivery");          
        }else if(delivery != 0 && !proceed){
            alert("Add 1 or more valied Items to Proceed..!");
        }
    }
    function sendCheck(empty){
        if(empty == 1){
            alert("Add Items Before Send...!");
        }
    }
</script>

<style>
    .bg-danger {
        color: #FF0000;
    }

    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height:15%;
        width: 45%;
        margin: auto;
        margin-top: 2cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }

    .btn-margin{
        margin-left: 0.3cm;
    }

</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        <h1 class="header">Prefilled Form</h1>
        <div class="Appcontainer">
            <div>
                <?php
                $_SESSION['UserPharmacydetails'] =[];
                if(isset($_SESSION['orderfromPharm'])){
                    $_SESSION['UserPharmacydetails']["UserId"]=$_SESSION['orderfromPharm'][1];
                }
                else{
                    $_SESSION['UserPharmacydetails']["UserId"]=User::currentLoggedInUser()->id;
                }
                $_SESSION['UserPharmacydetails']["PharmId"]=$this->pharmId;
                $this->pharmacy = new Pharmacy();
                $this->pharmacy->findById($this->pharmId);
                $_SESSION['UserPharmacydetails']["CustomerName"]= (!isset(User::currentLoggedInUser()->name))? $this->customerName : ((isset($_SESSION['orderfromPharm']))? $_SESSION['orderfromPharm'][0] : User::currentLoggedInUser()->name);?>     
                Customer Name : <span><?= $_SESSION['UserPharmacydetails']["CustomerName"]?></span><br><br>
                Pharmacy Name : <span><?=$this->pharmName?></span><br><br>
                <?php $_SESSION['UserPharmacydetails']["PharmName"]=$this->pharmName;?>
            </div>
            <div>
                <form action="<?=SROOT?>PrefilledformHandler/searchItem/<?=$this->pharmId?>/<?=$this->preId?>" method="POST">
                    <input class="form-control-plaintext" type="text" placeholder="Enter an Item Name" name="item-name" required>
                    <input class="btn btn-info" name="btn-margin" type="submit" value="Search"><br><br>
                </form>
                <?php if(isset($this->result) && !empty($this->result)){?>
                    <div>
                        <table class='table'>
                            <?php foreach($this->result as $row){?>
                                <tr>
                                    <td><?php echo $row->name."(".$row->quantity_unit.")"?></td>
                                    <td><?php echo "Rs " . $row->price_per_unit_quantity?></td>
                                    <td><?php if(!$row->prescription_needed || ($this->preId !=-1 && User::currentLoggedInUser()->id === Null)){?><form action="<?=SROOT?>PrefilledformHandler/addItem/<?=$row->id?>/<?=$this->pharmId?>/<?=$this->preId?>"><div class="btn-margin"><input class="btn btn-light" type="submit" value='Add'></div></form><?php }else{?>Prescription Needed<?php }?></td>
                                </tr>
                            <?php }?>
                        </table>
                        <br><br>
                    </div>
                <?php }elseif(isset($this->processed)){echo "<span>No result found!</span>";}?>
            </div>
            <div>
                <br><br>
                <table class = 'table'>
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
                            <?php $var = explode(",",$_SESSION['tempItemId'][$row->getId()]);?>
                            <td><?php if($var[1] === 'Prescription Needed' && $this->preId ==-1){echo '-';}else{?><form action="<?=SROOT?>PrefilledformHandler/addQuantity/<?=$row->getId()?>/<?=$this->pharmId?>/<?=$this->preId?>" method="post"><input type="text" onchange='this.form.submit()' name='quantity' placeholder='0' value=<?php if(is_numeric($var[0])){echo $var[0];}?>></form><?php }?></td>
                            <td><?php if(1){
                                if (is_numeric($var[0]) && ($var[1] !== 'Prescription Needed' || $this->preId !=-1)){
                                    echo $row->price_per_unit_quantity * $var[0];}else{echo '-';
                                }
                            }?></td>
                            <td><?php if(1){ echo $var[1];}else{echo '-';}?></td>
                            <td><form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId?>/<?=$row->getId()?>/<?=$this->preId?>" method="POST"><input class="btn btn-danger" type="submit" value="Remove"></form></td>
                        </tr>
                    <?php }}}?>
                    <?php if(isset($_SESSION['tempItemId'])){foreach($_SESSION['tempItemId'] as $key=>$value){if(!is_numeric($key)){?>
                        <tr>
                            <td><?=$key?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><?=$value?></td>
                            <td><form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId?>/<?=$key?>/<?=$this->preId?>" method="POST"><input  class="btn btn-danger" type="submit" value="Remove"></form></td>
                        </tr>
                    <?php }}}?>
                </table>
                <br><br><span class="badge rounded-pill bg-secondary">Total Price : Rs. <?php if(isset($_SESSION['TotalPrice'])){echo $_SESSION['TotalPrice'];}else{echo 0;}?></span>
            </div>
            <?php if(User::currentLoggedInUser()->id !== Null || isset($_SESSION['orderfromPharm'])){?>
                <br><br>
                <a role="button" class="btn btn-success" onclick='deliveryCheck(<?= $this->pharmacy->delivery_supported?>,<?=(isset($_SESSION["TotalPrice"]) && $_SESSION["TotalPrice"]>0)?>)' href=<?php if($this->pharmacy->delivery_supported && (isset($_SESSION["TotalPrice"]) && $_SESSION["TotalPrice"]>0)){
                echo (SROOT.'OrderHandler/order/'.$this->preId.'/1/0');
                }else{
                    echo "";
                }?> >Proceed to Order</a>  
            <?php }?>
        </div>
        <?php if(isset($_SESSION['isNearBy']) && $_SESSION['isNearBy']){?>
            <br><br><a role="button" class="btn btn-primary" href="<?=SROOT?>PrefilledformHandler/processItems/-1/-1/<?=$this->preId?>">Select Another Form</a>
        <?php }elseif(User::currentLoggedInUser()->id === Null){?>
            <br><br><a role="button" class="btn btn-primary" onclick="sendCheck(<?=!isset($_SESSION['tempItemId'])?>)" href="<?php if(isset($_SESSION['tempItemId'])){
                echo SROOT . "PrefilledformHandler/sendPrefilledForm/" . $this->preId;
                }else{ echo '';}?>">Send to Customer</a>
            <br><br><a role="button" class="btn btn-primary" href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$this->pharmId?>/notClear/<?=$this->preId?>">Go Back</a>
        <?php }elseif($this->preId != -1){?>
            <br><br><a role="button" class="btn btn-primary" href="<?=SROOT?><?php if(isset($_SESSION['isHistory'])){echo 'CustomerDashboard/viewPurchaseHistory';}else{if(isset($_SESSION['isPres'])){echo 'PrefilledformHandler/viewForms/prescription';}else{echo 'PrefilledformHandler/viewForms';}}?>">Go Back</a>
        <?php }else{?>
            <br><br><a role="button" class="btn btn-primary" href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$this->pharmId?>/notClear">Go Back</a>
        <?php }?>
    </div>
</body>
</html>