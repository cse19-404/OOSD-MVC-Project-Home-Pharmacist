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
<body>
<div class='bg-danger'>
    <?php if(isset($this->displayErrors)) {
        echo $this->displayErrors;
    } ?>
    </div>
    <div>
        <h2>Change Account Details</h2>
        <form action="<?=SROOT?>UserHandler/changedetails/<?=$this->role?>" method="post">
            <label>New Username:</label>
            <input type="text" name="username"><br><br>
            <label>New password:</label>
            <input type="password" name="password"><br>
            <br><input type="submit" value="Change">         
        </form>
    </div>

    <?php if ($this->role === 'customer') {?>
    <br><br><a href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
    <?php } else {?>
    <br><br><a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
    <?php } ?>
</body>
</html>