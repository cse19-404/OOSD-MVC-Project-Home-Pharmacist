<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Order Details</title>
</head>
<body>
    <div>
        <span>Default Order Details</span><br>
        <span>Reciever's Name : <?=User::currentLoggedInUser()->name?></span><br>
        <span>Address : <?=User::currentLoggedInUser()->address?></span><br>
        <span>Reciever's Contact Number : <?=User::currentLoggedInUser()->mobile_number?></span><br>
    </div>
    <div>
        <a href="<?=SROOT?>">Use Default Details</a>
        <a href="<?=SROOT?>">Use Different Details</a>
    </div>
</body>
</html>