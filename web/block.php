<?php
// Este Script bloquea el acceso al sistema todo usuario no registrado y/o conectado.

    // Archivo de Configuración y Conexion a la Base de Datos
	include("components/conexion/conexion.php");

	// Si existen Cookie almacenadas... //
    if(isset($_COOKIE['id']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])){

	// ...y concuerdan con los datos guardados en la Base de Datos... //
	$query = mysql_query("SELECT * FROM usuarios WHERE id = '$_COOKIE[id]'");
	$data_splash = mysql_fetch_array($query);

	if($_COOKIE['id'] === $data_splash['id'] && $_COOKIE['username'] === $data_splash['username'] && $_COOKIE['password'] === $data_splash['password']){
	
	// ...entonces el usuario estará autorizado... //
	echo '<!-- Autorizado -->'; } else {

	// ...sino el sistema lo bloquea y lo obliga a conectarse //
	include("web/login.php");

	}} else {   include("web/login.php");   }
?>