<?php

require "../../../db/connection.php";
require "../../../utils/functions.php";

$pdo = pdo_connect_mysql();
$msg = '';

$stmt = $pdo->prepare("DELETE FROM skills WHERE id=" . $_GET['id']);
$stmt->execute();
header("location: ./read.php");
exit;

if(isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM skills WHERE id=" . $_GET['id']);
    if(isset($_GET['confirm'])){
        if ($_GET['confirm'] == 'yes') {
            $stmt->execute();
            $msg = 'You have deleted the skill!';
        } else {
            header("location: ./read.php");
            exit;
        }
    }
}

?>
