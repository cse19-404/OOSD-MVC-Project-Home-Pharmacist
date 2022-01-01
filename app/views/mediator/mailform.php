<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Form</title>
</head>
<body>
    <?php if(isset($this->mode) && !($this->mode === 'read-only') && !($this->mode === 'reply')){?>
        <div>
            <?php if(($_SESSION['role']==='pharmacy')){
                echo (" FROM : <span>". Pharmacy::currentLoggedInPharmacy()->name."</span><br><br>");
            }else{ 
                echo (" FROM : <span>". User::currentLoggedInUser()->name."</span><br><br>");
            }?>
            <?php if(isset($this->to) && $this->mode === 'us'){
                echo ("TO : <span>Home Pharmasist</span><br><br>");
            }else{ 
                echo ("TO : <span>".$this->to."</span><br><br>");
            }?>
        </div>
                <div>      
                <form action="<?=SROOT?>MediatorHandler/receiveMessage/<?= $this->mode?>/<?= $this->id?>" method="post">
                    Subject : <input type="text" name="subject" placeholder="Subject" required><br><br>
                    Message : <textarea name="message" cols="30" rows="10" placeholder="Message" required></textarea><br><br>
                    <input type="submit" value="Send">
                </form>
            </div> 
               
    <?php }
    if(isset($this->mode) && ($this->mode === 'read-only') && ($this->result->message_type === 'text')){?>
        <div>
                FROM : <span><?php echo $this->result->sender_username?></span><br><br>
                TO : <span><?php echo $this->result->receiver_username?></span><br><br>
                SUBJECT : <span><?php echo $this->result->subject?></span><br><br>
                MESSAGE : <span><?php echo $this->result->message ?></span><br><br>   
                
                <form action="<?=SROOT?>CustomerDashboard/replyTextMessage/<?= $this->result->id?>">
                    <input type="submit" value="Reply">
                </form>
        </div>

    <?php } if(isset($this->mode) && ($this->mode === 'reply')){?>
        <div>
            FROM : <span><?php echo $this->from?></span><br><br>
            TO : <span><?php echo $this->to?></span><br><br>    
            <form action="<?=SROOT?>MediatorHandler/receiveReply/<?= $this->id?>" method="post">
                Subject : <input type="text" name="subject" value='<?= $this->subject?>' placeholder="Subject" readonly><br><br>
                Message : <textarea name="message" cols="30" rows="10" placeholder="Message" required></textarea><br><br>
                <input type="submit" value="Send">
            </form>
        </div><?php 
        } ?>
        
        <br><br><a href="<?=SROOT?>CustomerDashboard/message">Go Back</a>    
    </body>
    </html>
