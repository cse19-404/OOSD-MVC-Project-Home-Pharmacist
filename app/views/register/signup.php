<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    .bg-danger {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 24.5cm;
        width: 16cm;
        margin: auto;
        margin-top: 1cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
      }

    #Home{
        display:inline;
    }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>
<body>
    <div class='container-fluid'>
        <a class="mybtn btn btn-success" role="button" href="<?=SROOT?>home/index">Go to Home</a>

        <h1 class='header'>Sign Up...!</h1>
            <div class="Appcontainer">
                <form class="form-horizontal" action="<?=SROOT?>register/signup/customer" method="post">
                    <div class='bg-danger'>
                        <?php if(isset($this->displayErrors)) {
                            echo $this->displayErrors;
                        } ?>
                    </div>
                    <label class="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES); ?>" required><br>
                    <label class="nic">NIC:</label>
                    <input class="form-control" type="text" name="nic" id="nic" value="<?php echo htmlspecialchars($_POST['nic'] ?? '', ENT_QUOTES); ?>" required><br>                      
                    <label class="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" required><br>
                    <label class="address">Address:</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?php echo htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES); ?>" required><br>
                    <label class="mobile_number">Contact Number:</label>
                    <input type="text" name="mobile_number" class="form-control" id="mobile_number" value="<?php echo htmlspecialchars($_POST['mobile_number'] ?? '', ENT_QUOTES); ?>" required><br>          
                    <br><label>Location:</label><br>
                    <label>Latitude</label><input type="text" class="form-control" name="latitude" id="lat" value="<?php echo htmlspecialchars($_POST['latitude'] ?? '', ENT_QUOTES); ?>" required>
                    <label>Longitude</label><input type="text" class="form-control" name="longitude" id="lat" value="<?php echo htmlspecialchars($_POST['longitude'] ?? '', ENT_QUOTES); ?>" required><br> 
                    <br><label class="username">Username:</label>
                    <input type="text" name="username" class="form-control" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES); ?>" required><br>
                    <label class="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES); ?>" required><br>
                    <label class="password">Re-enter Password:</label>
                    <input type="password" name="repassword" class="form-control" id="repassword" value="<?php echo htmlspecialchars($_POST['repassword'] ?? '', ENT_QUOTES); ?>" required><br>      
                    <input type="text" name="role" value='customer' hidden>                              
                    <input type="submit" class="btn btn-info" value="Submit" name='submit'>            
                </form>
            </div>
            <br><br>
            <br><br><br><br>
    </div>

</body>
</html>