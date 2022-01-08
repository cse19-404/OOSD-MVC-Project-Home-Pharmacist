<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Method</title>
    <style>
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
    </style>

    <?php include_once('css/base.php'); ?>
</head>
<body>
    <div class='container-fluid'>
            <div class='container'>
            <section class="our-webcoderskull padding-lg">
                <ul class="row">
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>CustomerDashboard/selectSearch/prescription';">
                            <figure><img src="https://cdn2.iconfinder.com/data/icons/pharmacy-17/2000/Pharmacy_front-512.png" class="img-responsive" alt=""></figure>
                            <h3><a href="<?=SROOT?>CustomerDashboard/selectSearch/prescription">Select a Pharmacy</a></h3>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>PrescriptionHandler/uploadtonearbyPharm';">
                            <figure><img src="https://thumbs.dreamstime.com/b/pharmacy-location-blue-map-pin-icon-element-map-point-mobile-concept-web-apps-icon-website-design-109712535.jpg" class="img-responsive" alt=""></figure>
                            <h3><a href="<?=SROOT?>PrescriptionHandler/uploadtonearbyPharm">Search in Nearby Pharmacies</a></h3>
                        </div>
                    </li>
                </ul>
            </section>
            </div>

    <br><br><br><a href="<?=SROOT?>CustomerDashboard/search" role='button' class='btn btn-primary'>Go Back</a>
</body>
</html>