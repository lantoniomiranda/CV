<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";
$pdo = pdo_connect_mysql();
$msg = '';

if(isset($_GET['id'])) {
    if(!empty($_POST)) {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';

        $stmt = $pdo->prepare('UPDATE contacts SET email = ?, phone = ?, address = ? WHERE id = ?');
        $stmt->execute([$email, $phone, $address, $_GET['id']]);
        $msg = 'Updated Successfully';
    }

    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Skill doesn\'t exist with that ID!');
    }
}else{
    exit('Id not specified.');
}

?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update skill #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>        
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id" disabled>
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" value="<?=$contact['email']?>" id="email">
        <label for="phone">Phone</label>
        <input type="text" name="phone" placeholder="Phone" value="<?=$contact['phone']?>" id="phone">
        <label for="address">Address</label>
        <input type="text" name="address" placeholder="Address" value="<?=$contact['address']?>" id="address">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg) : ?>
        <p><?php
            echo $msg;
            header("location: ./read.php");
            exit;
            ?>
        </p>
    <?php endif; ?>
</div>

<?=template_footer()?>