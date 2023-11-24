<?php

require_once 'model/sites.php';


class sitesController {
    public $page_title;
    public $view;
    public $noteObj;


    public function __construct() {

        $this->view = 'listUser';
        $this->page_title = '';
        $this->noteObj = new Sites();
    }

    public function list_by_user(){
    $this->page_title = 'Listado de notas';
	$this->view = 'listUser';
    $user_id = $_SESSION['user_id'];

    $dataToView["data"] = $this->noteObj->getNotesByUser1($user_id);
    

    return $dataToView["data"];
}

public function renderView($data) {
    extract($data);
    include('view/' . $this->view . '.php');
}
public function add(){
    $this->page_title = 'Listado de sitios';
	$this->view = 'site_form';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recoge los datos del formulario y valida/sanitiza como sea necesario
        $title = $_POST['title'] ?? null;
        $url = $_POST['url'] ?? null;
        $description = $_POST['description'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $image_url = $_POST['image_url'] ?? null;
        $user_id = $_SESSION['user_id'] ?? null;

        // Llama al método del modelo para insertar el nuevo sitio
        $result = $this->noteObj->insertSite($title, $url, $description, $category_id, $image_url, $user_id);

        if ($result) {
            $_SESSION['flash_message'] = "El sitio ha sido agregado exitosamente.";
            header('Location: index.php?controller=sites&action=list_by_user&user_id=' . $user_id);
            exit();
        } else {
            $_SESSION['flash_message'] = "Hubo un error al agregar el sitio.";
            header('Location: index.php?controller=sites&action=add');
            exit();
        }
    }
}
public function edit() {
    $this->page_title = 'Editar sitio';
    $this->view = 'edit_site';
    $isEditing = false;

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        // Llama al método del modelo para obtener los datos del sitio existente
        $siteData = $this->noteObj->getSiteById($id);

        if ($siteData) {
            // Pasar los datos a la vista utilizando un arreglo asociativo
            $dataToView = [
                'id' => $siteData['id'],
                'title' => $siteData['title'],
                'url' => $siteData['url'],
                'description' => $siteData['description'],
                'category_id' => $siteData['category_id'],
                'image_url' => $siteData['image_url'],
                'IsEditing'=> true
            ];

            $isEditing = true;
            return $dataToView;

        } else {
            $_SESSION['flash_message'] = "No se encontró el sitio solicitado.";
            header('Location: index.php?controller=sites&action=list_by_user&user_id=' . $_SESSION['user_id']);
            exit();
        }
    }

    // Pasa los datos a la vista
    //$this->renderView(['siteData' => $dataToView, 'isEditing' => $isEditing]);
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        // Recoge los datos del formulario y valida/sanitiza como sea necesario
        $id = $_POST['id'];
        $this->title = $_POST['title'] ?? null;
        $this->url = $_POST['url'] ?? null;
        $this->description = $_POST['description'] ?? null;
        $this->category_id = $_POST['category_id'] ?? null;
        $this->image_url = $_POST['image_url'] ?? null;
        $user_id = $_SESSION['user_id'] ?? null;

        // Llama al método del modelo para actualizar el sitio existente
        $result = $this->noteObj->updateSite($id, $this->title, $this->url, $this->description, $this->category_id, $this->image_url, $user_id);

        if ($result) {
            $_SESSION['flash_message'] = "El sitio ha sido actualizado exitosamente.";
            header('Location: index.php?controller=sites&action=list_by_user&user_id=' . $user_id);
            exit();
        } else {
            $_SESSION['flash_message'] = "Hubo un error al actualizar el sitio.";
            header('Location: index.php?controller=sites&action=edit&id=' . $id);
            exit();
        }
    }
    return null;
}

public function delete(){
    if(isset($_GET['id'])){
        $site_id = $_GET['id'];
        $result = $this->noteObj->deleteSite($site_id);

        if($result){
            $_SESSION['flash_message'] = "El sitio ha sido eliminado exitosamente.";
        } else {
            $_SESSION['flash_message'] = "Hubo un error al eliminar el sitio.";
        }

        header('Location: index.php?controller=sites&action=list_by_user&user_id=' . $_SESSION['user_id']);
        exit();
    }
}
public function listAll(){
    $this->page_title = 'Todos los sitios';
	$this->view = 'dashboard';

    $dataToView["data"] = $this->noteObj->getAllNotes();
    $dataToView["topFive"] = $this->noteObj->topFive();

    return $dataToView;
    }
   
    public function listByCategoryAndRating() {
        $this->page_title = 'Sitios por Calificación y Categoría';
       $this->view = 'dashboard';
        // Inicializar variables para almacenar los datos enviados por el formulario.
        $minRating = 0;
        $categoryId = null;
        
        // Verificar si se ha enviado el formulario con los filtros.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger y validar/sanitizar los datos del formulario.
            $minRating = isset($_POST['min_rating']) ? (float)$_POST['min_rating'] : $minRating;
            $categoryId = isset($_POST['category_id']) ? (int)$_POST['category_id'] : $categoryId;
    
            // Llama al método del modelo para obtener sitios por calificación y categoría.
            $dataToView['data'] = $this->noteObj->getSitesByCategoryAndRating($categoryId, $minRating);
        }
        
       $dataToView["topFive"] = $this->noteObj->topFive();
        return $dataToView;
        
    }
    
    
    
    
    
}






    

