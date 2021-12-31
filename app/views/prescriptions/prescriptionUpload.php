<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Prescription</title>
</head>
<body>
    <div>
        <div>
            Customer Name : <span><?=$this->userName?></span><br><br>
            Pharmacy Name : <span><?=$this->pharmName?></span>
        </div>
        <div>
            <form action="<?=SROOT?>PrescriptionHandler/uploadPrescription/<?=$this->userId?>/<?=$this->pharmId?>" method="post"enctype="multipart/form-data" >
                <br><label>Upload a Prescription</label>
                <input type="file" name="documents" id="documents" required><br><br>
                <input type="submit" class="btn-submit" value="Submit" name='submit'>
            </form>
        </div>
        <div>
            <br><?= isset($this->msg)?$this->msg:"" ?>
        </div>

        <a href="<?=SROOT?>PrescriptionHandler/selectMethod">Go Back</a>
    </div>
</body>
</html>