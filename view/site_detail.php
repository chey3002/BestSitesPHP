<?php
// Tu código PHP para obtener los datos
$id = $title = $content = $description = $category = $image = $user = $averageRating = $userName = $categoryname = "";

if (isset($dataToView["data"]["data"]["id"])) $id = $dataToView["data"]["data"]["id"];
if (isset($dataToView["data"]["data"]["title"])) $title = $dataToView["data"]["data"]["title"];
if (isset($dataToView["data"]["data"]["url"])) $content = $dataToView["data"]["data"]["url"];
if (isset($dataToView["data"]["data"]["description"])) $description = $dataToView["data"]["data"]["description"];
if (isset($dataToView["data"]["data"]["category_id"])) $category = $dataToView["data"]["data"]["category_id"];
if (isset($dataToView["data"]["data"]["image_url"])) $image = $dataToView["data"]["data"]["image_url"];
if (isset($dataToView["data"]["data"]["user_id"])) $user = $dataToView["data"]["data"]["user_id"];
$averageRating =isset($dataToView["data"]["data"]["average_rating"])? $dataToView["data"]["data"]["average_rating"]:0;
if (isset($dataToView["data"]["data"]["user_name"])) $userName = $dataToView["data"]["data"]["user_name"];
if (isset($dataToView["data"]["data"]["category_name"])) $categoryname = $dataToView["data"]["data"]["category_name"];
if(isset($dataToView["data"]["rating"]["rating"]))$user_rating=$dataToView["data"]["rating"]["rating"];
if(isset($dataToView["data"]["siteQualifications"]))$siteQualifications=$dataToView["data"]["siteQualifications"];

?>
<div class="row">
    
<div class="all col-md-10">
    <div class="border-primary boxds">
        <div class="main-img" style="width: 250px; height: 250px">
            <img src="<?php echo $image; ?>" alt="Imagen del sitio"
            class="object-fit-cover border rounded img-thumbnail img-fluid"
            style="width: 250px; height: 250px"
             onerror="cargarImagenPorDefecto(this)"
            >
        </div>
        <div class="main-texta">
            <div class="text-content">
                <h1><?php echo $title; ?></h1>
                <div class="user-info">
                    <i class="ri-account-circle-line"></i>
                    <h4><?php echo $userName; ?></h4>
                </div>
            </div>
            <div class="about-site">
                <p><?php echo $description; ?></p>
            </div>
        </div>
    </div>

    <!-- Formulario de calificación -->
    <form action="index.php?controller=stars&action=calificar" method="post" class="mt-3" id="ratingForm">
        <div class="container d-flex justify-content-start">
            <div class=" py-1 text-white mt-2 row">
                <h6 class="mb-0">Califica la página</h6>
                <div class="rating2 col" id="starsContainer">
                    <?php
                    // Usa la ID del sitio para crear identificadores únicos
                    $siteRatingId = 'rating_' . $id;

                    // Utiliza una variable única para cada conjunto de estrellas
                    $ratingValue = isset($user_rating) ? $user_rating : 0;

                    for ($i = 5; $i >= 1; $i--) :
                    ?>
                        <input type="radio" name="rating" value="<?php echo $i; ?>" id="<?php echo $siteRatingId . '_' . $i; ?>" class="star" <?php echo ($ratingValue == $i) ? 'checked' : ''; ?>>
                        <label for="<?php echo $siteRatingId . '_' . $i; ?>">☆</label>
                    <?php endfor; ?>
                </div>
                <div class="buttons px-4 mt-3 text-center col">
                    <!-- Agregado el campo oculto para enviar el ID del sitio -->
                    <input type="hidden" name="site_id" value="<?php echo $id; ?>">
                    <!-- Botón submit eliminado -->
                </div>
            </div>
        </div>
    </form>
    <!-- Fin del formulario de calificación -->

    <div class="rowds">
        <div class="main-row">
            
            <p><span class="text-warning"><?php echo number_format($averageRating, 1); ?> ☆</span><br> Opiniones</p>
        </div>
        <div class="main-row">
            <p><?php echo $categoryname; ?><br>Categoría</p>
        </div>
        <div class="main-row">
            <a href="<?php echo $content;?>" target="_blank" class="button-link">
                <i class="bi bi-link-45deg"></i>
            </a>
            <br>
            Sitio
        </div>
    </div>
    
    <div class="row">
    <h2>Calificaciones de usuarios:</h2>
    <?php
    // Verifica si existen calificaciones para mostrar
    if (!empty($siteQualifications)) {
        foreach ($siteQualifications as $qualification) {
            // Renderizar cada calificación como un elemento de lista con Bootstrap
    ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        <span class="text-info fw-bold"><?php echo $qualification['user_name']; ?></span>:
                        <span class="text-warning">
                            <?php
                            $rating = number_format($qualification['rating'], 1);
                            // Renderizar estrellas correspondientes a la calificación
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                            ?>
                                    <i class="bi bi-star-fill text-warning"></i>
                            <?php
                                } else {
                            ?>
                                    <i class="bi bi-star text-warning"></i>
                            <?php
                                }
                            }
                            ?>
                            (<?php echo $rating; ?>)
                        </span>
                    </p>
                </div>
            </div>
    <?php
        }
    } else {
        // En caso de no existir calificaciones
    ?>
        <div class="alert alert-info" role="alert">
            No hay calificaciones para este sitio.
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
</div>



<!-- Script para manejar la calificación por clic en las estrellas -->
<script>
    const starsContainer = document.getElementById('starsContainer');
    const ratingForm = document.getElementById('ratingForm');

    starsContainer.addEventListener('click', function (event) {
        const starClicked = event.target;

        if (starClicked.classList.contains('star')) {
            // Establecer el valor de calificación al valor de la estrella clicada
            const ratingValue = starClicked.value;
            document.querySelector('input[name="rating"][value="' + ratingValue + '"]').checked = true;

            // Enviar automáticamente el formulario al hacer clic en una estrella
            ratingForm.submit();
        }
    });
    function cargarImagenPorDefecto(img) {
    img.onerror = null; // Evita bucles infinitos si la imagen por defecto también falla
    img.src = 'https://cdn-icons-png.flaticon.com/512/5996/5996637.png';
    img.alt = 'default image';
}
</script>
