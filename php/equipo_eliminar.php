<?php
	/* Almacenando datos */
    $id_equipo_del=limpiar_cadena($_GET['id_equipo_del']);

    /* Verificando producto */
    $check_equipo=conexion();
    $check_equipo=$check_equipo->query("SELECT * FROM equipos WHERE id_equipo='$id_equipo_del'");

    if($check_equipo->rowCount()==1){

    	$datos=$check_equipo->fetch();

    	$eliminar_equipo=conexion();
    	$eliminar_equipo=$eliminar_equipo->prepare("DELETE FROM equipos WHERE id_equipo=:id");

    	$eliminar_equipo->execute([":id"=>$id_equipo_del]);

    	if($eliminar_equipo->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Equipo eliminado!</strong><br>
	                Los datos del equipo se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el equipo, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_equipo=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                El equipo que intenta eliminar no existe
            </div>
        ';
    }
    $check_equipo=null;