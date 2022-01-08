<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        height:15%;
        width: 30%;
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
    <div class='container-fluid'>
        <a role="button" class="mybtn btn btn-success" href="<?=SROOT?>PrescriptionHandler/selectMethod">Go Back</a>
        <h2 class="header">Upload a Prescription</h2>
        <div class="Appcontainer">
        
            <div>
                Customer Name : <span><?=$this->userName?></span><br><br>
                Pharmacy Name : <span><?=$this->pharmName?></span>
            </div>
            <br>
            <div>
                <form action="<?=SROOT?>PrescriptionHandler/uploadPrescription/<?=$this->userId?>/<?=$this->pharmId?>" method="post"enctype="multipart/form-data" >
                    <br><label>Upload a Prescription</label><br>
                    <input type="file" name="documents" id="documents" required><br><br>
                    <input class="btn btn-primary" type="submit" class="btn-submit" value="Submit" name='submit'>
                </form>
            </div>
            <div>
                <br><?= isset($this->msg)?$this->msg:"" ?>
            </div>      
        </div>
    </div>
</body>
</html>