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
    <div>
        <h2>Text Messages</h2>
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
            <?php }else{
                echo "<h3>No Text Messages to display</h3>";
            }?>                
    </div>

    <div>
        <?php if($_SESSION['role'] === 'customer'){?>
            <h2>Seasonal Offer Notifications</h2>
            <?php if(isset($this->offer) && !empty($this->offer)){?>
                <div>
                    <table>
                        <?php foreach($this->offer as $row){?>
                            <tr>
                                <td><a href="<?=SROOT?>SeasonalOfferHandler/view"><?php echo '<pre>Subject : ' .$row['subject'].'<br>'.ucwords($row['message_type']).' from '.$row['sender_username'] .'<br>'.$row['message'].' with the description : <br>'.$row['description'].'</pre>'?></a></td>
                            </tr>                     
                    </table>
                </div>              
        <?php } }else{
                echo "<h3>No Seasonal Offer Notifications to display</h3>";
        }}?> 
    </div>

    <div>
        <?php if($_SESSION['role'] === 'customer'){?>
            <h2>Prefilled Form Notifications</h2>
            <?php if(isset($this->prefroms) && !empty($this->prefroms)){?>
                <div>
                    <table>
                        <?php foreach($this->prefroms as $row){
                            if($row->is_read){?>
                            <tr style="background-color:blanchedalmond">
                            <td><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>' . ucwords($row->message_type).' Message : '.$row->message.'</pre>'?></a></td>
                            </tr>
                        <?php }else{?>
                            <tr>
                                <td><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>' . ucwords($row->message_type).' Message : '.$row->message.'</pre>'?></a></td>
                            </tr>                        
                        <?php } }?>
                    </table>
                </div>
            <?php }else{
                echo "<h3>No Prefilled Forms to display</h3>";
            }}?>   
    </div>

    <div>
        <?php if($_SESSION['role'] === 'customer'){?>
            <h2>Order Status Notifications</h2>
            <?php if(isset($this->order) && !empty($this->order)){?>
                <div>
                    <table>
                        <?php foreach($this->order as $row){
                            if($row->is_read){?>
                            <tr style="background-color:blanchedalmond">
                            <td><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>' . ucwords($row->message_type).' Message : '.$row->message.'</pre>'?></a></td>
                            </tr>
                        <?php }else{?>
                            <tr>
                                <td><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>' . ucwords($row->message_type).' Message : '.$row->message.'</pre>'?></a></td>
                            </tr>                        
                        <?php } }?>
                    </table>
                </div>
            <?php }else{
                echo "<h3>No Order Status Change to display</h3>";
            }}?>   
    </div>

    <div>
        <?php if($_SESSION['role'] === 'pharmacy'){?>
            <h2>New Orders</h2>
            <?php if(isset($this->order) && !empty($this->order)){?>
                <div>
                    <table>
                        <?php foreach($this->order as $row){
                            if($row->is_read){?>
                            <tr style="background-color:blanchedalmond">
                            <td><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>' .$row->message.'</pre>'?></a></td>
                            </tr>
                        <?php }else{?>
                            <tr>
                                <td><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>"><?php echo '<pre>From: '.$row->sender_username .'   Subject : ' .$row->subject.'<br>'.$row->message.'</pre>'?></a></td>
                            </tr>                        
                        <?php } }?>
                    </table>
                </div>
            <?php }else{
                echo "<h3>No Order Status Change to display</h3>";
            }}?>   
    </div>

    <?php if ($_SESSION['role']==='pharmacy') {?>
        <a href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
    <?php }else{?>
        <a href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
    <?php } ?>

</body>
</html>