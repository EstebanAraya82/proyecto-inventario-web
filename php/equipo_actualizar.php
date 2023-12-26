<?php
	require_once "main.php";

	/* Almacenando id */
    $id=limpiar_cadena($_POST['id_equipo']);


    /* Verificando equipo */
	$check_equipo=conexion();
	$check_equipo=$check_equipo->query("SELECT * FROM equipos WHERE id_equipo='$id'");

    if($check_equipo->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El equipo no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_equipo->fetch();
    }
    $check_equipo=null;


    /* Almacenando datos */
    $activo=limpiar_cadena($_POST['equipo_activo']);
	$sector=limpiar_cadena($_POST['equipo_sector']);
	$piso=limpiar_cadena($_POST['equipo_piso']);
	$ubicacion=limpiar_cadena($_POST['equipo_ubicacion']);
	$responsable=limpiar_cadena($_POST['equipo_responsable']);
    $categoria=limpiar_cadena($_POST['equipo_categoria']);



	/* Verificando campos obligatorios */
    if($activo=="" || $sector=="" || $piso=="" || $ubicacion=="" || $responsable=="" || $categoria==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos */
    if(verificar_datos("[0-9 ]{3,10}",$activo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El Activo Fijo no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $sector)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El sector no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9 ]{1,20}", $piso)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El piso no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{2,40}", $ubicacion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                La ubicación no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9 ]{2,100}", $responsable)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ups ocurrio un error inesperado!</strong><br>
            El responsable no coincide con el formato solicitado
        </div>
    ';
    exit();
    }


    /* Verificando activo fijo */
    if($activo!=$datos['equipo_activo']){
	    $check_activo=conexion();
	    $check_activo=$check_activo->query("SELECT equipo_activo FROM equipos WHERE equipo_activo='$activo'");
	    if($check_activo->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                El Activo Fijo ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_activo=null;
    }

       /* Verificando categoria */
       if($categoria!=$datos['id_categoria']){
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT id_categoria FROM categoria WHERE id_categoria='$categoria'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                La categoría seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;
    }

    

      /* Actualizando datos */
    $actualizar_equipo=conexion();
    $actualizar_equipo=$actualizar_equipo->prepare("UPDATE equipos SET equipo_activo=:activo,equipo_sector=:sector,equipo_piso=:piso,equipo_ubicacion=:ubicacion,equipo_responsable:responsable,id_categoria=:categoria WHERE id_equipo=:id");

    $marcadores=[
        ":activo"=>$activo,
        ":sector"=>$sector,
        ":piso"=>$piso,
        ":ubicacion"=>$ubicacion,
        ":responsable"=>$responsable,
        ":categoria"=>$categoria,
        ":id"=>$id
    ];


    if($actualizar_equipo->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Equipo Actualizado!</strong><br>
                El equipo se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el equipo, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_equipo=null;