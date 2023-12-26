<div class="container is-fluid mb-6">
    <h1 class="title">Categorías</h1>
    <h2 class="subtitle">Lista de categoría</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_atras.php";
        require_once "./php/main.php";

        /* Eliminar categoria */
        if(isset($_GET['id_categoria_del'])){
            require_once "./php/categoria_eliminar.php";
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
        $url="index.php?vista=categoria_lista&page="; 
        $registros=5;
        $busqueda="";

        /* Paginador categoria */
        require_once "./php/categoria_listar.php";
    ?>
</div>