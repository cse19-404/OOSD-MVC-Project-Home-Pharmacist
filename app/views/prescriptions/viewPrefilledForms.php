<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefilled Forms</title>
    <?php include_once('css/baseTable.php'); ?>

</head>
<body>
    <div class="container-fluid">
    <br><br><a role="button" class="mybtn btn btn-primary" href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
    <h1 class = 'header'>Forms from Prescriptions</Section></h1>
    <hr>
    <div class="table-div">
    <table class="table">
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
                <td><?php if($form->prescription != NULL) {?><a href="<?=SROOT?><?=$form->prescription?>" download='<?=$form->prescription?>'>
                <?= ltrim($form->prescription, 'uploads/prescriptions/')?><?php }else{echo '-';}?>
            </a></td>
                <td style="color :#337ab7;"><?=$form->no_of_items . " out of " . $form->no_of_all_item . " Items Availale"?></td>
                <td><a  role="button" class="btn btn-success" href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$id?>">View Form</a></td>
            </tr>
        <?php }}?>
    </table>
    </div>
    </div>
</body>
</html>