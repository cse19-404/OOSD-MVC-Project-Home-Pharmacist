<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pharmacy</title>
    <style>
    .error {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: fit-content;
        width: 40%;
        margin: auto;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);      }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>

<body>
    <div class='container-fluid'>
        <br><br><a class="mybtn btn btn-success" role="button" href="<?=SROOT?>home/index">Go to Home</a>

        <h1 class='header'>Registration Application</h1><hr><br>

        <div class="Appcontainer">
                <div class='bg-danger'>
                        <?php if(isset($this->displayErrors)) {
                            echo $this->displayErrors;
                        } ?>
                </div>
            <form class="form-horizontal" action="<?=SROOT?>register/signup/pharmacy" method="post" enctype="multipart/form-data">
                <label class="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <label class="pharmacy_name">Pharmacy name</label>
                <input type="text" class="form-control" name="pharmacy_name" id="pharmacy_name" value="<?php echo htmlspecialchars($_POST['pharmacy_name'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <Label>Contact No</Label>
                <input type="text" class="form-control" name='contact_no' value="<?php echo htmlspecialchars($_POST['contact_no'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <label>Location: </label><br>
                <label>Latitude </label><input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo htmlspecialchars($_POST['latitude'] ?? '', ENT_QUOTES); ?>" required>
                <label>Longitude </label><input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo htmlspecialchars($_POST['longitude'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <label>Delivery Supported</label>
                <input type="checkbox" name="delivery_supported" <?php if(isset($_POST['delivery_supported']) && $_POST['delivery_supported']=='on'){echo "checked";}?>><br><br>
                <label>Upload Document</label>
                <input type="file" name="documents" id="documents" required><br>
                <input type="submit" class="btn btn-info" value="Submit" name='submit'>
            </form>
            
        </div>
        <br><br><br><br>
    </div>


</body>

</html>