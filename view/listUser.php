<div class="row">
	<div class="col-md-12 text-right">
		<a href="index.php?controller=sites&action=add" class="btn btn-outline-primary">Crear sitio</a>
	</div>
	<div class="row mt-3">
		<?php
		if(count($dataToView["data"])>0){
			foreach($dataToView["data"] as $site){
               
				?>
				<div class="col-md-4 mb-3 ">
						<div class="card border border-secondary h-100">
							<div class="card rounded p-3 h-100">
								<!-- Rellenar los datos del sitio -->
								<div class="row h-100">
									<div class="col-md-4 d-flex justify-content-center align-middle">
										<img style="width:100px; height:100px" src="<?php echo $site['image_url']; ?>" alt="<?php echo $site['title']; ?>" class="img-thumbnail img-fluid" >
									</div>
									<div class="col-md-8">
										<h4><?php echo $site['title']; ?></h4>
								<p><?php echo $site['description']; ?></p></div>
								</div>
								<hr class="mt-1"/>
								<!-- Enlaces para editar y eliminar -->
								<div class="row">
									<a href="index.php?controller=sites&action=edit&id=<?php echo $site['id']; ?>" class="col btn btn-primary m-2">Editar</a>
									<a href="index.php?controller=sites&action=delete&id=<?php echo $site['id']; ?>" class="col btn btn-danger m-2">Eliminar</a>
								</div>
							</div>
						</div>
					</div>

				<?php
			}
		}else{
			?>
			<div class="alert alert-info">
				Actualmente no existen notas.
			</div>
			<?php
		}
		?>
	</div>
</div>
