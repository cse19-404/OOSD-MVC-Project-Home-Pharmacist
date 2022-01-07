<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        if($this->mode === "add" ){
            $btnValue = "Add Offer";
        }
        else{
            $btnValue = "Save Offer";
        }
    ?>
    <h2>Add Offer Section</h2>
    <div class='bg-danger' style="color:red">
                    <?php if(isset($this->displayErrors)) {
                        echo $this->displayErrors;
                    } ?>
                </div>
    <form method="post" action="<?= SROOT ?>SeasonalOfferHandler/saveOffer/<?=$this->mode?>/<?= $this->PharmId ?>/<?=$this->OfferId?>" enctype="multipart/form-data">

        Offer Name: <input type="text" name="name" value="<?= $this->OfferData['name'] ?>" required>
        <span class="bg-danger">*</span>
        <br><br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="description" rows="4" cols="50" required><?=$this->OfferData['description']?></textarea>
        <span class="bg-danger">*</span>
        <br><br>
        Start Date: <input type="date" name="start_date" value="<?= $this->OfferData['start_date'] ?>" required>
        <span class="bg-danger">*</span>
        <br><br>
        End Date: <input type="date" name="end_date" value="<?= $this->OfferData['end_date'] ?>" required>
        <span class="bg-danger">*</span>
        <br><br>
        <input type="file" name="bannerdocument" id="documents" <?= ($this->mode === 'add')? 'required' :""?>>
        <br><br>

        <input type="submit" name="submit" value=<?= $btnValue ?>>
    </form>
    <br><br>
    <a href="<?=SROOT?>SeasonalOfferHandler/view">Go to OffersSection</a> 
</body>

</html>