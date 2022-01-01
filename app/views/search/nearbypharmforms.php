<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NearBy Pharmacy Forms</title>
</head>
<body>
    <div>
        <?php if (isset($this->availabilty) && !empty($this->availabilty)) {?>
        <table>
            <?php foreach($this->availabilty as $entry=>$value) { ?>
            <tr>
            <td><a href="<?=SROOT?>PrefilledformHandler/processItems/<?=$entry?>/-1/<?=$this->preId?>"><?=$this->pharm_map[$entry]?></a></td>
            <td><?= $value[0].' out of '. count($this->items) . "Items available"?></td>
            <!-- <td><?= 'Total Price: '.$_SESSION['TotalPrice']?></td> -->
            </tr>
            <?php }?>
        </table>
        <?php }else{
        if(isset($this->items)){
            $count = count($this->items);
        }else {
            $count = 0;
        }
        echo "All Pharmacies Found 0 out of ".$count;}?>

    </div>
    <br><br><a href="<?=SROOT?>CustomerDashboard/search">Go Back</a>
</body>
</html>