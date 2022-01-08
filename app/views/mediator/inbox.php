<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <style>
        .mail-box {
            border-collapse: collapse;
            border-spacing: 0;
            display: table;
            table-layout: fixed;
            width: 100%;
        }
        .inbox-body {
            padding: 20px;
        }
        .inbox-head {
            background: none repeat scroll 0 0 rgba(67, 157, 236, 0.673);
            border-radius: 0 4px 0 0;
            color: #fff;
            min-height: 80px;
            padding: 20px;
        }
        .inbox-head h3 {
            display: inline-block;
            font-weight: 300;
            margin: 0;
            padding-top: 6px;
        }
        .table-inbox {
            border: 1px solid #d3d3d3;
            margin-bottom: 0;
        }
        .table-inbox tr td {
            padding: 12px !important;
        }
        .table-inbox tr td:hover {
            cursor: pointer;
        }
        .table-inbox tr td .fa-star.inbox-started, .table-inbox tr td .fa-star:hover {
            color: #f78a09;
        }
        .table-inbox tr td .fa-star {
            color: #d5d5d5;
        }
        .table-inbox tr.unread td {
            background: none repeat scroll 0 0 #f7f7f7;
            font-weight: 600;
        }
        .view-mail a {
            color: #ff6c60;
        }
        ul {
            list-style-type: none;
            padding: 0px;
            margin: 0px;
        }
    </style>
    <?php include_once('css/base.php'); ?>
</head>
<body>

    <div class='container-fluid'>
        <?php if ($_SESSION['role']==='pharmacy') {?>
            <a role='button' class='mybtn btn btn-primary' href="<?=SROOT?>PharmacyDashboard">Go to Dashboard</a>
        <?php }else{?>
            <a role='button' class='mybtn btn btn-primary'href="<?=SROOT?>CustomerDashboard">Go to Dashboard</a>
        <?php } ?>
        <h1 class='header'>Inbox</h1><hr><br>
        <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Text Messages</h3>
                      </div>
                      <div class="inbox-body">
                      <?php if(isset($this->result) && !empty($this->result)){?>
                          <table class="table table-inbox table-hover">
                            <tbody>
                                <?php foreach($this->result as $row){
                                if($row->is_read){?>
                                <tr class="">
                                    <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                    <td class="view-message "><?php echo $row->subject ?></td>
                                    <td class="view-message inbox-small-cells"></td>
                                    <td class="view-message  text-right"><a href="<?=SROOT?>MediatorHandler/loadInbox/<?=$row->id?>">View</a></td> 
                                </tr>
                            <?php }else{?>
                                <tr class="unread">
                                    <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                    <td class="view-message "><?php echo $row->subject ?></td>
                                    <td class="view-message inbox-small-cells"></td>
                                    <td class="view-message  text-right"><a href="<?=SROOT?>MediatorHandler/loadInbox/<?=$row->id?>">View</a></td>
                                </tr>                        
                            <?php } }?>
                          </tbody>
                          </table>
                          <?php }else{
                            echo "<h3>No Text Messages to display</h3>";
                        }?>     
                      </div>
                  </aside>
        </div>
        <?php if($_SESSION['role'] === 'customer'){?>
        <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Seasonal Offer Notifications</h3>
                      </div>
                      <div class="inbox-body">
                      <?php if(isset($this->offer) && !empty($this->offer)){?>
                          <table class="table table-inbox table-hover">
                            <tbody>
                                <?php foreach($this->offer as $row){?>
                                    <tr class="unread">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row['sender_username'].'' ?> </td>
                                        <td class="view-message "><?php echo $row['subject'].'<br>'. $row['message'] ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>MediatorHandler/loadInbox/<?=$row->id?>">View</a></td>
                                    </tr>                        
                                <?php }?>
                          </tbody>
                          </table>
                          <?php }else{
                            echo "<h3>No Seasonal Offer Notifications to display</h3>";
                        }?>     
                      </div>
                  </aside>
        </div>
        <?php } ?>

        <?php if($_SESSION['role'] === 'customer'){?>
        <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Prefilled Form Notifications</h3>
                      </div>
                      <div class="inbox-body">
                      <?php if(isset($this->prefroms) && !empty($this->prefroms)){?>
                          <table class="table table-inbox table-hover">
                            <tbody>
                            <?php foreach($this->prefroms as $row){
                                    if($row->is_read){?>
                                    <tr class="">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message  ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td> 
                                    </tr>
                                <?php }else{?>
                                    <tr class="unread">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td>
                                    </tr>                        
                                <?php } }?>
                          </tbody>
                          </table>
                          <?php }else{
                            echo "<h3>No Prefilled Forms to display</h3>";
                        }?>     
                      </div>
                  </aside>
        </div>
        <?php } ?>

        <?php if($_SESSION['role'] === 'customer'){?>
        <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Order Status Notifications</h3>
                      </div>
                      <div class="inbox-body">
                      <?php if(isset($this->order) && !empty($this->order)){?>
                          <table class="table table-inbox table-hover">
                            <tbody>
                            <?php foreach($this->order as $row){
                                    if($row->is_read){?>
                                    <tr class="">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message  ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td> 
                                    </tr>
                                <?php }else{?>
                                    <tr class="unread">
                                    <tr class="">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td>
                                    </tr>
                                    </tr>                        
                                <?php } }?>
                          </tbody>
                          </table>
                          <?php }else{
                            echo "<h3>No Order Status Change to display</h3>";
                        }?>     
                      </div>
                  </aside>
        </div>
        <?php } ?>

        <?php if($_SESSION['role'] === 'pharmacy'){?>
        <div class="mail-box">
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>New Orders</h3>
                      </div>
                      <div class="inbox-body">
                      <?php if(isset($this->order) && !empty($this->order)){?>
                          <table class="table table-inbox table-hover">
                            <tbody>
                            <?php foreach($this->order as $row){
                                    if($row->is_read){?>
                                    <tr class="">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message  ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td> 
                                    </tr>
                                <?php }else{?>
                                    <tr class="unread">
                                    <tr class="">
                                        <td class="view-message  dont-show"><?php echo 'From: '.$row->sender_username.'' ?> </td>
                                        <td class="view-message "><?php echo $row->subject.'<br>'.$row->message ?></td>
                                        <td class="view-message  text-right"><a href="<?=SROOT?>OrderHandler/viewOrder/<?=$row->message_ref_id?>/<?=$row->id?>">View</a></td>
                                    </tr>
                                    </tr>                        
                                <?php } }?>
                          </tbody>
                          </table>
                          <?php }else{
                            echo "<h3>No New Orders to display</h3>";
                        }?>     
                      </div>
                  </aside>
        </div>
        <?php } ?>
    </div>

</body>
</html>