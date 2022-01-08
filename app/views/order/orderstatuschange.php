<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .bg-danger {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 10%;
        width: 35%;
        margin: auto;
        margin-top: 1cm;
        padding: 30px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
      }

    .spacinglabels{
        margin-bottom: 5px;
    }

    ul{
        list-style-type: circle;
    }
    
    .badge{
        border-top-width: 10px;
        border-top-style: solid;
        border-left-style: solid;
        border-left-width: 10px;
        border-right-width: 10px;
        border-right-style: solid;
        border-bottom-width: 10px;
        border-bottom-style: solid;
        border-color: #777;
    }

    .dropdown{
        padding: 6px;
        border-radius: 5px;
        margin: 7px;
        border: hidden;
    }
    .dropdown select option{
        padding: 15px;
    }




</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        <h1 class=header>View Order</h1>
        <div class="Appcontainer">
            <div>
                <ul>
                    <?php if(isset(User::currentLoggedInUser()->id)){?><li class="spacinglabels">Pharmacy Name : <?=$this->pharmacyName?></li><?php }?>
                    <li class="spacinglabels">Customer Name : <?=$this->customerName?></li>
                    <li class="spacinglabels">Receiver Name : <?=$this->order->receiver_name?></li>
                    <li class="spacinglabels">Address : <?=$this->order->address?></li>
                    <li class="spacinglabels">Mobile Number : <?=$this->order->mobile_number?></li>
                </ul>
                <br>
                
                <table class="table">
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price(Rs.)</th>
                    </tr>
                    <?php if (isset($this->items) && !empty($this->items)) {
                        for ($i=0; $i < $this->count; $i++) { ?>
                            <tr>
                                <td><?=$this->items[$i]->name . '(' . $this->items[$i]->quantity_unit . ')'?></td>
                                <td><?=$this->quantities[$i] ?> </td>
                                <td><?=$this->unit_prices[$i] * $this->quantities[$i] ?></td>
                                <td>
                                    <?php if($this->items[$i]->prescription_needed){ ?>
                                        <td>Prescription Needed</td>
                                    <?php }?>
                                </td>
                            </tr>
                    <?php } 
                    }else {?>
                        <span class="bg-danger"> No items in the order </span>
                    <?php }?>
                </table>
                <br>    
                <?php if ($this->order->prescription != ""){?>
                    <label for="prescription">Download Prescription :  </label>
                    <a href="<?=SROOT?><?=$this->order->prescription?>" download='<?=$this->order->prescription?>'>
                        <?= ltrim($this->order->prescription,'uploads/prescriptions/')?>
                    </a>
                <?php }?>
                <br><br>
                <label class="badge rounded-pill bg-secondary" for="total">Total Price : <?=$this->order->total?></label><br><br>
                <?php if(!isset(User::currentLoggedInUser()->id)){
                    if($this->order->status === 'new'){?><br><br><a href="<?=SROOT?>OrderHandler/updateStatus/<?=$this->order->id?>/seen">Accept Order</a><?php }else{?>
                        <form action="<?=SROOT?>OrderHandler/updateStatus/<?=$this->order->id?>" method="post">
                            <label>Update status :  </label>
                            
                            <select class="dropdown btn-primary" name="status" id="status">
                                <option value="new">New</option>
                                <option value="preparing">Preparing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                            </select>
                            
                            
                            <input class="btn btn-danger" type="submit" name="submit" value="Change Status">
                        </form>
                <?php }?>
            </div>
        </div>
                <br><br><a role="button" class="btn btn-success" href="<?=SROOT?>OrderHandler/view">Go back</a>
                <?php }else{?>
                <?php $_SESSION['isHistory'] = 1?>
                <form action="<?=SROOT?>OrderHandler/order/-1/1/<?= $this->order->id?>/history" method='POST'><input class="btn btn-info" type="submit" value="Re Order"></form>
                <br><br><a role="button" class="btn btn-success" href="<?=SROOT?>CustomerDashboard/viewPurchaseHistory">Go back</a>
            <?php }?>

        
    </div>
    
</body>
</html>