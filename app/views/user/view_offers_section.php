<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seasonal Offers</title>
</head>
<body>
    <h2>Welcome to Seasonal Offers Section</h2>
    <form action="<?=SROOT?>SeasonalOfferHandler/viewOffer/add" method="post">
        <input type="submit" value='Add new Offer'>
    </form>
    <br><br>
    <?php foreach($this->results as $row){?>
        <div onclick="location.href='#';" style="cursor: pointer; border: 2px solid; border-radius: 10px;" >
            <h4><?= $row->name?></h4>
            <span><?= ($row->isexpired)?"Expired on ".$row->end_date:"Active from ".$row->start_date." to ".$row->end_date?></span><br>
            <label name="" id=""><?= $row->description?></label><br>
            <img src="<?= SROOT.$row->bannerdocument?>" alt="A Seasonal Offer" width="300" height="100">
        </div>
        <form action="<?=SROOT?>SeasonalOfferHandler/viewOffer/edit/<?= $row->id ?>"><input type="submit" value="Edit Offer"></form>
        <form action="<?=SROOT?>SeasonalOfferHandler/deleteOffer/<?= $row->id ?>"><input type="submit" value="Remove From View"></form>
        <br>
    <?php }?>
    <br><br>
    <a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
</body>
</html>