<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Customer</title>
</head>
<style>
    .error {color: #FF0000;}
    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height:15%;
        width: 13cm;
        margin: auto;
        margin-top: 2cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }
    </style>
    <?php include_once('css/baseForm.php'); ?>
<body>
   
    <div class='container-fluid'>
        <h2 class="header">Search Customer</h2>
        <div class="Appcontainer">
            <span>
                <?php if(isset($_SESSION['sentMsg'])){
                    echo $_SESSION['sentMsg'];
                    unset($_SESSION['sentMsg']);
                }?>
            </span>
            <div>
                <form action="<?=SROOT?>PharmacyDashboard/orderForCustomer" method="post">
                    <input class="form-control" type="text" name="customer-name" placeholder="Enter Customer name" required><br>
                    <div class="search-btn-div"><input  class="btn btn-info" type="submit" value="Search"></div>
                </form>
                <br>  
            </div>
            <div>
            <?php if(isset($this->result) && !empty($this->result)){?>
                        <div>
                            <table>
                                <?php foreach($this->result as $row){?>
                                    <tr>
                                        <td><a class="btn btn-light" role="button" href="<?=SROOT?>PharmacyDashboard/loadForm/<?=$row->id?>"><?php echo $row->name?></a></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    <?php }elseif(isset($this->processed)){
                        echo "<span>No Such User</span>";
                    }?>
            </div>
            </div>
        <br><br><a class="btn btn-primary" role="button" href="<?=SROOT?>PharmacyDashboard">Go Back</a>
        </div>
</body>
</html>