<div class="row">
    <div class="col-md-10">
        <div class="row mt-3">
        <form method="post" action="index.php?controller=sites&action=listByCategoryAndRating" class="form-inline mb-3">
            <div class="form-group mr-2">
                <label for="category" class="mr-2">Categoría:</label>
                <select class="form-control" name="category_id" id="category" required>
                    <option value="0">Todos</option>                  
                    <option value="1">Programación</option>
                    <option value="2">Diseño</option>
                    <option value="3">Idiomas</option>
                    <option value="4">Ciencias</option>
                    <option value="5">Arte</option>
                </select>
            </div>
            <div class="form-group mr-2">
    <label for="min_rating" class="mr-2">Calificación mínima:</label>
    <input type="number" class="form-control" name="min_rating" id="min_rating" value="0" min="0" max="5" placeholder="Calificación mínima" required>
</div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
            <?php
            if (count($dataToView["data"]["data"]) > 0) {
                foreach ($dataToView["data"]["data"] as $site) {
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="card border border-secondary h-100">
                            <div class="card rounded p-3">
                                <!-- Rellenar los datos del sitio -->
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center align-middle">
                                <a href="<?php echo $site['url']; ?>" target="_blank">
                                    <img
                                    class="object-fit-cover border rounded img-thumbnail img-fluid"
                                    style="width: 100px; height: 100px"
                                    src="<?php echo $site['image_url']; ?>"
                                    alt="<?php echo $site['title']; ?>"
                                    onerror="cargarImagenPorDefecto(this)"
                                    />
                                </a>

                                </div>
                                    <div class="col-md-8">
                                        <h4 ><a href="index.php?controller=sites&action=details&id=<?php echo $site['id']; ?>" style="text-decoration: none;" class="text-primary"><?php echo $site['title']; ?></a></h4>
                                        <p><?php echo $site['description']; ?></p>
                                        <p class="text-warning"><?php echo number_format($site['average_rating'], 1); ?> ☆</p>
                                        <p class="text-secondary"><?php echo $site['category']; ?></p>
                                    </div>
                                </div>
                                   <!-- Sección de estrellas -->
                              
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-info">
                    Actualmente no existen notas.
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="d-none d-md-block col-md-2">
        <div class="row mt-3">
            <h1>TOP 5</h1>
            <?php
            if (count($dataToView["data"]["topFive"]) > 0) {
                foreach ($dataToView["data"]["topFive"] as $site) {
                    ?>
                    <div class="col-md-12 mb-3">
                        <div class="card border border-light">
                            <div class="card rounded p-3">
                                <!-- Rellenar los datos del sitio -->
                                <div class="row">
                                    <a href="<?php echo $site['url']; ?>" target="_blank">
                                        <img class="object-fit-cover border rounded img-thumbnail img-fluid" 
                                        style="width:100%; height:100px" 
                                        src="<?php echo $site['image_url']; ?>" 
                                        alt="<?php echo $site['title']; ?>"
                                        onerror="cargarImagenPorDefecto(this)"
                                        >
                                    </a>
                                    <h5><a href="index.php?controller=sites&action=details&id=<?php echo $site['id']; ?>" style="text-decoration: none;" class="text-primary"><?php echo $site['title']; ?></a></h5>
                                        <p class="text-warning"><?php echo number_format($site['average_rating'], 1); ?> ☆</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<script>
function cargarImagenPorDefecto(img) {
    img.onerror = null; // Evita bucles infinitos si la imagen por defecto también falla
    img.src = 'https://cdn-icons-png.flaticon.com/512/5996/5996637.png';
    img.alt = 'default image';
}
</script>