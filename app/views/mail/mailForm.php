<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>
    <form action="<?=SROOT?>ApplicationHandler/decline/<?=$this->id?>" method="post">
        <label> Subject : </label> 
        <input type="text" name = 'subject'><br><br>
        <label> Reason for Decline : </label>
        <textarea name="msg" id="" cols="30" rows="10"></textarea>
        <br><br> <input type="submit" value="Send Message">
    </form>
</body>
</html>