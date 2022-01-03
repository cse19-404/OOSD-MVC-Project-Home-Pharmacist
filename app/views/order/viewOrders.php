<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
</head>
<body>
    <div>
        <?php $statuses = ['All','new', 'preparing', 'shipped','delivered'] ?>
        <form action='<?=SROOT?><?php if(isset(Pharmacy::currentLoggedInPharmacy()->id)){echo 'OrderHandler/view';}else{echo 'CustomerDashboard/viewPurchaseHistory';}?>' method='post'>
            <label for="filter">Filter by Status</label>
            <select name='filter-status' onchange='this.form.submit()'>
                <?php
                for ($i = 0; $i < count($statuses); $i++) {
                    if ($statuses[$i] ===$this->filter) {
                        echo "<option value =" . $statuses[$i] . " selected= 'selected'>" . ucwords($statuses[$i]) . "</option>";
                    } else {
                        echo "<option value=" . $statuses[$i] . ">" . ucwords($statuses[$i]) . "</option>";
                    }
                }
                ?>
            </select>
        </form>
    </div>
    <div>
        <br>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Status</th>
            </tr>
            <?php if (isset($this->results) && !empty($this->results)) {
                foreach ($this->results as $key => $value) { ?>
                    <tr>
                        <td> <a href="<?=SROOT?>OrderHandler/viewOrder/<?=$key?>"> <?= $value[0]->name ?> </a> </td>
                        <td><?= $value[1]->status ?> </td>
                        <?php if(isset(Pharmacy::currentLoggedInPharmacy()->id)){?>
                            <td><a href="<?=SROOT?>OrderHandler/closeOrder/<?=$key?>">Close Order</a></td>
                        <?php }else{?>
                            <?php if($value[1]->status === 'delivered'){?>
                            <td><a href="<?=SROOT?>OrderHandler/deleteHistory/<?=$key?>">Delete Entry</a></td>
                        <?php }}?>    
                    </tr>
            <?php } 
            }else {
                echo '<h2> No Orders </h2>';
            }?>
        </table>
        <br><br><a href="<?=SROOT?><?php if(isset(Pharmacy::currentLoggedInPharmacy()->id)){echo 'PharmacyDashboard';}else{echo 'CustomerDashboard';}?>">Go to dashboard</a>
    </div>
    
</body>
</html>