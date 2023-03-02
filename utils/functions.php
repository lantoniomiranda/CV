<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../auth/login.php");
    exit;
}

function template_header($title) {
	$username  = $_SESSION["username"];

echo <<<EOT
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
    		<h1>Hello $username </h1>
			<a href="../../auth/logout.php">Logout</a>
			<a href="./pages/dashboard/dashboard.php"><i class="bi bi-house"></i></a>
    	</div>
    </nav>
EOT;
}

function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}

function template_admin() {

echo <<<EOT
<button id="btn" type="button" class="badge rounded-pill border-white btn btn-dark text-white px-4">
     <a href="../dashboard/dashboard.php" class="text-decoration-none text-white">Dashboard</a>
</button>
<button type="button" class="badge rounded-pill border-white btn btn-dark text-white px-4">
    <a href="../../auth/logout.php" class="text-decoration-none text-white">Logout</a>
</button>
EOT;
}

function template_manager() {

echo <<<EOT
	<button id="btn" type="button" class="badge rounded-pill border-white btn btn-dark text-white px-4">
		 <a href="./contact.html" class="text-decoration-none text-white">Contacte-me</a>
	</button>
	<button type="button" class="badge rounded-pill border-white btn btn-dark text-white px-4">
		<a href="../../auth/logout.php" class="text-decoration-none text-white">Logout</a>
	</button>
EOT;
}


?>
