<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    .bg-danger {color: #FF0000;}
    </style>
</head>
<body>
    <h1>Sign Up...!</h1>
        <div class="registration-form">
            <form action="<?=SROOT?>register/signup/customer" method="post">
                <div class='bg-danger'>
                    <?= $this->displayErrors ?>
                </div>
                <lable class="name">Name:</lable>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="nic">NIC:</lable>
                <input type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($_POST['nic'] ?? '', ENT_QUOTES); ?>" required><br><br>                            
                <lable class="email">Email:</lable>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="address">Address:</lable>
                <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="mobile_number">Contact Number:</lable>
                <input type="text" name="mobile_number" id="mobile_number" value="<?php echo htmlspecialchars($_POST['mobile_number'] ?? '', ENT_QUOTES); ?>" required><br><br>                
                <label>Location:</label>
                <label>Latitude</label><input type="text" name="latitude" id="lat" value="<?php echo htmlspecialchars($_POST['latitude'] ?? '', ENT_QUOTES); ?>" required>
                <label>Longitude</label><input type="text" name="longitude" id="lat" value="<?php echo htmlspecialchars($_POST['longitude'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="username">Username:</lable>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="password">Password:</lable>
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>" required><br><br>
                <lable class="password">Re-enter Password:</lable>
                <input type="password" name="repassword" id="repassword" value="<?php echo htmlspecialchars($_POST['repassword'] ?? '', ENT_QUOTES); ?>" required><br><br>       
                <input type="text" name="role" value='customer' hidden>                              
                <input type="submit" class="btn-submit" value="Submit" name='submit'>            
            </form>
        </div>   
</body>
</html>