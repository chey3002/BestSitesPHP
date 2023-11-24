<div class="row">
	<form class="form container" action="index.php?controller=note&action=delete" method="POST">
		<div class="card ">

			<input type="hidden" name="id" value="<?php echo $dataToView["data"]["id"]; ?>" />
			<div class="alert alert-dismissible alert-warning m-3 ">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<h4 class="alert-heading">¿Desea eliminar esta nota? </h4>
				
				<i><?php echo $dataToView["data"]["title"]; ?></i>
			</div>
			<div class="row mb-3">
				<input type="submit" value="Eliminar" class="btn btn-danger col-md-5 ms-3 me-auto"/>
				<a class="btn btn-outline-success col-md-5 me-3" href="index.php?controller=user&action=dashboard">Cancelar</a>
			</div>
		</div>
	</form>
</div>
