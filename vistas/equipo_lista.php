<div class="container is-fluid mb-6">
    <h1 class="title">Equipos</h1>
    <h2 class="subtitle">Lista de equipos</h2>
</div>

<div class="container pb-12 pt-12">  
    <?php
        include "./inc/btn_atras.php";
        require_once "./php/main.php";

        /* Eliminar equipo */
        if(isset($_GET['id_usuario_del'])){
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

        $id_categoria=(isset($_GET['id_categoria'])) ?  $_GET['id_categoria'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=equipo_lista&page=";
        $registros=5;
        $busqueda="";

        /* Paginador equipo */
        require_once "./php/equipo_listar.php";
    ?>
</div>