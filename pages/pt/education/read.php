<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 20;

$stmt = $pdo->prepare('SELECT * FROM education ORDER BY id');
$stmt->execute();
$education = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 

<?=template_header('Read')?>

<div class="content read">
	<h2>Skills</h2>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Level</td>
                <td>School</td>
                <td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($education as $edu): ?>
            <tr>
                <td><?=$edu['id']?></td>
                <td><?=$edu['level']?></td>
                <td><?=$edu['school']?></td>
                <td><?=$edu['description']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$edu['id']?>" class="edit"><i class="bi bi-pencil"></i></a>
                    <a href="delete.php?id=<?=$edu['id']?>" class="trash"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button class="mt-3 btn btn-outline-secondary"><a href="create.php" class="create-skill text-dark text-decoration-none">Create Education</a></button>
</div>

<?=template_footer()?>