<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST" ){
        //Validacion y saneamiento de campos 
        $errores = array();
        //Nombre
        if ( isset($_POST['nombres']) ){
            if( !empty($_POST['nombres']) ){
                $nombre = $_POST['nombres'];
                if ( !preg_match("/^[a-zA-Z ]+$/", $nombre) ){
                    $errores []= "Solo se permiten letras en el nombre";
                } else {
                    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
                }
            }else{
                $errores[]= "El nombre es requerido";
            }
        }
        //email 
        if ( isset($_POST['correo']) ){
            if( !empty($_POST['correo']) ){
                $correo= $_POST['correo'];
                if ( !filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    $errores[] = "El correo ingresado no es valido";
                }
            }else{
                $errores[]= "El correo es requerido";
            }
        }
        //Contraeña 
        if( isset($_POST['pass']) && isset($_POST['passConfir']) ){
            if ( !empty($_POST['pass']) && !empty($_POST['passConfir']) ){
                if (($_POST['pass'] == $_POST['passConfir'] ) ){

                    $password= password_hash($_POST['pass'], PASSWORD_DEFAULT);

                } else {
                    $errores[]= "Las contraseñas ingresadas no son iguales";    
                }
            } else {
                $errores[]= "Las contraseñas son requeridas";
            }

        } else {
            $errores[]= "Las contraseñas son requeridas";
        }

        //Registrar nuevo usuario 
        if ( empty($errores) ){
            $usuario = new User();
            $validacion = $usuario->registrar($nombre, $correo,$password) ;
            if ( $validacion ){
                //redirigir al pagina de interna
                header('location:  index.php?page=publicaciones');
            } else {
                $errores[]= "el correo electronico ingresado ya fue registrado con anterioridad";
            }

        }
        
    }
?>
<section class="d-flex  justify-content-center align-items-center">
    <div class="card p-3 shadow col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="mb-4">
            <h4 class="form-titulo"> Registro</h4>
                <small>Completa los datos del formulario para registrarte</small>
        </div>
        <form class="form" method = "POST" >
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="ej:Gabriel Pacheco" required>
                <label for="nombres"> <i class="bi bi-person-badge"></i> Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="correo"  placeholder="ej:gpacheco@mail.com" required>
                <label for="email"> <i class="bi bi-envelope-open"></i> Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="ej: es un secreto" required>
                <label for="pass"> <i class="bi bi-key"></i> Contraseña</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="passConfir" id="passConfir" placeholder="ej: es un secreto" required>
                <label for="passconfirm"> <i class="bi bi-key-fill"></i> Contraseña</label>
            </div>
            <div id="mensajes" class="mensajes">
                <?php
                 if (!empty($errores)){
                     foreach ($errores as $error => $mensaje){
                         ?>
                         <?php  alertas($mensaje); ?>   
                         <?php
                     }
                 }
                 ?>
            </div>
            <div class="mb-2">
                <button type="submit" id="boton" class="btn btn-primary col-12 d-flex justify-content-between">
                    <span>Registrar</span>
                    <i id="botonIcono" class="bi bi-cursor-fill"></i>
                </button>
            </div>
            
            <div class="mb-2 d-flex justify-content-end">
                <small>¿Ya tienes una cuenta? <a href="index.php?pagina=login">Iniciar sesión</a></small>
            </div>

        </form>
    </div>
</section>