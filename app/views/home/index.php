<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php include_once('css/base.php'); ?>

    <style>
        section {
            padding-top: 4rem;
            padding-bottom: 5rem;
            background-color: rgba(226, 226, 226, 0.687);
        }
        .wrap {
            display: flex;
            background: white;
            padding: 1rem 1rem 1rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 7px 7px 30px -5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .wrap:hover {
            background: linear-gradient(135deg,#6394ff 0%,#0a193b 100%);
            color: white;
            cursor: pointer;
        }

        .mbr-iconfont {
            font-size: 4.5rem !important;
            color: #313131;
            margin: 1rem;
            padding-right: 1rem;
        }
        .vcenter {
            margin: auto;
        }

        .mbr-section-title3 {
            text-align: left;
        }
        h2 {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .display-5 {
            font-family: 'Source Sans Pro',sans-serif;
            font-size: 1.4rem;
        }
        .mbr-bold {
            font-weight: 700;
        }

        p {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            line-height: 25px;
        }
        .display-6 {
            font-family: 'Source Sans Pro',sans-serif;
            font-size: 1re}
    </style>
</head>

<body>
    <div class='container-fluid'>
        <h1 class='header'>Welcome to HOME PHARMACIST</h1>
    </div>
    <section>
    
        <div class='container'>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>register/login/customer';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Login as a User</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>register/login/pharmacy';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Login as a Pharmacy</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>register/signup/customer';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Sign up as a Customer</h2></p>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <div class="wrap" onclick="location.href='<?=SROOT?>register/signup/pharmacy';">
                        <div class="text-wrap vcenter">
                            <p class="mbr-fonts-style text1 mbr-text display-6"><h2>Apply For a Pharmacy Account</h2></p>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
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