<?php

require "../../db/connection.php";
require "../../utils/functions.php";

$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$userType = $_SESSION["type"];

$stmt_skills = $pdo->prepare('SELECT * FROM skills ORDER BY id');
$stmt_contacts = $pdo->prepare('SELECT * FROM contacts');
$stmt_education = $pdo->prepare('SELECT * FROM education');
$stmt_experience = $pdo->prepare('SELECT * FROM experience');

$stmt_skills->execute();
$stmt_contacts->execute();
$stmt_education->execute();
$stmt_experience->execute();

$skills = $stmt_skills->fetchAll(PDO::FETCH_ASSOC);
$contacts = $stmt_contacts->fetchAll(PDO::FETCH_ASSOC);
$education = $stmt_education->fetchAll(PDO::FETCH_ASSOC);
$experience = $stmt_experience->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/cv-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Luís Miranda</title>
</head>

<body class="light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 left-colum">
                <figure class="text-center pt-5">
                    <img src="../../assets/Foto.png" class="img-fluid rounded mx-auto d-block pb-4" alt="Profile Picture">
                    <h2>Luís Miranda</h2>
                    <h5>Estudante</h5>
                </figure>
                <div class="text-center pb-5">
                    <div class="col-md-12">
                        <a href="https://www.linkedin.com/in/lmiranda30/" target="_blank" class="text-decoration-none">
                            <span class="h5">
                                <i class="bi bi-linkedin  p-1"></i>
                            </span>
                        </a>
                        <a href="https://github.com/lantoniomiranda" target="_blank" class="text-decoration-none">
                            <span class="h5">
                                <i class="bi bi-github  p-1"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="pb-4">
                    <h3 class="text-center"><span class="badge rounded-pill px-5 text-dark py-1">Contactos</span></h3>
                    <div class="p-2">
                        <ul class="list-unstyled text-center">
                            <?php foreach ($contacts as $contact) : ?>
                                <li class="p-2">
                                    <i class="bi bi-envelope"></i>
                                    <a href="mailto: luis.v.miranda30@gmail.com" class="text-decoration-none">
                                        <span class=""><?= $contact['email'] ?></span>
                                    </a>
                                </li>
                                <li class="p-2">
                                    <i class="bi bi-telephone"></i>
                                    <a href="tel: 963203467" class="text-decoration-none">
                                        <span class=""><?= $contact['phone'] ?></span>
                                    </a>
                                </li>
                                <li class="pt-2">
                                    <i class="bi bi-geo-alt"></i>
                                    <span><?= $contact['address'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="pb-4 pt-2 text-center">
                    <h3 class="text-center"><span class="badge rounded-pill px-5 text-dark py-2">Competências</span></h3>
                    <div class="p-2">
                        <ul class="list-unstyled">
                            <?php foreach ($skills as $skill) : ?>
                                <li class="p-3">
                                    <div class="progress w-50 center">
                                        <div class="progress-bar w-<?php echo $skill['level'] ?> bg-dark text-center text-white" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><?php echo $skill['description'] ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pt-5 px-4">
                <div class="header-right pb-4">
                    <h4 class="text-uppercase">experiência académica</h4>
                    <hr>
                    <ul class="list">
                        <?php foreach ($education as $edu) : ?>
                            <li class="list-item pb-4">
                                <h5 class="text-uppercase"><?= $edu['level'] ?></h5>
                                <h6 class="text-uppercase text-black-50"><?= $edu['school'] ?></h6>
                                <p>
                                    <?= $edu['description'] ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="header-right">
                    <h4 class="text-uppercase">experiência profissional</h4>
                    <hr>
                    <ul class="list">
                        <?php foreach ($experience as $exp) : ?>
                            <li class="list-item pb-4">
                                <h5 class="text-uppercase"><?= $exp['role'] ?></h5>
                                <h6 class="text-uppercase text-black-50"><?= $exp['company'] ?></h6>
                                <p>
                                    <?= $exp['description'] ?>
                                </p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="text-center pb-1">
                <?php 
                if($userType === 'Admin') {
                    echo template_admin();
                } else {
                    echo template_manager();
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>