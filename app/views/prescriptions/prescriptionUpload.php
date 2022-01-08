<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Upload Prescription</title>
</head>
<style>
    .bg-danger {
        color: #FF0000;
    }

    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 15%;
        width: 30%;
        margin: auto;
        margin-top: 2cm;
        padding: 30px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }
    .alert-dismissible .btn-close{
        margin-top: 5.5px;
    }
</style>
<?php include_once('css/baseForm.php'); ?>

<body>
    <div class='container-fluid'>
        <a role="button" class="mybtn btn btn-success" href="<?= SROOT ?>PrescriptionHandler/selectMethod">Go Back</a>
        <h2 class="header">Upload a Prescription</h2>
        <div class="Appcontainer">

            <div>
                Customer Name : <span><?= $this->userName ?></span><br><br>
                Pharmacy Name : <span><?= $this->pharmName ?></span>
            </div>
            <br>
            <div>
                <form action="<?= SROOT ?>PrescriptionHandler/uploadPrescription/<?= $this->userId ?>/<?= $this->pharmId ?>" method="post" enctype="multipart/form-data">
                    <br><label>Upload a Prescription</label><br>
                    <input type="file" name="documents" id="documents" required><br><br>
                    <input class="btn btn-primary" type="submit" class="btn-submit" value="Submit" name='submit'>
                </form>
            </div><br>
            <div><?php if(isset($this->msg)){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong><?= $this->msg ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</body>

</html>