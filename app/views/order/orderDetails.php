<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Order Details</title>
</head>

<style>
    .bg-danger {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 10%;
        width: 30%;
        margin: auto;
        margin-top: 1cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
      }

    #Home{
        display:inline;
    }
</style>
<?php include_once('css/baseForm.php'); ?>

<body>
    <div class='container-fluid'>
        
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

        <h1 class="header"><?= $title ?></h1><br><br>

        <div class="Appcontainer">
            <form action='<?=SROOT?>OrderHandler/order/<?=$this->preId?>/<?php if($submitBtn === "Save Details" || $submitBtn === "Use Default Details"){echo 0;}else{echo 1;}?>/0' method='post' > 
            
                <label for="receiver_name">Receiver's Name : </label><input class="form-control" name="receiver_name" type="text" value="<?= $this->User->name?>" <?= $readonly?> required><br>
                <br>
                <label for="address">Address : </label><input class="form-control" name="address" type="text" value="<?= $this->User->address?>" <?= $readonly?> required><br>
                <br>
                <label for="mobile_number">Receiver's Contact Number : </label><input class="form-control" name="mobile_number" type="text" value="<?= $this->User->mobile_number?>" <?= $readonly?> required>
                <br><br>
                <input class="btn btn-success" type="submit" value="<?= $submitBtn?>" >
                <br><br>
            </form>
            
            <div>
                
                <?php if($this->change !== 'change'){?>
                    <form action="<?=SROOT?>OrderHandler/order/<?=$this->preId?>/1/0/change" method="POST"><input class="btn btn-danger" type="submit" value="Use Different Details"></form>
                <?php }?>
                
            </div>
        </div>
    </div>
</body>
</html>