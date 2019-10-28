<?php
/*-------------------------------------------------------------------------*/
    // Seguridad //

    if (stristr(htmlentities($_SERVER['PHP_SELF']), 'conexion.php')) {
	    Header('Location: index.php'); die();}
/*-------------------------------------------------------------------------*/
    // Configuración SQL y Web //

	$dbhost   = 'localhost'; // Host SQL, ej.: localhost //
	$dbname   = 'decoblue'; // Usuario SQL, ej.: root //
	$dbpass   = ''; // Clave SQL ///
	$dbuname  = 'root'; /// Nombre de la BD, ej.: test ///
   	$dbtype   = 'MySQL';  // Tipo de BD, ej.: mysql, oracle //
	$dirw     = 'http://localhost/decoblue/'; /// URL, ej.: http://www.sitio.com/ //
/*-------------------------------------------------------------------------*/
    // Enlace SQL //

    $enhaced_link = mysql_connect($dbhost,  $dbuname, $dbpass);
    if(!$enhaced_link){ include('conexion_error.php');}

    $db_selected = mysql_select_db($dbname, $enhaced_link);
    if (!$db_selected) { die ('MySQL Error: ' . mysql_error()); }
/*-------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------*/
    // Comprobación de Version de PHP Menor 5.0.4 //

	    $GLOBALS['required_php_version'] = '5.0.4';
        $phpversion = phpversion();

	if($phpversion < $GLOBALS['required_php_version']){ echo 'La versión de PHP en tu servidor es inferior a 5.0.4, <br/>la web no funciona en versiones anteriores a esta';
		exit;}
/*-------------------------------------------------------------------------*/
  if(!function_exists("check_session")){
        function get_rows ($table_and_query) {
        $total = mysql_query("SELECT COUNT(*) FROM $table_and_query");
        $total = mysql_fetch_array($total);
        return $total[0];   }     }
            if(get_rows("usuarios") == 0) { echo '<script>alert("Bienvenido al Sistema de Gestion de Inventario Decoblue. Click en Aceptar para proceder al Asistente de Instalacion"); location="components/install/index.php?step=1"</script>'; }
/*-------------------------------------------------------------------------*/
    // Comprobación de Cookies & Sesión //
  if(!function_exists("check_session")){
	  function check_session() {

    if(isset($_COOKIE['username'])){ $username = $_COOKIE['username']; } else { $username = ''; }
    if(isset($_COOKIE['password'])){ $password = $_COOKIE['password']; } else { $password = ''; }
    if(isset($_COOKIE['id'])){ $id = $_COOKIE['id']; } else { $id = ''; }

    if($username){ if($password){

    $query = mysql_query("SELECT * FROM usuarios WHERE username = '$username' AND password ='$password' AND id = '$id'");
	$count = mysql_num_rows($query);

	if($count != 1){  echo 'Error de Verificaci&oacute;n de Sesi&oacute;n. Borra todas las Cookies. <a href="components/admin/setcookie2.php?mode=delete_all">Click Aqui</a>'; exit; }}
    else {  echo 'Sesión Incorrecta'; exit; }}}
	check_session();          }
/*-------------------------------------------------------------------------  */
    // Configuración de errores PHP //

    error_reporting(0);
    ini_set('track_errors', 0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
?>