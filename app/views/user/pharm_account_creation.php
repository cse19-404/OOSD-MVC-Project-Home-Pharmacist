<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pharmacy Account</title>
    <style>
    .bg-danger {color: #FF0000;}
    </style>
</head>
<body>
    
<?php if(isset($_SESSION['role']) && !strcmp($_SESSION['role'],'super_admin')) { ?>
<?php $application = (array)$this->application;?>
<h2>Pharmacy Account Creation Form</h2>
<div class='bg-danger'>
    <?php if(isset($this->displayErrors)) {
        echo $this->displayErrors;
    } ?>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Pharmacy Name: <input type="text" name="name" value="<?php echo $application["pharmacy_name"];?>" required>
  <br><br>
  E-mail: <input type="email" name="email" value="<?php echo $application["email"];?>" required>
  <br><br>
  Location Latitude: <input type="text" name="latitude" value="<?php echo $application["latitude"];?>" required>
  Longitude: <input type="text" name="longitude" value="<?php echo $application["longitude"];?>" required>
  <br><br>
  Delivery Supported: <input type="checkbox" name="delivery_supported" <?php if($application["delivery_supported"]){echo "checked";}?>>
  <br><br>
  Address: <input type="text" name="address" value="<?php echo $application["address"];?>" required>
  <br><br>
  Contact Number: <input type="text" name="contact_number" value="<?php echo $application["contact_no"];?>" required>
  <br><br>
  License no.: <input type="text" name="License_no" required>
  <br><br>
  Username: <input type="text" name="username" value="<?php echo $application["pharmacy_name"];?>" required>
  <br><br>
  Password: <input type="password" name="password" required>
  <br><br>
  Re-Enter Password: <input type="password" name="repassword" required>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>
<br><br><a href="<?=SROOT?>ApplicationHandler/viewApproved">Go to Approved Applications</a>
<?php } else {
    header('Location: index.php');
}?>
</body>
</html>