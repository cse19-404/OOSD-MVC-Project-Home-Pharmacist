<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php include_once('css/base.php'); ?>

    <style>
        ul{
        margin:0;
        padding:0;
        list-style:none;
        }
        .padding-lg {
            display: block;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .our-webcoderskull .cnt-block:hover {
            box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
            border: 0;
        }

        .our-webcoderskull .cnt-block{ 
        float:left; 
        width:100%; 
        background:#fff; 
        padding:30px 20px; 
        text-align:center; 
        border:2px solid #d5d5d5;
        margin: 0 0 28px;
        }
        .our-webcoderskull .cnt-block figure{
        width:148px; 
        height:148px; 
        border-radius:100%; 
        display:inline-block;
        margin-bottom: 15px;
        }
        .our-webcoderskull .cnt-block img{ 
        width:148px; 
        height:148px; 
        border-radius:100%; 
        }
        .our-webcoderskull .cnt-block h3{ 
        color:#2a2a2a; 
        font-size:20px; 
        font-weight:500; 
        padding:6px 0;
        text-transform:uppercase;
        }
        .our-webcoderskull .cnt-block h3 a{
        text-decoration:none;
            color:#2a2a2a;
        }
        .our-webcoderskull .cnt-block h3 a:hover{
            color:#337ab7;
        }
        .our-webcoderskull .cnt-block p{ 
        color:#2a2a2a; 
        font-size:13px; 
        line-height:20px; 
        font-weight:400;
        }
        .row{
        margin-top: 30px;
        }
        .padding-lg{
            margin-left: 300px;
            margin-right: -300px;
        }
    </style>
</head>

<body>
    <div class='container'>
        <h1 class='header'>Welcome to HOME PHARMACIST</h1><hr><br>
    
        <div>
            <div class='container'>
            <section class="our-webcoderskull padding-lg">
                <ul class="row">
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>register/login/customer';">
                            <figure><img src="https://miro.medium.com/fit/c/1360/1360/1*PTMS3jauA_i0-ZAR1U4nfw.png" class="img-responsive" alt=""></figure>
                            <h3><a href="<?=SROOT?>register/login/customer">Login as a <br> User</a></h3>
                            <p><a href="<?=SROOT?>register/signup/customer">Sign up for free</a></p>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;cursor: pointer;" onclick="location.href='<?=SROOT?>register/login/pharmacy';">
                            <figure><img src="https://i.pinimg.com/originals/25/73/9a/25739a34018afaac50d5a3e6a0a947ea.jpg" class="img-responsive" alt=""></figure>
                            <h3><a href="<?=SROOT?>register/login/pharmacy">Login as a <br> Pharmacy</a></h3>
                            <p><a href="<?=SROOT?>register/signup/pharmacy">Apply For a Pharmacy Account</a></p>
                        </div>
                    </li>
                </ul>
            </section>
            </div>
        </div>
    </div>

    
    <div hidden>
        <h1 class='header'>Welcome to HOME PHARMACIST</h1>
        <hr><br>
        <a href="<?=SROOT?>register/login/customer">Login as a User</a><br>
        <a href="<?=SROOT?>register/login/pharmacy">Login as a Pharmacy</a>
        <br><br>
        <a href="<?=SROOT?>register/signup/customer">New to HOME PHARMACIST.? Sign up for free.</a>
        <br><br>
        <a href="<?=SROOT?>register/signup/pharmacy">Apply For a Pharmacy Account</a>
        <br><br>
    </div>
    <h3><?php if (isset($_GET['msg'])) {
            echo $_GET['msg'];
        } ?></h3>
</body>

</html>