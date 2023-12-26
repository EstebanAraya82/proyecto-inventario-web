<div class="container is-fluid mb-6">
    <h1 class="title">Equipos</h1>
    <h2 class="subtitle">Categoría de equipos</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_atras.php";
        require_once "./php/main.php";
    ?>
    <div class="columns">
        <div class="column is-one-third">
            <h2 class="title has-text-centered">Categorías</h2>
            <?php
                $categorias=conexion();
                $categorias=$categorias->query("SELECT * FROM categoria");
                if($categorias->rowCount()>0){
                    $categorias=$categorias->fetchAll();
                    foreach($categorias as $row){
                        echo '<a href="index.php?vista=equipo_categoria&id_categoria='.$row['id_categoria'].'" class="button is-link is-inverted is-fullwidth">'.$row['nombre_categoria'].'</a>';
                    }
                }else{
                    echo '<p class="has-text-centered" >No hay categorías registradas</p>';
                }
                $categorias=null;
            ?>
        </div>
        <div class="column">
            <?php
                $id_categoria = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : 0;

                /* Verificando categoria */
                $check_categoria=conexion();
                $check_categoria=$check_categoria->query("SELECT * FROM categoria WHERE id_categoria='$id_categoria'");
                
                if($check_categoria->rowCount()>0){

                    $check_categoria=$check_categoria->fetch();

                    echo '
                        <h2 class="title has-text-centered">'.$check_categoria['nombre_categoria'].'</h2>
                    ';

                    require_once "./php/main.php";

                    # Eliminar producto #
                    if(isset($_GET['equipo_serie_del'])){
                        require_once "./php/equipo_eliminar.php";
                    }

                    if(!isset($_GET['page'])){
                        $pagina=1;
                    }else{
                        $pagina=(int) $_GET['page'];
                        if($pagina<=1){
                            $pagina=1;
                        }
                    }

                    $pagina=limpiar_cadena($pagina);
                    $url="index.php?vista=equipo_categoria&id_categoria=$id_categoria&page="; /* <== */
                    $registros=15;
                    $busqueda="";

                    # Paginador producto #
                    require_once "./php/equipo_listar.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione una categoría para empezar</h2>';
                }
                $check_categoria=null;
            ?>
        </div>
    </div>
</div>