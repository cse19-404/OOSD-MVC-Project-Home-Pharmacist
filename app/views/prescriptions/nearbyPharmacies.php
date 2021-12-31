<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Near By Pharmacies</title>
</head>
<body>
    <table>
        <?php foreach($this->pharmacies as $pharmacy){ ?>
            <tr>
                <td><a href="<?=SROOT?>PrescriptionHandler/uploadPrescription/<?=$this->userId?>/<?= $pharmacy->id ?>"><?= $pharmacy->name."|".$pharmacy->address ?></a></td>
            </tr>
        <?php }?>
    </table>
</body>
</html>