<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Form</title>
</head>

<body>
    <div>
        Customer Name : <span><?= User::currentLoggedInUser()->name ?></span><br><br>
        Pharmacy Name : <span><?= $this->pharmName ?></span>
    </div>
    <form action="<?=SROOT?>PrefilledformHandler/addRawItem/<?= $this->pharmId?>/" method="post">
        <input type="text" name="item-name" placeholder="Enter Item Name">
        <input type="text" name="quantity" placeholder="Enter quantity">
        <input type="submit" value="Add">
    </form>
    <div>
        <table>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
            </tr>
            <?php if (isset($_SESSION['rawData']) && !empty($_SESSION['rawData'])) {
            foreach ($_SESSION['rawData'] as $key=>$value) { ?>
                <tr>
                    <td><?= $key?></td>
                    <td><?= $value?></td>
                </tr>
            
            <?php } }?>
        </table>
    </div>
    <div>
        <form action="<?=SROOT?>PrefilledformHandler/processItems/<?=$this->pharmId ?>" method="post">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>