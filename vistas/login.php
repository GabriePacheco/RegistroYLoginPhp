<?php 
 if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $errores=[];

    //Validacion saneamiento de email  
    if (isset($_POST['email'])){
        if (!empty($_POST['email'] )){
            $email = $_POST['email'];
            if ( filter_var($email, FILTER_VALIDATE_EMAIL) ){
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            } else {
                $errores[]=" El email ingresado no es valido";       
            }
        } else {
            $errores[]=" El email es requerido";   
        }

     } else {
         $errores[]=" El email es requerido";
     }

     //Validacion saneamiento de Password  
    if (isset($_POST['pass'])){
        if (!empty($_POST['pass'] )){
            $pass = $_POST['pass'];
        } else {
            $errores[]=" El password es requerido";   
        }

     } else {
         $errores[]=" El password es requerido";
     }   
     
     if ( empty($errores) ){
        $usuario = new User;
        $exite = $usuario->getUser($email, $pass);
        if ( $exite ){
            //iniciar sesion
            session_start();
            $_SESSION['gpUserID'] = $usuario->getId();
            $_SESSION['gpEmail'] = $usuario->getEMail();
            $_SESSION['gpNombre'] = $usuario->getNombre();
            header('location: index.php?pagina=publiaciones');
        } else {
            $errores[] ="Usuario y/o contraseña incorrecot";
        }

     }
 }
     
?>
<section class="d-flex  justify-content-center align-items-center">
    <div class="card  shadow p-3 col-xs-12 col-sm-4 col-md-4 col-lg-4">
        
             <div class="mb-4">
                <h4 class="form-titulo">Login</h4>
                <small>Llena los datos del formualario para ingresar</small>
             </div>   

            <form  class="form" id = "login"  method="POST">
          
                <div class="form-floating mb-3" >          
                    <input type="email" class="form-control" name = "email" id ="email" placeholder="ej:gpacheco@mail.com" required>
                    <label for="email"> <i class="bi bi-envelope-open"></i> Email</label>
                </div>
                <div class="form-floating mb-3" >          
                    <input type="password" class="form-control" name = "pass" id ="pass" placeholder="ej: es un secreto" required>
                    <label for="pass"> <i class="bi bi-key"></i> Contraseña</label>
                </div>

                <div id="mensajes"  class="d-flex justify-content-center" >
                    <?php 
                        if ( !empty($errores) ) {
                             foreach($errores as $error => $mensaje ){
                                echo alertas($mensaje);
                             }
                        }
                     ?>
                </div>
                <div class="mb-2">
                    <button type="submit" id ="boton" class="btn btn-primary col-12 d-flex justify-content-between">
                        <span>Iniciar Sesión</span>
                        <i id ="botonIcono" class="bi bi-cursor-fill"></i>
                    </button>
                </div>
                <div class="mb-2 d-flex justify-content-end">
                    <small>¿Aun no tienes cuenta? <a href="index.php?pagina=registro">Crear cuenta</a></smalls>
                </div>
                
            </form>
    </div>
</section>