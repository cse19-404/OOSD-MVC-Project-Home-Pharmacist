<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Prescriptions</title>
    <?php include_once('css/base.php'); ?>
</head>
<body>
    <div class="container-fluid">
    <h1 class = 'header'>Prescriptions</h1>
    <hr>
    <span>
        <?php if(isset($_SESSION['sentMsg'])){
            echo $_SESSION['sentMsg'];
            unset($_SESSION['sentMsg']);
        }?>
    </span>
    <?php if(isset($this->prescriptions) && !empty($this->prescriptions)){?>
        <div class="table-div">
        <table class="table">
            <tr>
                <th>Customer Name</th>
                <th>Prescription</th>
            </tr>
            <?php foreach($this->prescriptions as $key=>$entry) {?>
                <tr>
                    <td><?= $entry[0]->name?></td>
                    <td><a href="<?=SROOT?><?=$entry[1]->prescription?>" download='<?=$entry[1]->prescription?>'><?= ltrim($entry[1]->prescription,'uploads/prescriptions/')?></a></td>
                    <?php if(!$entry[1]->form_sent){?>
                    <td><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$entry[1]->pharmacy_id?>/notclear/<?=$key?>" role="button" class="btn btn-success">Prepare a form</a></td>
                    <?php }else { ?>
                        <td style="color :#346702;">Form sent </td>
                        <td><a href="<?=SROOT?>PrescriptionHandler/clear/<?= $key ?>" role="button" class="btn btn-danger">Remove</a></td>
                    <?php }?>

                </tr>
            <?php }?>
        </table>
        </div>
    <?php }else {
        echo "<h3>No prescriptions found</h3>";
    }?>

    <br><br><a href="<?=SROOT?>PharmacyDashboard" role="button" class="btn btn-primary">Go to Dashboard</a>
    </div>
</body>
</html>