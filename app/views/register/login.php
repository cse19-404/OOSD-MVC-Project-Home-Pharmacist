<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php include_once('css/base.php'); ?>

    <style>
        .myadjust {
            margin-left: 50px;
            margin-right: 50px;
            padding-left: 38%;
            padding-right: 37%; 
        }

        .main {
            background-color: rgba(226, 226, 226, 0.904);
            width: 24vw;
            height: 42vh;
            border-radius: 10px;
            box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
            position: fixed;
            left: 50vw;
            top: 50vh;
            padding-top: 21px;
            transform: translate(-50%, -50%);
        }

        .form-control-plaintext {
            position: relative;
            border-radius: 0.2cm;
            background-color: rgba(255, 255, 255, 0.664);
            width: 20vw;
            height: 5vh;
            font-size: 1vw;
            border: 2px solid rgb(179, 179, 179);
        }

        .btn {
            left: 4vw;
            top: 9vh;
            border-radius: 0.2cm;
            width: 20vw;
            height: 5vh;
            font-size: 1vw;
            background-color: rgb(112 173 181 / 84%);
            cursor: pointer;
            outline: none;
            border: none;
            box-shadow: #999;
        }

        .btn:active {
            transform: translateY(2px);
        }

        [placeholder]:focus::-webkit-input-placeholder {
            color: #666;
            transition: opacity 0.1s 0.1s ease;
            opacity: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1 class='header' style="padding: 10px;">Login as a <?= ucwords(Register::getCurrentRole()) ?>
            <hr>
        </h1>
    </header>
    <br>
    <div class="myadjust">
        <?php if (isset($this->errcreditionals)) { ?>
            <div class="alert alert-danger" role="alert" style="padding-left: 33px;">
                <strong><?php echo ($this->errcreditionals); ?></strong>
            </div>
        <?php } ?>
    </div>
    <div class="outer">
        <div style="width:100%;">
            <div class="top">
                <main class='main'>
                    <form action="<?= SROOT ?>register/login/<?= Register::getCurrentRole() ?>" method="post">
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <label>Username</label><br>
                                <input type="text" class="form-control-plaintext" placeholder="Username" name="username"><br><br>
                            </div>
                        </div>
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <label>Password</label><br>
                                <input type="password" class="form-control-plaintext" placeholder="Password" name="password"> <span class="error"><br><br>
                            </div>
                        </div>
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <input type="submit" class="btn btn-primary" name="submit" value="Sign-in">
                            </div>
                        </div>
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <?php if (Register::getCurrentRole() === 'pharmacy') {
                                    echo ('<br><a href=' . SROOT . 'register/signup/pharmacy>Apply For a Pharmacy Account</a>');
                                } else {
                                    echo ('<br><label>Need an account? <a href=' . SROOT . 'register/signup/customer>Sign up</a></label>');
                                } ?>
                            </div>
                        </div>
                    </form>
                </main>
                <br>
            </div>
        </div>
    </div>

</body>

</html>