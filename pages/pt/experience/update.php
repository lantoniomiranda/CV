<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $role = isset($_POST['role']) ? $_POST['role'] : '';
        $company = isset($_POST['company']) ? $_POST['company'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $stmt = $pdo->prepare('UPDATE experience SET role = ?, company = ?, description = ? WHERE id = ?');
        $stmt->execute([$role, $company, $description,  $_GET['id']]);
        $msg = 'Updated Successfully';
    }

    $stmt = $pdo->prepare('SELECT * FROM experience WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $experience = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$experience) {
        exit('Skill doesn\'t exist with that ID!');
    }
} else {
    exit('Id not specified.');
}

?>

<?= template_header('Read') ?>

<div class="content update">
    <h2>Update Course #<?= $experience['id'] ?></h2>
    <form action="update.php?id=<?= $experience['id'] ?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?= $experience['id'] ?>" id="id" disabled>
        <label for="role">Role</label>
        <input type="text" name="role" placeholder="role" value="<?= $experience['role'] ?>" id="role">
        <label for="company">Company</label>
        <input type="text" name="company" placeholder="company" value="<?= $experience['company'] ?>" id="company">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Name" value="<?= $experience['description'] ?>" id="description">
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