<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<style>
    .bg-danger {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 10%;
        width: 30%;
        margin: auto;
        margin-top: 1cm;
        padding: 30px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
      }
</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        <h2 class="header">Decline Pharmacy Application</h2>
        <div class="Appcontainer">
            <form action="<?=SROOT?>ApplicationHandler/decline/<?=$this->id?>" method="post">
                <label> Subject : </label> 
                <input class="form-control" type="text" name = 'subject'><br><br>
                <label> Reason for Decline : </label>
                <textarea class="form-control" name="msg" id="" cols="30" rows="10"></textarea>
                <br><br> <input class="btn btn-success" type="submit" value="Send Message">
            </form>
        </div>
    </div>
</body>
</html>