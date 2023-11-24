<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $controller->page_title; ?></title>
	<link rel="stylesheet" href="https://bootswatch.com/5/vapor/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
	<?php if (isset($_SESSION['user_id'])) {?>
	<header class="mb-5">
		<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">BS</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarColor01">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
					<a class="nav-link" href="index.php?controller=sites&action=list_by_user">Home</a>

					</li>
					
				</ul>
				<div class="d-flex ">
					<h5 class="align-middle m-auto me-3 navbar-brand text-uppercase"><?php echo  $_SESSION['username']; ?></h5>
					<a href="index.php?controller=user&action=logout" class="btn btn-outline-danger">Cerrar sesión</a>
					</div>
				</div>
			</div>
		</nav>
			
		</header>
		<?php }?>
	<div class="container">
		
	<?php require_once 'view/template/alerts.php'?>