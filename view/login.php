
<div class="row col-12  col-md-8 min-vh-100 m-auto ">
	<form class="form container m-auto" action="index.php?controller=user&action=login" method="POST">
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
				<input type="submit" value="Iniciar sesión" class="btn btn-primary col-md-5 ms-md-3 me-auto"/>
				<a class="btn btn-outline-info col-md-5 me-3" href="index.php?controller=user&action=register">Registrarse</a>
			</div>
		</div>
	</form>
</div>
