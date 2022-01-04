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
<body>
    <div>
        <label for="pharm-name">Pharmacy Name : <?=$_SESSION['UserPharmacydetails']["PharmName"]?></label><br> 
        <label for="customer-name">Customer Name : <?=$_SESSION['UserPharmacydetails']["CustomerName"]?></label><br>
        <label for="customer-name">Receiver Name : <?=$_SESSION['OrderDetails']['receiver_name']?></label><br>
        <label for="customer-name">Address : <?=$_SESSION['OrderDetails']['address']?></label><br>
        <label for="mobile_number">Mobile Number : <?=$_SESSION['OrderDetails']['mobile_number']?></label><br><br>
    </div>
    <table>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
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
            <br><label for="total">Total Price : <?=$_SESSION['OrderDetails']['total']?></label><br><br>

        
        
        <br><br><a onclick='orderDone()' href="<?=SROOT?>OrderHandler/confirmOrder">Confirm Order</a>
        <br><br><a onclick='cancelOrder()' href="<?=SROOT?>OrderHandler/cancelOrder">Cancel Order</a>
</body>
</html>