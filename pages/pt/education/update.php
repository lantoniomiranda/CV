<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $level = isset($_POST['level']) ? $_POST['level'] : '';
        $school = isset($_POST['school']) ? $_POST['school'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $stmt = $pdo->prepare('UPDATE education SET level = ?, school = ?, description = ? WHERE id = ?');
        $stmt->execute([$level, $school, $description,  $_GET['id']]);
        $msg = 'Updated Successfully';
    }

    $stmt = $pdo->prepare('SELECT * FROM education WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $education = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$education) {
        exit('Skill doesn\'t exist with that ID!');
    }
} else {
    exit('Id not specified.');
}

?>

<?= template_header('Read') ?>

<div class="content update">
    <h2>Update Course #<?= $education['id'] ?></h2>
    <form action="update.php?id=<?= $education['id'] ?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?= $education['id'] ?>" id="id" disabled>
        <label for="level">Level</label>
        <input type="text" name="level" placeholder="Level" value="<?= $education['level'] ?>" id="level">
        <label for="school">school</label>
        <input type="text" name="school" placeholder="school" value="<?= $education['school'] ?>" id="school">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Name" value="<?= $education['description'] ?>" id="description">
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

<?= template_footer() ?>