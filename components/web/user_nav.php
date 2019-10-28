<?php

    if(isset($_COOKIE['username'])){ $username = $_COOKIE['username']; } else { $username = ''; }
    if(isset($_COOKIE['password'])){ $password = $_COOKIE['password']; } else { $password = ''; }
    if(isset($_COOKIE['id'])){ $id = $_COOKIE['id']; } else { $id = ''; }

  		$query2 = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$datos2 = mysql_fetch_array($query2);

        if($id && $username && $password) {            ?>

<!-- Mensaje de Bienvenida --><div id="user_nav"><li id="links_options" class="left">
<h3>Bienvenido <?php echo $username; ?></h3></li></div>

    <div id="primary_nav"><!-- Barra de Superior de Botones de Navegación -->
        <ul>

<!-- Botón 1: Home -->
<li id="nav_home" class="left"><a href="index.php" title="Inicio"><img src="media/images/icon_primary_home.png"><br>Inicio</a></li>

<!-- Botón 2: Administración -->
<li id="nav_admin" class="left"><a href="content.php?option=admin" title="Panel de Administracion"><img src="media/images/icon_admin.png"><br>Administracion</a></li>

<?php
    if(get_rows("articulo")==0) { echo ''; }
            else {              ?>
<!-- Botón 3: Busqueda -->
<li id="nav_search" class="left"><a href="content.php?option=admin&amp;task=search_tool" title="Búsqueda"><img src="media/images/icon_primary_search.png"><br>Búsqueda</a></li>

<?php } if($datos2['user_type']=='1' OR $datos2['user_type']=='2') { echo '<!-- Autorizado -->';

if(get_rows("articulo") == 0) {
echo '<!-- Botón 4: Agregar Articulos -->
<li id="nav_art" class="left"><a href="content.php?option=admin&task=add_art" title="Agregar Articulos"><img src="media/images/icon_primary_art.png"><br/>Inventario</a></li>';
           } else {             ?>
<!-- Botón 4: Inventario -->
<li id="nav_inv" class="left"><a href="content.php?option=admin&amp;task=inventario" title="Inventario de Articulos"><img src="media/images/icon_primary_art.png"><br>Inventario</a></li>

<?php }} else { echo '<!-- No Autorizado -->'; }   ?>
<!-- Botón 5: Perfil -->
<li id="nav_profile" class="left"><a href="content.php?option=web&amp;task=edit_profile" title="Editar Perfil"><img src="media/images/icon_primary_perfil.png"><br>Perfil</a></li>

<!-- Botón 6: Ayuda -->
<li id="nav_help" class="left"><a href="content.php?option=admin&amp;task=acercade" title="Ayuda"><img src="media/images/icon_primary_plus.png"><br>Ayuda</a></li>

<!-- Botón 7: Salir -->
<li id="nav_logout" class="left"><a href="login.php?mode=out" title="Salir"><img src="media/images/icon_logout.png"><br>Salir</a></li>

        </ul>
            </div>
                </div>
<?php   } else {    ?>

<!-- Mensaje de Bienvenida --><div id="user_nav"><li id="links_options" class="left">
<h3>¡Bienvenido!</h3></li></div>

    <div id="primary_nav"><!-- Barra de Superior de Botones de Navegación -->
        <ul>

<!-- Botón 1: Inicio -->
<li id="nav_home" class="left"><a href="index.php" title="Inicio"><img src="media/images/icon_primary_home.png"><br>Inicio</a></li>

<!-- Botón 2: Conectarse -->
<li id="nav_login" class="left"><a href="index.php" title="Conectarse"><img src="media/images/icon_login.png"><br>Conectarse</a></li>

        </ul>
            </div>
                </div>
<?php } ?>