<?php

require "../../db/connection.php";
require "../../utils/functions.php";
$username  = $_SESSION["username"];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/CV/css/crud-style.css" type="text/css">
</head>

<body>
    <nav class="navtop">
        <div>
            <h1>Hello <?=$username?></h1>
            <a href="../pt/index.php">CV</a>
            <a href="../pt/contacts/read.php">Contactos</a>
            <a href="../pt/skills/read.php">Skills</a>
            <a href="../pt/education/read.php">Educação</a>
            <a href="../pt/experience/read.php">Experiência</a>
            <a href="../../auth/logout.php">Logout</a>
        </div>
    </nav>
</body>

</html>