<?php

$id = $title = $content = "";

if(isset($dataToView["data"]["id"])){
	$id = $dataToView["data"]["id"];
}

if(isset($dataToView["data"]["title"])){
	$title = $dataToView["data"]["title"];
}

if(isset($dataToView["data"]["content"])){
	$content = $dataToView["data"]["content"];
}

if(isset($dataToView["data"]["state_id"])){
	$state_id = $dataToView["data"]["state_id"];
}else{
	$state_id = 1;
}

?>
<div class="row">
    <form class="form container" action="index.php?controller=note&action=createUpdate" method="POST">
        <div class="card p-3">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
                <label><i>Título</i></label>
                <input class="form-control" type="text" name="title" value="<?php echo $title; ?>" />
            </div>
            <div class="form-group mb-2">
                <label><i>Contenido</i></label>
                <textarea class="form-control" style="white-space: pre-wrap;" name="content"><?php echo $content;?></textarea>
            </div>
            <div class="form-group mb-2">
                <label><i>Estado</i></label>
                <select class="form-control" name="state_id">
                    <option value="1" <?php echo ($state_id == 1) ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="2" <?php echo ($state_id == 2) ? 'selected' : ''; ?>>Completado</option>
                </select>
            </div>
            <div class="row">
                <input type="submit" value="Guardar" class="btn btn-primary col-md-5 ms-3 me-auto "/>
                <a class="btn btn-outline-danger col-md-5 me-3" href="index.php?controller=note&action=list">Cancelar</a>
            </div>
        </div>
    </form>
</div>

