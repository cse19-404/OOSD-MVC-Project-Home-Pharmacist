<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Order Details</title>
</head>
<body>
    <div>
        <?php
        if($this->change!="change"){
            $title="Default Order Details";
            $readonly="readonly";
            $submitBtn="Use Default Details";
        }else{
            $title="Change Order Details";
            $readonly="";
            $submitBtn="Save Details";
        }

        $this->User = new User();
        $this->User->findById($_SESSION['UserPharmacydetails']['UserId']);
        ?>

        <span><?= $title ?></span><br><br>

        <form action='<?=SROOT?>OrderHandler/order/<?=$this->preId?>/<?php if($submitBtn === "Save Details" || $submitBtn === "Use Default Details"){echo 0;}else{echo 1;}?>/0' method='post' > 
            <label for="receiver_name">Receiver's Name : </label><input name="receiver_name" type="text" value="<?= $this->User->name?>" <?= $readonly?> ><br>
            <br>
            <label for="address">Address : </label><input name="address" type="text" value="<?= $this->User->address?>" <?= $readonly?> ><br>
            <br>
            <label for="mobile_number">Receiver's Contact Number : </label><input name="mobile_number" type="text" value="<?= $this->User->mobile_number?>" <?= $readonly?> >
            <br><br>
            <input type="submit" value="<?= $submitBtn?>" >
            <br><br>
        </form>
    </div>
    <div>
        
        <?php if($this->change !== 'change'){?>
            <form action="<?=SROOT?>OrderHandler/order/<?=$this->preId?>/1/0/change" method="POST"><input type="submit" value="Use Different Details"></form>
        <?php }?>
        
    </div>
</body>
</html>