<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pharmacy Account</title>
    <style>
        .bg-danger {
            color: #FF0000;
        }

        .Appcontainer {
            z-index: 2;
            border-radius: 15px;
            background-color: #e9e9e9ed;
            height: fit-content;
            width: fit-content;
            margin: auto;
            margin-top: 2cm;
            padding: 30px;
            padding-left: 30px;
            padding-right: 30px;
            box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
        }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>

<body>
    <?php if (isset($_SESSION['role']) && !strcmp($_SESSION['role'], 'super_admin')) { ?>
        <header style="padding-left: 20px">
            <a class="mybtn btn btn-primary" role="button" href="<?= SROOT ?>ApplicationHandler/viewApproved">Go to Approved Applications</a>
            <h2 class="header">Pharmacy Account Creation Form</h2>
        </header>
        <div class='container-fluid'>
            <?php $application = (array)$this->application; ?>
            <div class="Appcontainer">
                <div class='bg-danger'>
                    <?php if (isset($this->displayErrors)) {
                        echo $this->displayErrors;
                    } ?>
                </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label>Pharmacy Name:</label> <input class="form-control" type="text" name="name" value="<?php echo $application["pharmacy_name"]; ?>" required>
                    <br><br>
                    <label>E-mail:</label> <input class="form-control" type="email" name="email" value="<?php echo $application["email"]; ?>" required>
                    <br><br>
                    <label>Location</label><br><label> Latitude</label>: <input class="form-control" type="text" name="latitude" value="<?php echo $application["latitude"]; ?>" required>
                    <label>Longitude:</label> <input class="form-control" type="text" name="longitude" value="<?php echo $application["longitude"]; ?>" required>
                    <br><br>
                    <label>Delivery Supported:</label> <input type="checkbox" name="delivery_supported" <?php if ($application["delivery_supported"]) {
                                                                                                            echo "checked";
                                                                                                        } ?>>
                    <br><br>
                    <label>Address:</label> <input class="form-control" type="text" name="address" value="<?php echo $application["address"]; ?>" required>
                    <br><br>
                    <label>Contact Number:</label> <input class="form-control" type="text" name="contact_number" value="<?php echo $application["contact_no"]; ?>" required>
                    <br><br>
                    <label>License no.:</label> <input class="form-control" type="text" name="License_no" required>
                    <br><br>
                    <label>Username:</label> <input class="form-control" type="text" name="username" value="<?php echo $application["pharmacy_name"]; ?>" required>
                    <br><br>
                    <label>Password:</label> <input class="form-control" type="password" name="password" required>
                    <br><br>
                    <label>Re-Enter Password:</label> <input class="form-control" type="password" name="repassword" required>
                    <br><br>
                    <input class="btn btn-success" type="submit" name="submit" value="Submit">
                </form>

            <?php } else {
            header('Location: index.php');
        } ?>
            </div>
        </div>

</body>

</html>