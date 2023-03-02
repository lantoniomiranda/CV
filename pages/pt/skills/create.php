<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $level = isset($_POST['level']) ? $_POST['level'] : '';
    $stmt = $pdo->prepare('INSERT INTO skills(description, level) VALUES (?, ?)');
    $stmt->execute([$description, $level]);
    $msg = 'Created Successfully!';
}

?>

<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Skill</h2>
    <form action="create.php" method="post">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="e.g. Kotlin" id="name">
        <label for="level">Level</label>
        <input type="text" name="level" placeholder="0 25 50 75 100" id="level">
        <input type="submit" value="Create">
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