<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Customer</title>
</head>
<body>
    <span>
        <?php if(isset($_SESSION['sentMsg'])){
            echo $_SESSION['sentMsg'];
            unset($_SESSION['sentMsg']);
        }?>
    </span>
    <div>
        <form action="<?=SROOT?>PharmacyDashboard/orderForCustomer" method="post">
            <input type="text" name="customer-name" placeholder="Enter Customer name" required>
            <input type="submit" value="Search">
        </form>  
    </div>
    <div>
    <?php if(isset($this->result) && !empty($this->result)){?>
                <div>
                    <table>
                        <?php foreach($this->result as $row){?>
                            <tr>
                                <td><a href="<?=SROOT?>PharmacyDashboard/loadForm/<?=$row->id?>"><?php echo $row->name?></a></td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
            <?php }elseif(isset($this->processed)){
                echo "<h3>No Such User</h3>";
            }?>
    </div>
    <br><br><a href="<?=SROOT?>PharmacyDashboard">Go Back</a>
</body>
</html>