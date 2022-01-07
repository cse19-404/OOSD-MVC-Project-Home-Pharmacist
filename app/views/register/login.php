<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet"> 
    <style>
    .bg-danger {color: #FF0000;}

    body{
    background-image: url("https://pbs.twimg.com/media/EUI8QoSXgAIYAjY?format=jpg&name=4096x4096");
    background-repeat: repeat;
    background-size: cover;
    height:100vh;
    }

    .main{
    background-color: rgba(226, 226, 226, 0.904);
    width: 22vw;
    height:39vh;
    border-radius: 10px;
    box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    position: fixed;
    left: 50vw;
    top: 50vh;
    padding-top: 10px;
    transform: translate(-50%, -50%);
    }

    .form-control-plaintext{
    position: relative;
    border-radius: 0.2cm;
    background-color: rgba(255, 255, 255, 0.664) ;
    width: 20vw;
    height:5vh;
    font-size: 1vw;
    border: 2px solid rgb(179, 179, 179);
    }

    .btn {
    left: 4vw;
    top:9vh;
    border-radius: 0.2cm;
    width: 20vw;
    height:5vh;
    font-size: 1vw;
    background-color: rgb(112 173 181 / 84%);
    cursor:pointer;
    outline:none;
    border:none;
    box-shadow: #999;
    }

    .btn:active{
        transform: translateY(2px);
    }
    [placeholder]:focus::-webkit-input-placeholder{
        color: #666;
        transition: opacity 0.1s 0.1s ease;
        opacity: 0;
    }

    .header{
        font-family: 'Slabo 27px', serif;
    }
    </style>
</head>
<body>
    <h1 class='header'>Login<hr></h1>
    <br>
    
        <div class="outer">
        <div style="width:100%;">
        <div class = "top">
        <div class='bg-danger'>
                        <?php if(isset($this->errcreditionals)) {
                            echo $this->errcreditionals;
                        } ?>
        </div>
        <main class='main'>
            <form action= "<?=SROOT?>register/login/<?= Register::getCurrentRole()?>" method="post">
                <div class="mb-3 row1">
                    <div class="col-sm-10">
                        <label>Username</label><br>
                        <input type="text" class="form-control-plaintext" placeholder = "Username" name="username"><br><br>
                    </div>
                </div>
                <div class="mb-3 row1">
                    <div class="col-sm-10">
                        <label>Password</label><br>
                        <input type="password" class="form-control-plaintext" placeholder = "Password" name="password"> <span class="error"><br><br>
                    </div>
                </div>
                <div class="mb-3 row1">
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" name="submit" value="Sign-in">
                    </div>
                </div>
                <div class="mb-3 row1">
                    <div class="col-sm-10">
                        <?php if ($this->role === 'pharmacy'){
                        echo('<br><a href='.SROOT.'register/signup/pharmacy>Apply For a Pharmacy Account</a>');
                    }else{
                        echo('<br><label>Need an account? <a href='.SROOT.'register/signup/customer>Sign up</a></label>');    
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