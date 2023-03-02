<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $stmt = $pdo->prepare('INSERT INTO experience(role, company, description) VALUES (?, ?, ?)');
    $stmt->execute([$role, $company, $description]);
    $msg = 'Created Successfully!';
}

?>

<?= template_header('Create') ?>

<div class="content update">
    <h2>Create Skill</h2>
    <form action="create.php" method="post">
        <label for="role">Role</label>
        <input type="text" name="role" placeholder="" id="role">
        <label for="company">Company</label>
        <input type="text" name="company" placeholder="" id="company">
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