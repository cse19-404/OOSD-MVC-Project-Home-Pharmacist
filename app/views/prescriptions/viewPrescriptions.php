<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Prescriptions</title>
</head>
<body>
    <?php if(isset($this->prescriptions) && !empty($this->prescriptions)){?>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Prescription</th>
            </tr>
            <?php foreach($this->prescriptions as $entry) {?>
                <tr>
                    <td><?= $entry[0]->name?></td>
                    <td><a href="<?=SROOT?><?=$entry[1]->prescription?>" download='<?=$entry[1]->prescription?>'><?= ltrim($entry[1]->prescription,'uploads/prescriptions/')?></a></td>
                    <td><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$entry[1]->pharmacy_id?>">Prepare a form</a></td>
                </tr>
            <?php }?>
        </table>
    <?php }else {
        echo "<h3>No prescriptions found</h3>";
    }?>
</body>
</html>