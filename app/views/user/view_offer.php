<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Add Offer Section</h2>

    <form method="post" action="<?= SROOT ?>SeasonalOfferHandler/saveOffer/<?= $this->PharmId ?>">

        Offer Name: <input type="text" name="name" value="<?= $this->OfferData['name'] ?>">
        <span class="bg-danger"> </span>
        <br><br>
        <label for="desc">Description:</label>
        <textarea id="desc" name="description" rows="4" cols="50"><?=$this->OfferData['description']?></textarea>
        <span class="bg-danger"></span>
        <br><br>
        Start Date: <input type="text" name="start_date" value="<?= $this->OfferData['start_date'] ?>">
        <span class="bg-danger"></span>
        <br><br>
        End Date: <input type="text" name="end_date" value="<?= $this->OfferData['end_date'] ?>">
        <span class="bg-danger"></span>
        <br><br>
        <input type="file" name="documents" id="documents" required>
        <br><br>
        <a href="<?=SROOT?>SeasonalOfferHandler/addForm/<?=$this->mode?>">Add Form Template</a>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>