<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <?php if(!isset($this->searchMode)){?>
    <div>
        <a href="<?=SROOT?>CustomerDashboard/selectSearch/selected"><h2>Select a Pharmacy</h2></a>
        <a href="<?=SROOT?>PrefilledformHandler/nearBy"><h2>Search in Nearby Pharmacies</h2></a>
        <a href="<?=SROOT?>CustomerDashboard/selectSearch/prescription"><h2>Upload a Prescription</h2></a>
    </div>
    <?php }
    if(isset($this->searchMode)){
        switch ($this->searchMode) {
            case 'selected':?>
                <div>
                    <form action="<?=SROOT?>CustomerDashboard/searchByPharmacy" method="post">
                        <input type="text" name="pharm-name" placeholder="Enter Pharmacy name">
                        <input type="submit" value="Search">
                    </form>  
                </div>
                <?php if(isset($this->result) && !empty($this->result)){?>
                <div>
                    <table>
                        <?php foreach($this->result as $row){?>
                            <tr>
                                <td><a href="<?=SROOT?>PrefilledformHandler/loadSearchForm/<?=$row->id?>"><?php echo $row->name . '   ' . $row->address?></a></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
                <?php }elseif(isset($this->processed)){echo "<h3>No result found</h3>";}?>
            <?php break;
            case 'nearby':?>
                <div>
                    <form action="<?=SROOT?>CustomerDashboard/searchByPharmacy" method="post">
                        <input type="text" name="pharm-name" placeholder="Enter Pharmacy name">
                        <input type="submit" value="Search">
                    </form>
                </div>
            <?php break;
            case 'prescription':?>
                <div>
                    <form action="<?=SROOT?>CustomerDashboard/searchByPharmacy" method="post">
                        <input type="text" name="pharm-name" placeholder="Enter Pharmacy name">
                        <input type="submit" value="Search">
                    </form>
                    
                </div>
            <?php break;
            default:
                break;
        }
    }?>

    <br><br><a href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>

</body>
</html>