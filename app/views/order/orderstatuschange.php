<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Status</title>
</head>
<body>
    <div>
        <label for="customer-name">Customer Name : <?=$this->customerName?></label><br>
        <label for="customer-name">Receiver Name : <?=$this->order->receiver_name?></label><br>
        <label for="customer-name">Address : <?=$this->order->address?></label><br>
        <label for="mobile_number">Mobile Number : <?=$this->order->mobile_number?></label><br><br>
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
        <?php if ($this->order->prescription != ""){?>
            <label for="prescription">Prescription: </label>
            <a href="<?=SROOT?><?=$this->order->prescription?>" download='<?=$this->order->prescription?>'>
                <?= ltrim($this->order->prescription,'uploads/prescriptions/')?>
            </a>
        <?php }?>
        <br><label for="total">Total Price : <?=$this->order->total?></label><br><br>
        
        <form action="<?=SROOT?>OrderHandler/updateStatus/<?=$this->order->id?>" method="post">
            <label>Update status</label>
            <select name="status" id="status">
                <option value="new">New</option>
                <option value="preparing">Preparing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
            </select>
            <input type="submit" name="submit" value="Change Status">
        </form>

    </div>
    <br><br><a href="<?=SROOT?>OrderHandler/view">Go back</a>
</body>
</html>