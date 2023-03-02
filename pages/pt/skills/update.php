<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

if(isset($_GET['id'])) {
    if(!empty($_POST)) {
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $level = isset($_POST['level']) ? $_POST['level'] : '';

        $stmt = $pdo->prepare('UPDATE skills SET description = ?, level = ? WHERE id = ?');
        $stmt->execute([$description, $level, $_GET['id']]);
        $msg = 'Updated Successfully';
    }

    $stmt = $pdo->prepare('SELECT * FROM skills WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $skill = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$skill) {
        exit('Skill doesn\'t exist with that ID!');
    }
}else{
    exit('Id not specified.');
}

?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update skill #<?=$skill['id']?></h2>
    <form action="update.php?id=<?=$skill['id']?>" method="post">
        <label for="id">ID</label>        
        <input type="text" name="id" placeholder="1" value="<?=$skill['id']?>" id="id" disabled>
        <label for="description">Description</label>
        <input type="text" name="description" placeholder="Name" value="<?=$skill['description']?>" id="description">
        <label for="level">Level</label>
        <input type="text" name="level" placeholder="Level" value="<?=$skill['level']?>" id="level">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>