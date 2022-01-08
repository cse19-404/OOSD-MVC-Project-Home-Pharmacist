<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
        font-family: 'open sans';
        overflow-x: hidden; }

        img {
        max-width: 100%; }

        .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
            -ms-flex-direction: column;
                flex-direction: column; }
        @media screen and (max-width: 996px) {
            .preview {
            margin-bottom: 20px; } }

        .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
                flex-grow: 1; }

        .tab-content {
        overflow: hidden; }
        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
                    animation-name: opacity;
            -webkit-animation-duration: .3s;
                    animation-duration: .3s; }

        .card {
        margin-top: 50px;
        background: #eee;
        padding: 3em;
        line-height: 1.5em; }

        @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex; } }

        .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
            -ms-flex-direction: column;
                flex-direction: column; }

        .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
                flex-grow: 1; }

        .product-title, .price, .sizes, .colors {
        text-transform: UPPERCASE;
        font-weight: bold; }

        .checked, .price span {
        color: #ff9f1a; }

        .product-title, .rating, .product-description, .price, .vote, .sizes {
        margin-bottom: 15px; }

        .product-title {
        margin-top: 0; }

        .size {
        margin-right: 10px; }
        .size:first-of-type {
            margin-left: 40px; }

        .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px; }
        .color:first-of-type {
            margin-left: 20px; }

        .tooltip-inner {
        padding: 1.3em; }

        @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } }

        @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
                    transform: scale(3); }
        100% {
            opacity: 1;
            -webkit-transform: scale(1);
                    transform: scale(1); } }

    </style>
    <?php include_once('css/base.php'); ?>

    <title>Seasonal Offers</title>
</head>
<body>
    <div class='container'>
    <h2 class='header'>Welcome to Seasonal Offers Section</h2><hr><br>
    <?php if($_SESSION['role']==='pharmacy'){?>
        <form action="<?=SROOT?>SeasonalOfferHandler/viewOffer/add" method="post">
            <input class="btn btn-warning" type="submit" value='Add new Offer'>
        </form>
        <br><br>
        <?php foreach($this->results as $row){?>
        <div class="container" onclick="location.href='#';" style="cursor: pointer;">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">
                            <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="<?= SROOT.$row->bannerdocument?>" /></div>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?= $row->name?></h3>
                            <p class="product-description"><?= $row->description?></p>
                            <h4 class="price"><?= ($row->isexpired)?"Expired on <span>".$row->end_date."</span>":"Active from <span>".$row->start_date."</span> to <span>".$row->end_date."</span>"?></h4>
                            <div class="action">
                                <?php
                                if(!$row->isexpired){?>
                                <form action="<?=SROOT?>SeasonalOfferHandler/viewOffer/edit/<?= $row->id ?>"><input class="btn btn-success" type="submit" value="Edit Offer"></form><br>
                                <?php }?>
                                <?php 
                                if($row->isexpired){?>
                                <form action="<?=SROOT?>SeasonalOfferHandler/viewOffer/renew/<?= $row->id ?>"><input class="btn btn-info" type="submit" value="Renew Offer"></form><br>
                                <?php }?>
                                <form action="<?=SROOT?>SeasonalOfferHandler/deleteOffer/<?= $row->id ?>"><input class="btn btn-danger" type="submit" value="Remove From View"></form>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	    </div>
        <?php }?>
        <br><br>
        <a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
    <?php }elseif($_SESSION['role']==='customer'){?>
            <?php foreach($this->results as $pharmId => $rows){?>
                <div class="container-fluid" id="<?= $pharmId?>" style="cursor: pointer; border: 2px solid; border-radius: 10px; padding:30px;text-align:centre;">
                    <span name='pharm-name'><h4><strong><?= $this->pharmacies[$pharmId][0]->name ?></strong></h4></span>
                    <span name='pharm-address'><h5><?= $this->pharmacies[$pharmId][0]->address?></h5></span>
                    <span name='pharam-delivery-supported'><?= ($this->pharmacies[$pharmId][0]->delivery_supported)?"<h5>Delivery Supported":"Delivery Not Supported"?></span><br><br>
                    <?php foreach($rows as $row){?>
                        <div class="card" id="<?= $row->id?>" onclick="location.href='<?=SROOT?>PreFilledFormHandler/loadSearchForm/<?= $pharmId ?>';">
                            <div class="container-fliud">
                                <div class="wrapper row">
                                    <div class="preview col-md-6">
                                        <div class="preview-pic tab-content">
                                        <div class="tab-pane active" id="pic-1"><img src="<?= SROOT.$row->bannerdocument?>" /></div>
                                        </div>
                                    </div>
                                    <div class="details col-md-6">
                                        <h3 class="product-title"><?= $row->name?></h3>
                                        <p class="product-description"><?= $row->description?></p>
                                        <h4 class="price"><?= ($row->isexpired)?"Expired on <span>".$row->end_date."</span>":"Active from <span>".$row->start_date."</span> to <span>".$row->end_date."</span>"?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
            </div>
            <br><br>
            <?php }?>
            <a href="<?=SROOT?>CustomerDashboard" role="button" class="btn btn-primary">Go to Dashboard</a>
        <?php } ?>
    </div>  
    
    
</body>
</html>