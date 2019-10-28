<?php
// La Pagina Principal (index.php) siempre estará bloqueada.
// De estar conectado el usuario Administrador o Administrador Global
// será automaticamente direccionado al Panel de Administración del sistema.

	// Este archivo bloquea todo usuario no conectado. //
	include("web/block.php");

	if (isset($_COOKIE['id'])) { $id = $_COOKIE['id'] ; } else { $id = ''; }

	// Se selecciona de la Base de Datos, Tabla usuarios aquel usuario con el 'ID' que sea igual al 'ID' guardado en las Cookies.
	$query = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
	$datos = mysql_fetch_array($query);
	
	// Si el tipo de usuario es Administrado Global, Administrador o Vendedor, entonces podrá entrar al sistema.
	if($datos['user_type']=='1' OR $datos['user_type']=='2' OR $datos['user_type']=='3' ) { 
		echo '<!-- Autorizado -->';
	 
	echo '<div align="center"><img src="/media/images/loading.gif" border="0" alt="Espere..." /></div><div align="center">Autorizado.</div><div align="center">Tenga paciencia. Espere mientras es direccionado...</div>';
	 
	echo '<script>location="content.php?option=admin"</script>'; 

	} else {
} 
?>