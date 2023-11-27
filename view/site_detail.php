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
if (isset($dataToView["data"]["data"]["average_rating"])) $averageRating = $dataToView["data"]["data"]["average_rating"];
if (isset($dataToView["data"]["data"]["user_name"])) $userName = $dataToView["data"]["data"]["user_name"];
if (isset($dataToView["data"]["data"]["category_name"])) $categoryname = $dataToView["data"]["data"]["category_name"];
if(isset($dataToView["data"]["rating"]["rating"]))$user_rating=$dataToView["data"]["rating"]["rating"];

?>

<section class="all">
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
        <div class="container d-flex justify-content-center">
            <div class="rate2 py-1 text-white mt-2 row">
                <h6 class="mb-0">Califica la página</h6>
                <div class="rating2 col" id="starsContainer">
                    <?php
                    // Usa la ID del sitio para crear identificadores únicos
                    $siteRatingId = 'rating_' . $id;

                    // Utiliza una variable única para cada conjunto de estrellas
                    $ratingValue = isset($user_rating) ? $user_rating : 3;

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
            <p><?php echo $averageRating; ?><br> Opiniones</p>
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
</section>

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
