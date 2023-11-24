<!-- Este será un nuevo archivo, por ejemplo: add_site.php en la carpeta 'view' -->

<?php
// Inicializar variables para agregar
$siteId = $title = $url = $description = $categoryId = $imageUrl = "";
$isEditing = false;

$actionUrl = "index.php?controller=sites&action=add";
?>

<div class="container">
    <h2>Agregar Sitio</h2>
    <form method="POST" action="<?php echo $actionUrl; ?>">
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
                <option value="1">Programación</option>
                <option value="2">Diseño</option>
                <option value="3">Idiomas</option>
                <option value="4">Ciencias</option>
                <option value="5">Arte</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image_url">URL de la Imagen:</label>
            <input type="url" class="form-control" name="image_url" id="image_url" value="<?php echo $imageUrl; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>