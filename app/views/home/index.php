<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet"> 
    <style>
        body{
            background-image: url("https://pbs.twimg.com/media/EUI8QoSXgAIYAjY?format=jpg&name=4096x4096");
            background-repeat: repeat;
            background-size: cover;
            height:100vh;
        }

        .header{
        font-family: 'Slabo 27px', serif;
        }

    </style>
</head>

<body>
    <h1 class='header'>Welcome to HOME PHARMACIST</h1>
    <hr><br>
    <a href="<?=SROOT?>register/login/customer">Login as a User</a><br>
    <a href="<?=SROOT?>register/login/pharmacy">Login as a Pharmacy</a>
    <br><br>
    <a href="<?=SROOT?>register/signup/customer">New to HOME PHARMACIST.? Sign up for free.</a>
    <br><br>
    <a href="<?=SROOT?>register/signup/pharmacy">Apply For a Pharmacy Account</a>
    <br><br>
    <h3><?php if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        } ?></h3>
</body>

</html>