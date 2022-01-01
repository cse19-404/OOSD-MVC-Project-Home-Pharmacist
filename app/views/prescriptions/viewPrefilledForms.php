<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefilled Forms</title>
</head>
<body>
    <table>
        <tr>
            <th>Pharmacy name</th>
            <th>Status</th>
        </tr>
        <?php if(isset($this->prefilledForms)){foreach($this->prefilledForms as $id=>$form){?>
            <tr>
                <td><?=$this->data[$id]?></td>
                <td><?=$form->no_of_items . " out of " . $form->no_of_all_item . " Items Availale"?></td>
                <td><a href="<?=SROOT?>PrefilledformHandler/viewForm/<?=$id?>">View Form</a></td>
            </tr>
        <?php }}?>
    </table>
</body>
</html>