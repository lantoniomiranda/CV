<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $level = isset($_POST['level']) ? $_POST['level'] : '';
    $school = isset($_POST['school']) ? $_POST['school'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $stmt = $pdo->prepare('INSERT INTO education(level, school, description) VALUES (?, ?, ?)');
    $stmt->execute([$level, $school, $description]);
    $msg = 'Created Successfully!';
}

?>

<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Skill</h2>
    <form action="create.php" method="post">
        <label for="level">Level</label>
        <input type="text" name="level" placeholder="" id="level">
        <label for="school">School</label>
        <input type="text" name="school" placeholder="" id="level">
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="" id="description">
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