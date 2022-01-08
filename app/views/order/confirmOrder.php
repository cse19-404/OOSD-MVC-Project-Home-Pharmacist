<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order</title>
</head>
<script>
    function orderDone(){
        alert('Your Order has been Placed..!');
    }
    function cancelOrder(){
        alert('Your Order has been Canceled..!');
    }
</script>

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
    

</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        <h1 class=header>Confirm Order</h1>
        <div class="Appcontainer">
            <div>
                <ul>
                    <li class="spacinglabels">Pharmacy Name : <?=$_SESSION['UserPharmacydetails']["PharmName"]?></li><br>
                    <li class="spacinglabels">Customer Name : <?=$_SESSION['UserPharmacydetails']["CustomerName"]?></li><br>
                    <li class="spacinglabels">Receiver Name : <?=$_SESSION['OrderDetails']['receiver_name']?></li><br>
                    <li class="spacinglabels">Address : <?=$_SESSION['OrderDetails']['address']?></li><br>
                    <li class="spacinglabels">Mobile Number : <?=$_SESSION['OrderDetails']['mobile_number']?></li><br>
                </ul><br>
            </div>
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
                    }else {
                        echo '<h2> No items in the order </h2>';
                    }?>
                </table>
                <br>
                <?php if ($_SESSION['OrderDetails']['prescription'] !== NULL){?>
                    <label for="prescription">Prescription: </label>
                    <a href="<?=SROOT?><?=$_SESSION['OrderDetails']['prescription']?>" download='<?=$_SESSION['OrderDetails']['prescription']?>'>
                        <?= ltrim($_SESSION['OrderDetails']['prescription'],'uploads/prescriptions/')?>
                    </a>
                <?php }?>
                    <br><label class="badge rounded-pill bg-secondary" for="total">Total Price : Rs. <?=$_SESSION['OrderDetails']['total']." /="?></label><br><br>

                
                
                <br><br><a role="button" class="btn btn-success" onclick='orderDone()' href="<?=SROOT?>OrderHandler/confirmOrder">Confirm Order</a>
                <a role="button" class="btn btn-danger" onclick='cancelOrder()' href="<?=SROOT?>OrderHandler/cancelOrder">Cancel Order</a>
        </div>
    </div>
</body>
</html>