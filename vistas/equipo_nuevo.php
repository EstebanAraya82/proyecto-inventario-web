<div class="container is-fluid mb-6">
	<h1 class="title">Equipos</h1>
	<h2 class="subtitle">Nuevo Equipo</h2>
</div>
<div class="container pb-6 pt-6">

		<?php 
		require_once "./php/main.php"; 
		?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<form action="./php/equipo_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form_data">
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Activo Fijo</label>
				  	<input class="input" type="text" name="equipo_activo" placeholder="Ingrese dato" pattern="[0-9]{3,10}" maxlength="10" require >
				</div>
		  	</div>
		<div class="column">
		    	<div class="control">
					<label>Serie</label>
				  	<input class="input" type="int" name="equipo_serie" placeholder="Ingrese dato" pattern="[a-zA-Z0-9]{7,100}" maxlength="100" required >
				</div>
                </div>		
              <div class="column">
		    	<div class="control">
					<label>Marca</label>
				  	<input class="input" type="text" name="equipo_marca" placeholder="Ingrese dato" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
             <div class="column">
		    	<div class="control">
					<label>Modelo</label>
				  	<input class="input" type="text" name="equipo_modelo" placeholder="Ingrese dato" pattern="[a-zA-Z0-9().,$#\-\/ ]{3,100}" maxlength="100" required >
				</div>
		</div>       
	  	<div class="column">
		    	<div class="control">
					<label>Sector</label>
				  	<input class="input" type="text" name="equipo_sector" placeholder="Ingrese dato" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required >
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Piso</label>
				  	<input class="input" type="text" name="equipo_piso" placeholder="Ingrese dato" pattern="[a-zA-Z0-9]{1,20}" maxlength="20" required >
				</div>
		  	</div>
			  </div>
			  <div class="columns">
               	<div class="column">
		    	<div class="control">
					<label>Ubicación</label>
				  	<input class="input" type="text" name="equipo_ubicacion" placeholder="Ingrese dato" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{2,40}" maxlength="40" required >
				</div>
            </div>   
  			<div class="column">
		    	<div class="control">
					<label>Responsable</label>
				  	<input class="input" type="text" name="equipo_responsable" placeholder="Ingrese dato" pattern="[a-zA-Z0-9]{2,100}" maxlength="100" required >
				</div>
		  	</div>
		 <div class="column">
			<label>Categoria</label><br>
			<div class="select is-rounded">
				<select name="equipo_categoria">
					<option value="" selected="" >Seleccione una opción</option>					
					<?php
					    $categorias=conexion();
						$categorias=$categorias->query("SELECT * From categoria");
						if($categorias->rowCount()>0){
							$categorias=$categorias->fetchAll();
							foreach($categorias as $row){
								echo '<option value="'.$row['id_categoria'].'" >'.$row['nombre_categoria'].'</option>';

							}
						}
						$categorias=null;
					?>
				</select>
			</div>
		</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>