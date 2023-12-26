<?php
    require_once "main.php";

    /* Almacenando datos */
    $nombre=limpiar_cadena($_POST['nombre_usuario']);
    $apellido=limpiar_cadena($_POST['apellido_usuario']);
    $usuario=limpiar_cadena($_POST['usuario_usuario']);
    $contrasena_1=limpiar_cadena($_POST['contrasena_usuario_1']);
    $contrasena_2=limpiar_cadena($_POST['contrasena_usuario_2']);
    


    /* Verificando campos obligatorios */
    if($nombre=="" || $apellido=="" || $usuario=="" || $contrasena_1=="" || $contrasena_2==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,100}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El apellido no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9@.]{4,100}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contrasena_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contrasena_2)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ourrio un error inesperado!</strong><br>
                La contraseñas no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    /* Verificando usuario */
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuarios WHERE usuario_usuario='$usuario'");
    if($check_usuario->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_usuario=null;

     /* Verificando claves */
     if($contrasena_1!=$contrasena_2){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Las contraseñas que ha ingresado no coinciden
            </div>
        ';
        exit();
    }else{
        $contrasena=password_hash($contrasena_1,PASSWORD_BCRYPT,["cost"=>10]);
    }


    /* Guardando datos */
    $guardar_usuario=conexion();
    $guardar_usuario=$guardar_usuario->prepare("INSERT INTO usuarios(nombre_usuario,apellido_usuario,usuario_usuario,
    contrasena_usuario) VALUES(:nombre,:apellido,:usuario,:contrasena)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":usuario"=>$usuario,
        ":contrasena"=>$contrasena
    ];

    $guardar_usuario->execute($marcadores);

    if($guardar_usuario->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Usuario Registrado!</strong><br>
                El usuario se registro correctamente
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_usuario=null;