<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Near By Pharmacies</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include_once('css/baseTable.php'); ?>
</head>
<style>
    li {
    list-style: none;
}
.anidi_services {
    padding: 40px 20px 80px;
    border-radius: 6px;
    background-color: rgba(200, 244, 238, 0.53);
}
.anidi_services ul {
    display: block;
}

.anidi_services ul li {
    display: block;
    margin-bottom: 15px;
    color: #fff;
    text-decoration: none;
    -webkit-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}

.anidi_services ul li a {
    display: block;
    color: #0d391c;
    text-decoration: none;
    -webkit-transition: 0.5s;
    -o-transition: 0.5s;
    transition: 0.5s;
}

.anidi_services ul li a span.icon {
    width: 50px;
    display: block;
    font-size: 30px;
    float: left;
}

.anidi_services ul li a span.text {
    display: block;
    font-size: 16px;
    margin-left: 50px;
    padding-top: 12px;
}
.anidi_services ul li a span.text:hover {
    color: #225463;
}
</style>

<body>
    <!-- <table>
        <?php foreach($this->pharmacies as $pharmacy){ ?>
            <tr>
                <td><a href="<?=SROOT?>PrescriptionHandler/uploadPrescription/<?=$this->userId?>/<?= $pharmacy->id ?>"><?= $pharmacy->name."|".$pharmacy->address ?></a></td>
            </tr>
        <?php }?>
    </table> -->
    <a role="button" class="mybtn btn btn-primary" href="<?=SROOT?>PrescriptionHandler/selectMethod">Go Back</a>    
    <header style="padding-left: 20px;"><h1>Nearby Pharmacy List</h1></header><hr><br>
    <div class="container anidi_services ">
        <div class="row">
            
            <ul class="links">
                <?php foreach($this->pharmacies as $pharmacy){ ?>
                    <li><a href="<?=SROOT?>PrescriptionHandler/uploadPrescription/<?=$this->userId?>/<?= $pharmacy->id ?>" title="Food & Beverages">
                        <span class="icon"><i class="fa fa-map-marker"></i></span>
                    <span class="text"><?= $pharmacy->name."|".$pharmacy->address ?></span></a>
                        <div class="clearfix"></div>
                    </li>
                    <?php }?>
            </ul>
        </div>
    </div>

</body>
</html>