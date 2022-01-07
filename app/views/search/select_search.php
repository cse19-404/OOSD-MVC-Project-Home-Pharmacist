<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<style>
    .bg-danger {
        color: #FF0000;
    }

    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height:15%;
        width: 13cm;
        margin: auto;
        margin-top: 2cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }

    .search-btn-div{
        margin-top: 0.3cm;
    }

    
    .results-table{
        margin-top: 1cm;
    }


</style>
<?php include_once('css/baseForm.php'); ?>

<body>
    <div class='container-fluid'>
        <?php if (!isset($this->searchMode)) { ?>
            <div>
                <a href="<?= SROOT ?>CustomerDashboard/selectSearch/selected">
                    <h2>Select a Pharmacy</h2>
                </a>
                <a href="<?= SROOT ?>PrefilledformHandler/nearBy">
                    <h2>Search in Nearby Pharmacies</h2>
                </a>
                <a href="<?= SROOT ?>PrescriptionHandler/selectMethod">
                    <h2>Upload a Prescription</h2>
                </a>
            </div>
            <?php }
        if (isset($this->searchMode)) {
            switch ($this->searchMode) {
                case 'selected': ?>
                <h2 class ="header">Search Pharmacy</h2>
                <div class="Appcontainer">
                    
                    <div>
                        <form action="<?= SROOT ?>CustomerDashboard/searchByPharmacy" method="post">
                            <input class="form-control" type="text" name="pharm-name" placeholder="Enter Pharmacy name" required>
                            <div class="search-btn-div"><input class="btn btn-info" type="submit" value="Search"></div>
                        </form>
                    </div>
                    <?php if (isset($this->result) && !empty($this->result)) { ?>
                        <div class="results-table">
                            <table>
                                <?php foreach ($this->result as $row) { ?>
                                    <tr>
                                        <td><a class="btn btn-light" role="button" href="<?= SROOT ?>PrefilledformHandler/loadSearchForm/<?= $row->id ?>"><?php echo $row->name . '   ' . $row->address ?></a></td>
                                    </tr>
                                    
                                <?php } ?>
                            </table>
                        </div>
                    <?php } elseif (isset($this->processed)) {
                        echo "<h3>No result found</h3>";
                    } ?>
                </div>
                    
                <?php break;
                case 'prescription': ?>
                <h2 class ="header">Search Pharmacy</h2>
                    <div class="Appcontainer">
                        <form action="<?= SROOT ?>CustomerDashboard/searchByPharmacy/prescription" method="post">
                            <input class="form-control" type="text" name="pharm-name" placeholder="Enter Pharmacy name" required>
                            <div class="search-btn-div"><input class="btn btn-info" type="submit" value="Search"></div>
                        </form>

                    
                    <?php if (isset($this->result) && !empty($this->result)) { ?>
                        <div class="results-table">
                            <table>
                                <?php foreach ($this->result as $row) { ?>
                                    <tr>
                                        <td><a class="btn btn-light" role="button" href="<?= SROOT ?>PrescriptionHandler/loadPrescription/<?= $row->id ?>"><?php echo $row->name . '   ' . $row->address ?></a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } elseif (isset($this->processed)) {
                        echo "<h3>No result found</h3>";
                    } ?>
                    </div>
        <?php break;
                default:
                    break;
            }
        } ?>

        <br><br><a class="btn btn-primary" role="button" href="<?= SROOT ?>CustomerDashboard">Go to Dashboard</a>
    </div>
</body>

</html>