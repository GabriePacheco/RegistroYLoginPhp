<?php 

    if ( isset($_GET["pagina"] ) ){
        $page = $_GET["pagina"];
        switch ($page){
            case 'publicaciones':
                require_once "publicaciones.php" ;
            break;
            case 'login':
                require_once "login.php";
            break;
            case "registro":
                require_once "registrar.php";
            break;    
            
                
        
        }
    } else {
        require_once "login.php";
    }
    
?>