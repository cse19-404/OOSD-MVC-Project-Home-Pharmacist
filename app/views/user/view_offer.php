<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        width: 40%;
        margin: auto;
        margin-top: 2cm;
        padding: 30px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }

</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <?php 
        if($this->mode === "add" ){
            $btnValue = "Add Offer";
        }
        else{
            $btnValue = "Save Offer";
        }
    ?>
    <div class='container-fluid'>
        <h2 class="header">Add Offer Section</h2>
        <div class="Appcontainer">
            <div class='bg-danger' style="color:red">
                            <?php if(isset($this->displayErrors)) {
                                echo $this->displayErrors;
                            } ?>
                        </div>
            <form method="post" action="<?= SROOT ?>SeasonalOfferHandler/saveOffer/<?=$this->mode?>/<?= $this->PharmId ?>/<?=$this->OfferId?>" enctype="multipart/form-data">

                <label for="name">Offer Name: </label><input class="form-control" type="text" name="name" value="<?= $this->OfferData['name'] ?>" required>
                <br><br>
                <label for="desc">Description:</label>
                <textarea class="form-control" id="desc" name="description" rows="4" cols="50" required><?=$this->OfferData['description']?></textarea>
                <br><br>
                <label for="start_date">Start Date: </label><input class="form-control" type="date" name="start_date" value="<?= $this->OfferData['start_date'] ?>" required>
                <br><br>
                <label for="end_date">End Date: </label><input class="form-control" type="date" name="end_date" value="<?= $this->OfferData['end_date'] ?>" required>
                <br><br>
                <input type="file" name="bannerdocument" id="documents" <?= ($this->mode === 'add')? 'required' :""?>>
                <br><br>

                <input class="btn btn-success" type="submit" name="submit" value=<?= $btnValue ?>>
            </form>
        </div>
        <br><br>
        <a role="button" class="btn btn-primary" href="<?=SROOT?>SeasonalOfferHandler/view">Go to OffersSection</a>
    </div>
</body>

</html>