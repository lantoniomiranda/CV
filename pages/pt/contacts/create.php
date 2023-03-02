<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?)');
    $stmt->execute([$email, $phone, $address]);
    $msg = 'Created Successfully!';
}

?>

<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Skill</h2>
    <form action="create.php" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="example@example.com" id="email">
        <label for="phone">Phone</label>
        <input type="text" name="phone" placeholder="911000111" id="phone">
        <label for="address">Address</label>
        <input type="text" name="address" placeholder="city, county" id="address">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg) : ?>
        <p><?php
            echo $msg;
            header("location: ../skills/read.php");
            exit;
            ?>
        </p>
    <?php endif; ?>
</div>

<?= template_footer() ?>