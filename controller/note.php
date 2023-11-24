<?php

require_once 'model/note.php';


class noteController {
    public $page_title;
    public $view;
    public $noteObj;


    public function __construct() {

        $this->view = 'dashboard';
        $this->page_title = '';
        $this->noteObj = new Note();
    }

    public function list(){
    $this->page_title = 'Listado de notas';
	$this->view = 'dashboard';

    
    $user_id =  $_SESSION['user_id']; 

    // Verifica si se proporciona un estado en la URL
    $state_id = isset($_GET['state']) ? $_GET['state'] : 0; // 0 para "todos" por defecto

    if ($state_id > 0) {
        // Si se selecciona un estado específico, obtén las notas filtradas
        $dataToView["data"] = $this->noteObj->getNotesByState($user_id, $state_id);
    } else {
        // Si no se selecciona un estado, obtén todas las notas
        $dataToView["data"] = $this->noteObj->getNotesByUser($user_id);
    }

    return $dataToView["data"];
}
//De qui asdasdasd
//
//
//
    public function edit($id = null) {
        $this->page_title = 'Crear/Editar nota';
        $this->view = 'edit_note';

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }

        return $this->noteObj->getNoteById($id);
    }

    public function createUpdate() {
        $this->view = 'dashboard';
        $this->page_title = 'Listado de notas';

        $user_id = $_SESSION['user_id'];
		
        $payload = $_POST;
        $payload['user_id'] = $user_id;

        $id = $this->noteObj->createUpdate($payload);

        $result = $this->noteObj->getNoteById($id);

        if ($id > 0) {
            $_GET["response"] = true;
            $_GET["alert"] = "success";
            $_GET["text"] = isset($_POST["id"]) && $_POST["id"] != '' ? "Edición Finalizada" : "Creación Finalizada";
        }

        return $this->noteObj->getNotesByUser($user_id);
    }

    public function confirmDelete() {
        $this->page_title = 'Eliminar nota';
        $this->view = 'confirm_delete_note';
        return $this->noteObj->getNoteById($_GET["id"]);
    }

    public function delete() {
        $this->page_title = 'Listado de notas';
        $this->view = 'dashboard';

        $result = $this->noteObj->deleteNoteById($_POST["id"]);

        if ($result) {
            $_GET["response"] = true;
            $_GET["alert"] = "danger";
            $_GET["text"] = "Nota Eliminada";
        }

        $user_id = $_SESSION['user_id'];
        return $this->noteObj->getNotesByUser($user_id);
    }
//Hasta aca
//
///
//
//

}
