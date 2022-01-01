<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
</head>
<body>
    <h1>Message Portral - Inbox</h1>
        <?php if(isset($this->result) && !empty($this->result)){?>
            <div>
                <table>
                    <?php foreach($this->result as $row){
                        if($row->is_read){?>
                        <tr style="background-color:blanchedalmond">
                            <td><a href="<?=SROOT?>MediatorHandler/loadInbox/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'   ' . ucwords($row->message_type).' Message</pre>'?></a></td>
                        </tr>
                    <?php }else{?>
                        <tr>
                            <td><a href="<?=SROOT?>MediatorHandler/loadInbox/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'   ' . ucwords($row->message_type).' Message</pre>'?></a></td>
                        </tr>                        
                    <?php } }?>
                </table>
            </div>
        <?php }elseif(isset($this->processed)){
            echo "<h3>No result found</h3>";
        }?>
</body>
</html>