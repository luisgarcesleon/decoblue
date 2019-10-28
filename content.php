<?php
// Este Script es un Gestor de Contenido.

    // Archivo de Configuración y Conexion a la Base de Datos
	include("components/conexion/conexion.php");

    // Si el $_GET['task'] esta vacio entonces el archivo que contendrá esta sección será el Index de la carpeta.
    if(empty($_GET['task'])) { $file = 'index'; } else { $file = $_GET['task']; }

    // $_GET['option'] es el nombre del directorio de la carpeta 'components' a la que accederá donde se encuentran los modulos de sistema
    $name = $_GET['option'];
    $modpath = 'components/'.$name.'/'.$file.'.php';

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>DecoBlue &middot; Sistema de Gestión de Inventario</title>
<link rel="stylesheet" type="text/css" href="media/css/css-style.css">
</head>

<body>
<div class="container"><!-- Contenedor -->

<!-- Header: Barra Superior Estatica -->
<header><a href="index.php"><img src="media/images/decoblue_logo.png" alt="DecoBlue" width="180" height="90" id="DecoBlue" class="logo_header" style="display: block; float: left;"/></a>

<div class="toolbar"><!-- Barra Superior -->
<?php
    // Archivo de Barra de Navegacion de Usuario //
    include("components/web/user_nav.php");
    
    echo '</header>';

    // Si el archivo existe entonces todo irá bien, pero en caso contrario, dará Error
    if(file_exists($modpath)) {
      include($modpath);      }
         else { echo 'Error'; }
?>
<!-- Pie de Página --><footer><p>Agencia de Festejo y Floristería Decoblue&trade; C.A. Sistema de Gestión de Inventario.<br/> 2013 &copy; Todos los Derechos Reservados.</p>
<p>&nbsp;</p>
<address><p>Urbanización San José de Tarbes, Residencia Tarbes A.<br/> Planta Baja Local 2, detrás de la Torre B.O.D, Municipio Valencia, Edo. Carabobo.</p></address>
</footer>
</div>
</body>
</html>