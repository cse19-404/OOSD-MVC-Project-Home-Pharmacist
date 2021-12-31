<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Form</title>
</head>
<body>
    <div>
        FROM : <span><?= User::currentLoggedInUser()->name ?></span><br><br>
        <?php if(isset($this->to) && $this->mode === 'us'){
            echo ("TO : <span>Home Pharmasist</span><br><br>");
         }else{ 
            echo ("TO : <span>$this->to</span><br><br>");
         }?>
    </div>
    <div>
        <form action="<?=SROOT?>MediatorHandler/receivePharmacyMessage/<?= $this->mode?>/<?= $this->id?>" method="post">
            Subject : <input type="text" name="subject" placeholder="Subject"><br><br>
            Message : <input type="text" name="message" placeholder="Message"><br><br>
            <input type="submit" value="Send">
        </form>
    </div>
</body>
</html>