<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <h1>Welcome to HOME PHARMACIST</h1>
    <hr><br>
    <a href="<?=SROOT?>register/login/customer">Login as a User</a><br>
    <a href="<?=SROOT?>register/login/pharmacy">Login as a Pharmacy</a>
    <br><br>
    <a href="<?=SROOT?>register/signup/customer">New to HOME PHARMACIST.? Sign up for free.</a>
    <br><br>
    <a href="phram_reg.php">Apply For a Pharmacy Account</a>
    <br><br>
    <h3><?php if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        } ?></h3>
</body>

</html>