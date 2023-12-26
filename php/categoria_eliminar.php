<?php
	/* Almacenando datos */
    $id_categoria_del=limpiar_cadena($_GET['id_categoria_del']);

    /* Verificando usuario */
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT id_categoria FROM categoria WHERE id_categoria='$id_categoria_del'");
    
    if($check_categoria->rowCount()==1){

    	$check_equipos=conexion();
    	$check_equipos=$check_equipos->query("SELECT id_categoria FROM equipos WHERE id_categoria='$id_categoria_del' LIMIT 1");

    	if($check_equipos->rowCount()<=0){

    		$eliminar_categoria=conexion();
	    	$eliminar_categoria=$eliminar_categoria->prepare("DELETE FROM categoria WHERE id_categoria=:id");

	    	$eliminar_categoria->execute([":id"=>$id_categoria_del]);

	    	if($eliminar_categoria->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡Categoria Eliminada!</strong><br>
		                La categoría se elimino con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ups ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar la categoría, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_categoria=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                No podemos eliminar la categoría ya que tiene productos asociados
	            </div>
	        ';
    	}
    	$check_equipos=null;
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                No existe la categoria que intenta eliminar
            </div>
        ';
    }
    $check_categoria=null;