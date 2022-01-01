<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pharmacy</title>
    <style>
    .error {color: #FF0000;}
    </style>
</head>

<body>
    <h1>Registration Application</h1>
    <div class="aplication-form">
        <form action="<?=SROOT?>register/signup/pharmacy" method="post" enctype="multipart/form-data">
            <lable class="email">Email</lable>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required><br><br>
            <lable class="pharmacy_name">Pharmacy name</lable>
            <input type="text" name="pharmacy_name" id="pharmacy_name" value="<?php echo htmlspecialchars($_POST['pharmacy_name'] ?? '', ENT_QUOTES); ?>" required><br><br>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?>" required><br><br>
            <Label>Contact No</Label>
            <input type="text" name='contact_no' value="<?php echo htmlspecialchars($_POST['contact_no'] ?? '', ENT_QUOTES); ?>" required><br><br>
            <label>Location: </label>
            <label>Latitude </label><input type="text" name="latitude" id="latitude" value="<?php echo htmlspecialchars($_POST['latitude'] ?? '', ENT_QUOTES); ?>" required>
            <label>longitude </label><input type="text" name="longitude" id="longitude" value="<?php echo htmlspecialchars($_POST['longitude'] ?? '', ENT_QUOTES); ?>" required><br><br>
            <label>Delivery Supported</label>
            <input type="checkbox" name="delivery_supported" <?php if(isset($_POST['delivery_supported']) && $_POST['delivery_supported']=='on'){echo "checked";}?>><br><br>
            <label>Upload Document</label>
            <input type="file" name="documents" id="documents" required><br><br>
            <input type="submit" class="btn-submit" value="Submit" name='submit'>
        </form>
        <br><br><a href="<?=SROOT?>home/index">Go to Home</a>
    </div>

</body>

</html>