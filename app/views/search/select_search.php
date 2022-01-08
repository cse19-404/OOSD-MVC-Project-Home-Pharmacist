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

    ul{
    margin:0;
    padding:0;
    list-style:none;
    }
    .padding-lg {
        display: block;
        padding-top: 60px;
        padding-bottom: 60px;
    }
    .our-webcoderskull .cnt-block:hover {
        box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        border: 0;
    }

    .our-webcoderskull .cnt-block{ 
    float:left; 
    width:100%; 
    background:#fff; 
    padding:30px 20px; 
    text-align:center; 
    border:2px solid #d5d5d5;
    margin: 0 0 28px;
    }
    .our-webcoderskull .cnt-block figure{
    width:148px; 
    height:148px; 
    border-radius:100%; 
    display:inline-block;
    margin-bottom: 15px;
    }
    .our-webcoderskull .cnt-block img{ 
    width:148px; 
    height:148px; 
    border-radius:100%; 
    }
    .our-webcoderskull .cnt-block h3{ 
    color:#2a2a2a; 
    font-size:20px; 
    font-weight:500; 
    padding:6px 0;
    text-transform:uppercase;
    }
    .our-webcoderskull .cnt-block h3 a{
    text-decoration:none;
        color:#2a2a2a;
    }
    .our-webcoderskull .cnt-block h3 a:hover{
        color:#337ab7;
    }
    .our-webcoderskull .cnt-block p{ 
        color:#2a2a2a; 
        font-size:13px; 
        line-height:20px; 
        font-weight:400;
    }
    .mybtn{
        float: right;
        margin-top: 20px;
    }
    .row{
        margin-top: 100px;
    }
    .padding-lg{
        margin-left: 150px;
        margin-right: -150px;
    }
</style>
<?php include_once('css/baseForm.php'); ?>

<body>
    <div class='container-fluid'>
        <?php if (!isset($this->searchMode)) { ?>
            <br><a class="mybtn btn btn-primary" role="button" href="<?= SROOT ?>CustomerDashboard">Go to Dashboard</a>
            <div class='container'>
            <section class="our-webcoderskull padding-lg">
                <ul class="row">
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?= SROOT ?>CustomerDashboard/selectSearch/selected';">
                            <figure><img src="https://cdn2.iconfinder.com/data/icons/pharmacy-17/2000/Pharmacy_front-512.png" class="img-responsive" alt=""></figure>
                            <h3><a href="<?= SROOT ?>CustomerDashboard/selectSearch/selected">Select a Pharmacy</a></h3>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?= SROOT ?>PrefilledformHandler/nearBy';">
                            <figure><img src="https://thumbs.dreamstime.com/b/pharmacy-location-blue-map-pin-icon-element-map-point-mobile-concept-web-apps-icon-website-design-109712535.jpg" class="img-responsive" alt=""></figure>
                            <h3><a href="<?= SROOT ?>PrefilledformHandler/nearBy">Search in Nearby Pharmacies</a></h3>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?= SROOT ?>PrescriptionHandler/selectMethod';">
                            <figure><img src="https://media.istockphoto.com/vectors/medical-prescription-vector-illustration-rx-concepts-modern-flat-vector-id1136667779?k=20&m=1136667779&s=612x612&w=0&h=fUimtkr9BCbqkymYD6tXiQxh9RCspWLKwChy5JX3gvw=" class="img-responsive" alt=""></figure>
                            <h3><a href="<?= SROOT ?>PrescriptionHandler/selectMethod">Upload a Prescription</a></h3>
                        </div>
                    </li>
                </ul>
            </section>
            </div>
            <?php } ?>

        <?php if (isset($this->searchMode)) {?>
            <br><a class="btn btn-primary mybtn" role="button" href="<?= SROOT ?>CustomerDashboard/search">Go Back</a>
            <?php switch ($this->searchMode) {
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
            }?>
        <?php } ?>

       
    </div>
</body>

</html>