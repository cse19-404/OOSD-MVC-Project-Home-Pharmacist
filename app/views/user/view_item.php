<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <h2>Inventory Item Form</h2>
    <form method="post" action="<?=SROOT?>ItemHandler/<?=$this->mode?>Item/<?=($this->mode ==='edit')?$this->itemData['id']:''?>">

        Item Name: <input type="text" name="name" value="<?=$this->itemData['name']?>" required>
        <span class="error">* </span>
        <br><br>
        Item Code: <input type="text" name="code" value="<?=$this->itemData['code']?>" required>
        <span class="error">*</span>
        <br><br>
        Prescription Needed?: <input type="checkbox" name="prescription_needed" <?php if ($this->itemData['prescription_needed'] == 1) {
                                                                                echo "checked";
                                                                            } ?>>
        <span class="error"></span>
        <br><br>
        Quantity Unit: <input type="text" name="quantity_unit" value="<?=$this->itemData['quantity_unit']?>" required>
        <span class="error">*</span>
        <br><br>
        Quantity: <input type="text" name="quantity" value="<?=$this->itemData['quantity']?>" required>
        <br><br>
        Price per Unit Quantity(Rs.): <input type="text" name="price_per_unit_quantity" value="<?=$this->itemData['price_per_unit_quantity']?>" required>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <br><br><a href="inventory.php">Go to inventory</a>
</body>

</html>