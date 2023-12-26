<?php
	/* Almacenando datos */
    $usuario=limpiar_cadena($_POST['login_usuario']);
    $contrasena=limpiar_cadena($_POST['login_contrasena']);


    /* Verificando campos obligatorios */
    if($usuario=="" || $contrasena==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando datos integros */
    if(verificar_datos("[a-zA-Z0-9@.]{4,50}",$usuario)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El usuario no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$contrasena)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                Las Claves no coinciden con el formato solicitado
            </div>
        ';
        exit();
    }


    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuarios WHERE usuario_usuario='$usuario'");
    if($check_user->rowCount()==1){

    	$check_user=$check_user->fetch();

    	if($check_user['usuario_usuario']==$usuario && password_verify($contrasena, $check_user['contrasena_usuario'])){

    		$_SESSION['id']=$check_user['id_usuario'];
    		$_SESSION['nombre']=$check_user['nombre_usuario'];
    		$_SESSION['apellido']=$check_user['apellido_usuario'];
    		$_SESSION['usuario']=$check_user['usuario_usuario'];

    		if(headers_sent()){
				echo "<script> window.location.href='index.php?vista=home'; </script>";
			}else{
				header("Location: index.php?vista=home");
			}

    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                Usuario o contraseña incorrectos
	            </div>
	        ';
    	}
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                Usuario o contraseña incorrectos
            </div>
        ';
    }
    $check_user=null;