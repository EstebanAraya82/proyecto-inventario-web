        <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php?vista=home">
            <img src="./img/logo.png" width="60" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Usuarios</a>      
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=usuario_nuevo"> Nuevo</a>
                    <a class="navbar-item" href="index.php?vista=usuario_lista">Lista</a>
                    <a class="navbar-item" href="index.php?vista=usuario_buscar">Buscar</a>
                </div>               
            </div>
            
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Equipos</a>      
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="index.php?vista=equipo_nuevo"> Nuevo</a>
                    <a class="navbar-item" href="index.php?vista=equipo_lista">Lista</a>
                    <a class="navbar-item" href="index.php?vista=equipo_categoria">Por categoría</a>
                    <a class="navbar-item" href="index.php?vista=equipo_buscar">Buscar</a>
                </div>               
            </div>
            
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Categorías</a>
                <div class="navbar-dropdown">
                    <a href="index.php?vista=categoria_nueva" class="navbar-item">Nueva</a>
                    <a href="index.php?vista=categoria_lista" class="navbar-item">Lista</a>
                    <a href="index.php?vista=categoria_buscar" class="navbar-item">Buscar</a>
                </div>
            </div>
            </div>              
            </div>

            <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">

                <a href="index.php?vista=usuario_actualizar&id_usuario_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>
                    
                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>