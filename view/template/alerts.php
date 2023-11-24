<?php
    if(isset($_GET["response"]) and $_GET["response"] === true){
        echo '<div class="alert alert-dismissible alert-'.$_GET["alert"].'">  <button type="button" class="btn-close" data-bs-dismiss="alert"></button><h4 class="alert-heading">'.$_GET["text"].'</h4></div>';
    }
?>