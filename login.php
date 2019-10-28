<?php
// Este Script hace posible que el usuario Inicie una Sesión en el Sistema de Gestión de Inventario.

    // Archivo de Configuración y Conexion a la Base de Datos
	include("components/conexion/conexion.php");

    // Función para que los Datos ingresados sean seguros y evitar Inyección SQL.
    function make_safe($variable) {
    $variable = addslashes(trim($variable));
    return $variable;   }

    $username = $_POST['username'];     // Nombre de Usuario
    $password = $_POST['password'];     // Contraseña
    $contrasena = md5($password);       // Contraseña Encriptada en md5
    $ip = $_SERVER["REMOTE_ADDR"];      // Dirección IP de donde se conecta
    $usuario = $_COOKIE['username'] ;   // Nombre de Usuario almacenado en Cookies

    // Establecer Zona Horaria y Fecha Actual
    date_default_timezone_set('America/Caracas');
    $fecha = time();
	$date = date("Y-m-d H:i:s");

//______________________________________________________________________________________//
    // Modo IN para Iniciar Sesión //

	if($_POST["entrar"] && $_GET['mode'] == 'in'){
		if($username && $password){

  	$query = mysql_query("SELECT * FROM usuarios WHERE username = '$username' or email = '$username'");
	$datos = mysql_fetch_array($query);
	
    if($datos['password'] == $contrasena){
        setcookie('id',$datos[id],time()+90000);
		setcookie('username',$datos[username],time()+90000);
		setcookie('password',$contrasena,time()+90000);

	Header("location: index.php");

	} else { echo '<script language=javascript>alert("Contraseña Incorrecta")</script><script>location="index.php"</script>';   }
	} else { echo '<script language=javascript>alert("Campos Incorrectos")</script><script>location="index.php"</script>';   }
}

//______________________________________________________________________________________//
    // Modo Out para Finalizar Sesión //

    if($_GET['mode']== 'out'){
	    if($_COOKIE['id'] && $_COOKIE['username'] && $_COOKIE['password']){

    mysql_query("UPDATE usuarios SET online_last = '$date', ip='$ip' WHERE username = '$usuario'");

	    setcookie('id', '', time() - 90000);
	    setcookie('username', '', time() - 90000);
	    setcookie('password', '', time() - 90000);

		echo '<script language=javascript>alert("Usuario Desconectado. Gracias por su visita")</script><script>location="index.php"</script>';

} else { echo 'Usuario No Conectado'; }}
?>