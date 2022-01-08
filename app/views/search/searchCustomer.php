<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Search Customer</title>
</head>
<style>
    .error {
        color: #FF0000;
    }

    .Appcontainer {
        z-index: 2;
        border-radius: 15px;
        background-color: #e9e9e9ed;
        height: 15%;
        width: 13cm;
        margin: auto;
        margin-top: 2cm;
        padding: 25px;
        padding-left: 30px;
        padding-right: 30px;
        box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
    }

    .alert-dismissible .btn-close{
        margin-top: 5.5px;
    }
</style>
<?php include_once('css/baseForm.php'); ?>

<body>
    <br><a class="btn btn-primary mybtn" role="button" href="<?= SROOT ?>PharmacyDashboard">Go Back</a>
    <header>
        <h2 class="header">Search Customer</h2>
    </header>
    <div class='container-fluid'>
        <div class="Appcontainer">
            <div>
                <form action="<?= SROOT ?>PharmacyDashboard/orderForCustomer" method="post">
                    <input class="form-control" type="text" name="customer-name" placeholder="Enter Customer name" required><br>
                    <div class="search-btn-div"><input class="btn btn-info" type="submit" value="Search"></div>
                </form>
                <br>
            </div>
            <?php if (isset($_SESSION['sentMsg'])) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>
                        <?php
                        echo $_SESSION['sentMsg'];
                        unset($_SESSION['sentMsg']);
                        ?>
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div>
                <?php if (isset($this->result) && !empty($this->result)) { ?>
                    <div>
                        <table>
                            <?php foreach ($this->result as $row) { ?>
                                <tr>
                                    <td><a href="<?= SROOT ?>PharmacyDashboard/loadForm/<?= $row->id ?>"><?php echo $row->name ?></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } elseif (isset($this->processed)) {
                    echo "<span>No Such User</span>";
                } ?>
            </div>
        </div>
    </div>
</body>

</html>