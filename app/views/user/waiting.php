<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting</title>
    <style>
        .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 6cm;
        width: 16cm;
        margin: auto;
        margin-top: 1cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
        text-align: center;
        color: darkblue;
      }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>
<body>
    <div class="Appcontainer">
        <h2>Near By Pharmacies Lists Updated for every user</h2>
        <br><br><a role='button' class='btn btn-primary' href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
    </div>
</body>
</html>