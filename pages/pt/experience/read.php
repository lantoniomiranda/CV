<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 20;

$stmt = $pdo->prepare('SELECT * FROM experience ORDER BY id');
$stmt->execute();
$experience = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 

<?=template_header('Read')?>

<div class="content read">
	<h2>Skills</h2>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Role</td>
                <td>Company</td>
                <td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($experience as $exp): ?>
            <tr>
                <td><?=$exp['id']?></td>
                <td><?=$exp['role']?></td>
                <td><?=$exp['company']?></td>
                <td><?=$exp['description']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$exp['id']?>" class="edit"><i class="bi bi-pencil"></i></a>
                    <a href="delete.php?id=<?=$exp['id']?>" class="trash"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button class="mt-3 btn btn-outline-secondary"><a href="create.php" class="create-skill text-dark text-decoration-none">Create Experience</a></button>
</div>

<?=template_footer()?>