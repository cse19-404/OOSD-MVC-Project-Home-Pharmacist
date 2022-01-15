<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Account Details</title>
    <style>
    .bg-danger {color: #FF0000;}
    </style>
</head>
<style>
        .bg-danger {
            color: #FF0000;
        }

        .Appcontainer {
            z-index: 2;
            border-radius: 15px;
            background-color: #e9e9e9ed;
            height: 15%;
            width: 25%;
            margin: auto;
            margin-top: 2cm;
            padding: 30px;
            padding-left: 30px;
            padding-right: 30px;
            box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
        }
</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        <?php if ($this->role === 'customer') {?>
            <a role="button" class="mybtn btn btn-primary" href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
            <?php } else {?>
            <a role="button" class="mybtn btn btn-primary" href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
        <?php } ?>
        <h2 class="header">Change Account Details</h2>
        <div class="Appcontainer">
            <div class='bg-danger'>
                <?php if(isset($this->displayErrors)) {
                    echo $this->displayErrors;
                } ?>
            </div>
            <div>
                
                <form class="form-horizontal" action="<?=SROOT?>UserHandler/changedetails/<?=$this->role?>" method="post">
                    <label>New Username:</label>
                    <input class="form-control" type="text" name="username"><br><br>
                    <label>New password:</label>
                    <input class="form-control" type="password" name="password"><br>
                    <br><input class="btn btn-success" type="submit" value="Change"><br>         
                </form>
            </div>
        </div>
    </div>
</body>
</html>