<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 20;

$stmt = $pdo->prepare('SELECT * FROM contacts');
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?> 

<?=template_header('Read')?> 

<div class="content read">
	<h2>Skills</h2>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Address</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['phone']?></td>
                <td><?=$contact['address']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="bi bi-pencil"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>