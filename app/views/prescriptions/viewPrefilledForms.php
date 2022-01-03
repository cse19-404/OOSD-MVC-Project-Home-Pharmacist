<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefilled Forms</title>
</head>
<body>
    <table>
        <tr>
            <th>Recieved Date</th>
            <th>Pharmacy Name</th>
            <th>Prescription</th>
            <th>Status</th>
        </tr>
        <?php if(isset($this->prefilledForms)){foreach($this->prefilledForms as $id=>$form){?>
            <tr>
                <td><?=$form->sent_date?></td>
                <td><?=$this->data[$id]?></td>
                <td><a href="<?=SROOT?><?=$form->prescription?>" download='<?=$form->prescription?>'>
                <?= ltrim($form->prescription, 'uploads/prescriptions/')?>
            </a></td>
                <td><?=$form->no_of_items . " out of " . $form->no_of_all_item . " Items Availale"?></td>
                <td><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$id?>">View Form</a></td>
            </tr>
        <?php }}?>
    </table>
    <br><br><a href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
</body>
</html>