<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";
$pdo = pdo_connect_mysql();
$msg = '';

$stmt = $pdo->prepare("DELETE FROM experience WHERE id=" . $_GET['id']);
$stmt->execute();
header("location: ./read.php");
exit;

?>
