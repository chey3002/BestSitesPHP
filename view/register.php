
<div class="row col-md-8 min-vh-100 m-auto ">
	<form class="form container m-auto" action="index.php?controller=user&action=register" method="POST">
		<div class="card ">
			<div class="form-group mb-3 mt-3">
				<label for="username"><i>Nombre de usuario</i></label>
				<input class="form-control" type="text" name="username" required />
			</div>
			<div class="form-group mb-3">
				<label for="password"><i>Contraseña</i></label>
				<input class="form-control" type="password" name="password" required />
			</div>
			<div class="row">
				<input type="submit" value="Registrarse" class="btn btn-primary col-md-5 ms-3 me-auto"/>
				<a class="btn btn-outline-secondary col-md-5 me-3" href="index.php?controller=user&action=login">Iniciar sesión</a>
			</div>
		</div>
	</form>
</div>
