<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>View Prescriptions</title>
    <?php include_once('css/baseTable.php'); ?>
</head>
<style>
    .alert-success{
        margin-right: 1220px;
    }
    .alert-dismissible .btn-close{
        margin-top: 5.5px;
    }
</style>
<body>
    <div class="container-fluid">
    <br><br><a href="<?=SROOT?>PharmacyDashboard" role="button" class="mybtn btn btn-primary">Go to Dashboard</a>

    <h1 class = 'header'>Prescriptions</h1>
    <hr>
    <?php if(isset($_SESSION['sentMsg'])){?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>
                <?php 
                    echo $_SESSION['sentMsg'];
                    unset($_SESSION['sentMsg']);
                ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }?>
    <?php if(isset($this->prescriptions) && !empty($this->prescriptions)){?>
        <div class="table-div">
        <table class="table">
            <tr>
                <th>Customer Name</th>
                <th>Prescription</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach($this->prescriptions as $key=>$entry) {?>
                <tr>
                    <td><?= $entry[0]->name?></td>
                    <td><a href="<?=SROOT?><?=$entry[1]->prescription?>" download='<?=$entry[1]->prescription?>'><?= ltrim($entry[1]->prescription,'uploads/prescriptions/')?></a></td>
                    <?php if(!$entry[1]->form_sent){?>
                    <td><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$entry[1]->pharmacy_id?>/notclear/<?=$key?>" role="button" class="btn btn-success">Prepare a form</a></td>
                    <td></td>
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

    </div>
</body>
</html>