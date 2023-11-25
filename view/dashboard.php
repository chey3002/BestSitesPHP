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
                                <img
                                class="object-fit-cover border rounded img-thumbnail img-fluid"
                                style="width: 100px; height: 100px"
                                src="<?php echo $site['image_url']; ?>"
                                alt="<?php echo $site['title']; ?>"
                                onerror="cargarImagenPorDefecto(this)"
                                />

                                </div>
                                    <div class="col-md-8">
                                        <h4><?php echo $site['title']; ?></h4>
                                        <p><?php echo $site['description']; ?></p>
                                        <p><?php echo number_format($site['average_rating'], 1); ?> ☆</p>
                                        <p><?php echo $site['category']; ?></p>
                                    </div>
                                </div>
                                   <!-- Sección de estrellas -->
                                <form action="index.php?controller=stars&action=calificar" method="post">
                                    <div class="container d-flex justify-content-center mt-6">
                                        <div class="rate py-1 text-white mt-2 row">
                                            <h6 class="mb-0">Califica la página</h6>
                                            <div class="rating col">
                                                <?php
                                                // Usa la ID del sitio para crear identificadores únicos
                                                $siteRatingId = 'rating_' . $site['id'];

                                                // Utiliza una variable única para cada conjunto de estrellas
                                                $ratingValue = isset($_POST[$siteRatingId]) ? $_POST[$siteRatingId] : 3;

                                                for ($i = 5; $i >= 1; $i--) :
                                                ?>
                                                    <input type="radio" name= "rating" value="<?php echo $i; ?>" id="<?php echo $siteRatingId . '_' . $i; ?>" <?php echo ($ratingValue == $i) ? 'checked' : ''; ?>>
                                                    <label for="<?php echo $siteRatingId . '_' . $i; ?>">☆</label>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="buttons px-4 mt-3 text-center col">
                                                <!-- Agregado el campo oculto para enviar el ID del sitio -->
                                                <input type="hidden" name="site_id" value="<?php echo $site['id']; ?>">
                                                <button type="submit" class="btn btn-primary pt-1 pb-1 btn-block rating-submit">Enviar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                                    <img class="object-fit-cover border rounded img-thumbnail img-fluid" 
                                    style="width:100%; height:100px" 
                                    src="<?php echo $site['image_url']; ?>" 
                                    alt="<?php echo $site['title']; ?>"
                                    onerror="cargarImagenPorDefecto(this)"
                                    >
                                    <h5><?php echo $site['title']; ?></h5>
                                        <p><?php echo number_format($site['average_rating'], 1); ?> ☆</p>
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