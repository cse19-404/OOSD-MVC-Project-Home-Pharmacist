<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Login<hr></h1>
    <br>
    <form action= "<?=SROOT?>register/login/customer" method="post">
        <label>Username</label>
        <input type="text" name="username"><br><br>
        <label>Password</label>
        <input type="password" name="password"> <span class="error"><br><br>
        <input type="submit" name="submit" value="Sign-in">
    </form>
    <br>
    <!-- <?php if ($_GET['role']==='customer') {?>
    <label>Need an account? <a href="register.php">Sign up</a></label>
    <?php } else{?>
    <a href="phram_reg.php">Apply For a Pharmacy Account</a>
    <?php } ?> -->
</body>
</html>