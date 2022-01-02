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
        ?>

        <span><?= $title ?></span><br><br>

        <form action='<?=SROOT?>OrderHandler/order/' method='post' > 
            <label for="reciever_name">Reciever's Name : </label><input name="reciever_name" type="text" value="<?= User::currentLoggedInUser()->name?>" <?= $readonly?> ><br>
            <br>
            <label for="address">Address : </label><input name="address" type="text" value="<?=User::currentLoggedInUser()->address?>" <?= $readonly?> ><br>
            <br>
            <label for="mobile_number">Reciever's Contact Number : </label><input name="mobile_number" type="text" value="<?=User::currentLoggedInUser()->mobile_number?>" <?= $readonly?> >
            <br><br>
            <input type="submit" value="<?= $submitBtn?>" >
            <br><br>
        </form>
    </div>
    <div>
        
        <?php if($this->change !== 'change'){?>
            <button onclick="location.href='<?=SROOT?>OrderHandler/loadOrderDetails/<?= $this->$preId?>/change';">Use Different Details</button>
        <?php }?>
        
    </div>
</body>
</html>