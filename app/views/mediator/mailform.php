<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Form</title>
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

    .spacinglabels{
        margin-top: 30px;
    }

</style>
<?php include_once('css/baseForm.php'); ?>
<body>
    <div class='container-fluid'>
        
            <?php if(isset($this->mode) && !($this->mode === 'read-only') && !($this->mode === 'reply')){?>
                <h2 class="header">Compose Message</h2>
                <div class="Appcontainer">
                    <div>
                        
                        <?php if(($_SESSION['role']==='pharmacy')){?>
                            <span class="spacinglabels">FROM : <?= Pharmacy::currentLoggedInPharmacy()->name?> </span><br><br>
                        <?php }else{?>
                            <span class="spacinglabels">FROM : <?= User::currentLoggedInUser()->name?></span><br><br>
                        <?php }?>
                        <?php if(isset($this->to) && $this->mode === 'us'){?>
                            <span class="spacinglabels" >TO : Home Pharmasist</span><br><br><br>
                        <?php }else{?>
                            <span class="spacinglabels">TO : <?= $this->to?></span><br><br><br>
                        <?php } ?>
                        

                        <!-- <?php if(($_SESSION['role']==='pharmacy')){
                            echo (" FROM : <span>". Pharmacy::currentLoggedInPharmacy()->name."</span><br><br>");
                        }else{ 
                            echo (" FROM : <span>". User::currentLoggedInUser()->name."</span><br><br>");
                        }?>
                        <?php if(isset($this->to) && $this->mode === 'us'){
                            echo ("TO : <span>Home Pharmasist</span><br><br>");
                        }else{ 
                            echo ("TO : <span>".$this->to."</span><br><br>");
                        }?> -->
                    </div>
                    <div>      
                        <form action="<?=SROOT?>MediatorHandler/receiveMessage/<?= $this->mode?>/<?= $this->id?>" method="post">
                            Subject : <input class="form-control" type="text" name="subject" placeholder="Subject" required><br><br>
                            Message : <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message" required></textarea><br><br>
                            <input class="btn btn-info" type="submit" value="Send">
                        </form>
                    </div>
                </div>
            <?php }
            if(isset($this->mode) && ($this->mode === 'read-only') && ($this->result->message_type === 'text')){?>
                <h2 class="header"><?= $this->result->subject?></h2>
                <div class="Appcontainer">
                    <div>
                        
                        <span class="spacinglabels">FROM : <?php echo $this->result->sender_username?></span><br><br>
                        <span class="spacinglabels">TO : <?php echo $this->result->receiver_username?></span><br><br><br>
                        
                        Subject : <input class="form-control" type="text" placeholder="Subject" value=<?= $this->result->subject?> readonly><br><br>
                        Message : <textarea class="form-control" cols="30" rows="10" placeholder="Message" value=<?= $this->result->message?> readonly></textarea><br><br>

                            <!-- FROM : <span><?php echo $this->result->sender_username?></span><br><br>
                            TO : <span><?php echo $this->result->receiver_username?></span><br><br>
                            SUBJECT : <span><?php echo $this->result->subject?></span><br><br>
                            MESSAGE : <span><?php echo $this->result->message ?></span><br><br>    -->
                            
                        <form action="<?=SROOT?>CustomerDashboard/replyTextMessage/<?= $this->result->id?>">
                            <input class="btn btn-info" type="submit" value="Reply">
                        </form>
                    </div>
                </div>

            <?php } if(isset($this->mode) && ($this->mode === 'reply')){?>
                <h1 class="header">Reply Message</h1>
                <div class="Appcontainer">
                    <div>
                        
                        <span class="spacinglabels">FROM : <?= $this->from?></span><br><br>
                        <span class="spacinglabels">TO : <?= $this->to?></span><br><br><br>
                        
                        <form action="<?=SROOT?>MediatorHandler/receiveReply/<?= $this->id?>" method="post">
                            Subject : <input class="form-control" type="text" name="subject" value='<?= $this->subject?>' placeholder="Subject" readonly><br><br>
                            Message : <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message" required></textarea><br><br>
                            <input class="btn btn-info" type="submit" value="Send">
                        </form>
                    </div>
                    

                    <!-- <div>
                        FROM : <span><?php echo $this->from?></span><br><br>
                        TO : <span><?php echo $this->to?></span><br><br>    
                        <form action="<?=SROOT?>MediatorHandler/receiveReply/<?= $this->id?>" method="post">
                            Subject : <input type="text" name="subject" value='<?= $this->subject?>' placeholder="Subject" readonly><br><br>
                            Message : <textarea name="message" cols="30" rows="10" placeholder="Message" required></textarea><br><br>
                            <input type="submit" value="Send">
                        </form>
                    </div> -->
                    <?php } ?>
                </div>          
                <br><br><a role="button" class="btn btn-success" href="<?=SROOT?>CustomerDashboard/message">Go Back</a>
    </div> 
</body>
</html>
