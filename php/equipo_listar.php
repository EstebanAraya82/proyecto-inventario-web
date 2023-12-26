<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	$campos="equipos.id_equipo,equipos.equipo_activo,equipos.equipo_sector,equipos.equipo_piso,equipos.equipo_ubicacion,equipos.equipo_serie,equipos.equipo_marca,
			 equipos.equipo_modelo,equipos.equipo_responsable,categoria.nombre_categoria";

	if(isset($busqueda) && $busqueda!=""){
				$consulta_datos="SELECT $campos FROM equipos Inner Join categoria On equipos.id_categoria=categoria.id_categoria
				 where equipos.equipo_activo Like '$busqueda%' Or equipos.equipo_serie Like '%$busqueda%' Order By equipos.equipo_activo Asc Limit $inicio,$registros";

				$consulta_total="SELECT COUNT(id_equipo) FROM equipos where equipo_activo Like '%$busqueda%' Or equipo_serie Like '%$busqueda%'";

		}elseif($id_categoria>0){
			$consulta_datos="SELECT $campos FROM equipos Inner Join categoria On equipos.id_categoria=categoria.id_categoria
				 where equipos.id_categoria='$id_categoria' Order By equipos.equipo_activo Asc Limit $inicio,$registros";

				$consulta_total="SELECT COUNT(id_equipo) FROM equipos Where id_categoria='$id_categoria'";


		}else{


		$consulta_datos="SELECT $campos FROM equipos Inner Join categoria On equipos.id_categoria=categoria.id_categoria
		Order By equipos.equipo_activo Asc Limit $inicio,$registros";

		$consulta_total="SELECT COUNT(id_equipo) FROM equipos";

	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='</p>
			        </figure>
			        <div class="media-content">
			            <div class="content">
			              <p>
			                <strong>'.$contador.'</strong><br>
			                <strong>Activo Fijo:</strong> '.$rows['equipo_activo'].'
							<strong>Sector:</strong> '.$rows['equipo_sector'].'
							<strong>Piso:</strong> '.$rows['equipo_piso'].'
							<strong>Ubicación:</strong> '.$rows['equipo_ubicacion'].'
							<strong>Serie:</strong> '.$rows['equipo_serie'].'
							<strong>Marca:</strong> '.$rows['equipo_marca'].'
							<strong>Modelo:</strong> '.$rows['equipo_modelo'].'
							<strong>Responsable:</strong> '.$rows['equipo_responsable'].'
							<strong>Categoria:</strong> '.$rows['nombre_categoria'].'
			              </p>
			            </div>
			            <div class="has-text-right">
			                <a href="index.php?vista=equipo_actualizar&id_equipo_up='.$rows['id_equipo'].'" class="button is-success is-rounded is-small">Actualizar</a>
			                <a href="'.$url.$pagina.'&id_equipo_del='.$rows['id_equipo'].'" class="button is-danger is-rounded is-small">Eliminar</a>
			            </div>
			        </div>
			    </article>

			    <hr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<p class="has-text-centered" >
					<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
		}else{
			$tabla.='
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
		}
	}

	if($total>1 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando equipos <strong>'.$pag_inicio.
		'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}