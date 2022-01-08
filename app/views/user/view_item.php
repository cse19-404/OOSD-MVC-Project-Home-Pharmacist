<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <style>
        .bg-danger {
            color: #FF0000;
        }

        .Appcontainer {
            z-index: 2;
            border-radius: 15px;
            background-color: #e9e9e9ed;
            height: 15%;
            width: 40%;
            margin: auto;
            margin-top: 2cm;
            padding: 30px;
            padding-left: 30px;
            padding-right: 30px;
            box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
        }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>

<body>
    <div class='container-fluid'>
    <br><br><a  class="mybtn btn btn-primary" role="button" href="<?= SROOT ?>ItemHandler/view">Go to inventory</a>
        <h2 class="header">Inventory Item Form</h2>
        <div class="Appcontainer">
            <div class='bg-danger'>
                <?php if (isset($this->displayErrors)) {
                    echo $this->displayErrors;
                } ?>
            </div>
            <form class="form-horizontal" method="post" action="<?= SROOT ?>ItemHandler/save/<?= $this->mode ?>/<?= ($this->mode === 'edit') ? $this->itemData['id'] : '' ?>">

                <label> Item Name:</label> <input class="form-control" type="text" name="name" value="<?= $this->itemData['name'] ?>" required>
                <br>
                <label>Item Code:</label> <input class="form-control" type="text" name="code" value="<?= $this->itemData['code'] ?>" required>
                <br>
                <label>Prescription Needed? :</label><input type="checkbox" name="prescription_needed" <?php if ($this->itemData['prescription_needed'] == 1) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                <br><br>
                <label>Quantity Unit:</label> <input class="form-control" type="text" name="quantity_unit" value="<?= $this->itemData['quantity_unit'] ?>" required>
                <br>
                <label>Quantity:</label> <input class="form-control" type="text" name="quantity" value="<?= $this->itemData['quantity'] ?>" required>
                <br>
                <label>Price per Unit Quantity(Rs.):</label> <input class="form-control" type="text" name="price_per_unit_quantity" value="<?= $this->itemData['price_per_unit_quantity'] ?>" required>
                <br>
                <input class="btn btn-success" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>


</body>

</html>