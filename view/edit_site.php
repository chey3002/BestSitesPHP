<!-- Este será un nuevo archivo, por ejemplo: edit_site.php en la carpeta 'view' -->

<?php
// Inicializar variables para editar
$siteId = $title = $url = $description = $categoryId = $imageUrl = "";
$isEditing = true;

$actionUrl = ""; // Inicializa actionUrl

// Verificar si se ha proporcionado un ID para la edición (asumiendo que se pasa a través de la URL)
if (isset($_GET['id']) && $_GET['id'] > 0 && isset($dataToView['data'])) {
    $siteId = $dataToView['data']['id'];
    $title = $dataToView['data']['title'];
    $url = $dataToView['data']['url'];
    $description = $dataToView['data']['description'];
    $categoryId = $dataToView['data']['category_id'];
    $imageUrl = $dataToView['data']['image_url'];
    $isEditing = true;

    // Configura actionUrl después de haber recuperado la información del sitio
    $actionUrl = "index.php?controller=sites&action=edit&id=" . $siteId;
}
?>
<div class="container">
    <h2>Editar Sitio</h2>
    <form method="POST" action="<?php echo $actionUrl; ?>">
        <input type="hidden" name="id" value="<?php echo $siteId; ?>" />
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group">
            <label for="url">URL:</label>
            <input type="url" class="form-control" name="url" id="url" value="<?php echo $url; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" name="description" id="description" required><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Categoría:</label>
            <select class="form-control" name="category_id" id="category" required>
                <option value="">Selecciona una categoría</option>
                <option value="1" <?php if ($categoryId == 1) echo "selected"; ?>>Programación</option>
                <option value="2" <?php if ($categoryId == 2) echo "selected"; ?>>Diseño</option>
                <option value="3" <?php if ($categoryId == 3) echo "selected"; ?>>Idiomas</option>
                <option value="4" <?php if ($categoryId == 4) echo "selected"; ?>>Ciencias</option>
                <option value="5" <?php if ($categoryId == 5) echo "selected"; ?>>Arte</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image_url">URL de la Imagen:</label>
            <input type="url" class="form-control" name="image_url" id="image_url" value="<?php echo $imageUrl; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
