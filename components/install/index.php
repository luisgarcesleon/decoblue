<?php
/*-------------------------------------------------------------------------*/
    // Configuración SQL y Web //

	$dbhost   = 'localhost'; // Host SQL, ej.: localhost //
	$dbname   = 'decoblue'; // Usuario SQL, ej.: root //
	$dbpass   = ''; // Clave SQL ///
	$dbuname  = 'root'; /// Nombre de la BD, ej.: test ///
/*-------------------------------------------------------------------------*/
    // Enlace SQL //

    $enhaced_link = mysql_connect($dbhost,  $dbuname, $dbpass);
    if(!$enhaced_link){ include('../conexion/conexion_error.php');}

    $db_selected = mysql_select_db($dbname, $enhaced_link);
    if (!$db_selected) { die ('MySQL Error: ' . mysql_error()); }
/*-------------------------------------------------------------------------*/
    // Comprobación de Version de PHP Menor 5.0.4 //

	    $GLOBALS['required_php_version'] = '5.0.4';
        $phpversion = phpversion();

	if($phpversion < $GLOBALS['required_php_version']){ echo 'La versión de PHP en tu servidor es inferior a 5.0.4, <br/>la web no funciona en versiones anteriores a esta';
		exit;}

/*-------------------------------------------------------------------------*/

      function get_rows ($table_and_query) {
        $total = mysql_query("SELECT COUNT(*) FROM $table_and_query");
        $total = mysql_fetch_array($total);
        return $total[0];   }
            if(get_rows("usuarios") > 1) { echo '<script>alert("Sistema Instalado"); location="../../index.php"</script>'; }

/*-------------------------------------------------------------------------*/
    // Configuración de errores PHP //

    error_reporting(0);
    ini_set('track_errors', 0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
/*-------------------------------------------------------------------------*/
    // Instalación //

    if(isset($_POST['submit'])) { $submit = $_POST['submit']; } else { $submit = ''; }

    if($_GET['install'] == 'true' && $submit) {

    // Función para que los Datos ingresados sean seguros y evitar Inyección SQL.
    function make_safe($variable) {
    $variable = addslashes(trim($variable));
    return $variable;             }

    // Función para que los Datos ingresados sean seguros y evitar Inyección SQL.
    function htx($texto) {
    $texto = trim($texto);
    $texto = htmlspecialchars($texto);
    return $texto ;       }

    // Establecer Zona Horaria y Fecha Actual
    date_default_timezone_set('America/Caracas');
    $fecha = time();
	$date = date("Y-m-d H:i:s");

    $wait_msg = '<div align="center"><img src="/media/images/loading.gif" border="0" alt="Espere..." /></div><div align="center">Registro de Usuario Exitoso</div><div align="center">Tenga paciencia. Espere mientras es direccionado...</div>';

    $pass101 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    $act_cod = '260294';
    $act_cod2 = $_POST['act_cod'];

    if($act_cod === $act_cod2) { if($pass101 == $pass2){

    $pass1 = md5($_POST['password1']);
    $name = htx($_POST['name']);
    $nick =  htx($_POST['username']);
    $nick101 = $_POST['username'];
    $email101 = $_POST['email'];
    $email =  htx($_POST['email']);
    $ci =  htx($_POST['ci']);
    $born_date =  htx($_POST['born_date']);
    $ip = $_SERVER["REMOTE_ADDR"];
    $us_type = '1';

    $sql_01 = mysql_query("SELECT * FROM usuarios WHERE username = '$nick' OR email = '$email'");

    if(mysql_num_rows($sql_01)== 0){
        if(!$nick101){ $error = "Error en el Nombre de Usuario"; }
        if(!$pass101){ $error = "Error en la Contraseña"; }
        if(!$email101){ $error = "Error en el Email"; }
            } else { $error = "Usuario ya registrado"; }
            } else { $error = "Verifica tu contraseña"; }


    if($error){ echo '<script>alert("'.$error.'"); window.location="javascript:history.back()";</script>';
    }   else    {

    if(!mysql_query("INSERT INTO usuarios
        (user_reg, username, password, cedula, born_date, email, user_type, ip, nombre)
        VALUES ('$date','$nick','$pass1', $ci, $born_date,'$email','$us_type','$ip','$name')")) {

    echo '<script>alert("Ha Ocurido un Error al Registrarse. Intente de Nuevo"); window.location="javascript:history.back()";</script>'; }

    echo $wait_msg.'<script>location="../../index.php?username='.$nick.'"</script>'; }

    }

      } elseif($_GET['step'] == 1 ) {
?>
<!DOCTYPE HTML>
<html style="display: block;" lang="es-es">
<head>
<meta charset="utf-8">
<title>DecoBlue &middot; Asistente de Instalaci&oacute;n</title>

<style type="text/css">
body{
    background-image: url("../../media/images/bg_login.png");
	background-attachment: fixed;
	background-size: contain;
	background-repeat: no-repeat;
	background-color: rgb(34,34,34);
}

body.msie.ie8{  background-image:none;background-color:#00326B; }

#apDiv1 {
	background-color: rgb(255,255,255);
	padding-top: 20px;
	padding-left: 20px;
	position: absolute;
	left: 20px;
	top: 100px;
	width: 950px;
	height: 500px;
	z-index: 1;
	border: solid rgb(255,255,255);
	border-radius: 65px;
	border-width: 2px;
	-webkit-border-radius: 55px;
	box-shadow: 0px 0px 20px 1px rgb(149,149,149);
}

#apDiv1 label {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 18px;
	font-style: normal;
	font-weight: lighter;
	color: rgb(39,39,39);
}

.text {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 14px;
	font-style: normal;
	font-weight: lighter;
	color: rgb(39,39,39);
}

#apDiv1 p {
	margin-top: 2px;
	margin-bottom: 2px;
}

#apDiv1 input.inputbox {
	font-size: 1em;
	border: none;
	border-bottom: 1px solid #CCCCCC;
	width: 300px;
	font-weight: lighter;
	color:  rgb(55,55,55);
}

#apDiv1 input.inputbox1 {
	font-size: 1em;
	border: none;
	border-bottom: 1px solid #CCCCCC;
	width: 300px;
}

#apDiv1 input.button1 {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 18px;
	font-style: normal;
	font-weight: lighter;
	border: none;
	width: 300px;
	color: rgb(0,105,210);
	background-color: transparent;
}

#apDiv1 input.button1:hover {
	color: #0DC5EC;
}

#apDiv1 a {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 14px;
	font-style: normal;
	font-weight: lighter;
	border: none;
	text-decoration: none;
	color: rgb(0,105,210);
}

#apDiv1 a:hover {
	color: #0DC5EC;
}

.title {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 24px;
	font-weight: lighter;
    text-align: center;

}

footer {
	display: block;
}

fieldset.sectionwrap{ /*fieldset that wraps around each form "page" */
width: 950px;
border-width:0;
padding:5px;


}

legend{ /*title shown at top of each form page */
  	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 18px;
	font-style: normal;
	font-weight: lighter;

}

div.stepsguide{ /*div that contains all the "steps" text located at top of form */
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 18px;
	font-style: normal;
	font-weight: lighter;
    width: 950px;      /*width of "steps" container*/
    overflow:hidden;
    margin-bottom:10px;
    cursor:pointer;
	border-bottom: 1px solid #CCCCCC;
}

div.stepsguide .step{ /*div that wraps around each "steps" text */
width: 25%; /*width of each "steps" text*/
font-size: 24px;
float:left;
text-align: center;

}

div.stepsguide .disabledstep{ /*div that wraps around each "steps" text */
color:#C4C4C4;
}

div.stepsguide .step .smalltext{ /*small footer text inside "steps" text */
font-size: 12px;
font-weight: normal;
}

div.formpaginate{ /* CSS for pagination DIV container */
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 18px;
	font-style: normal;
	font-weight: lighter;
width: 98%;
overflow:hidden;
text-align:center;
float: left;
margin-top:10px;

}

div.formpaginate .prev, div.formpaginate .next{ /*CSS for "prev" and "next" SPAN elements within paginate container */
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 14px;
	font-style: normal;
	font-weight: lighter;
border-radius:5px;
-webkit-border-radius:5px;
padding:5px 5px;
background:#0DCCF2;
color: #000000;
cursor:pointer;
}

#apDiv1 input.button2 {
	font-family: "Lucida Sans Unicode", sans-serif;
	font-size: 14px;
	font-style: normal;
	font-weight: lighter;
border-radius:5px;
-webkit-border-radius:5px;
padding:5px 5px;
background:#0DCCF2;
color: #000000;
cursor:pointer;
overflow:hidden;
text-align:center;
float: left;
border: none;
}
</style>
<script src="../../web/jquery.js"></script>
<script src="../../web/form_wizard.js"></script>
<script type="text/javascript">
var myform=new formtowizard({
	formid: 'init_asistant',
	persistsection: true,
	revealfx: ['slide', 500]    })
</script>
</head>

<body>
<?php ?>
    <div id="apDiv1">
    <p class="title">Asistente de Instalación</p><p>&nbsp;</p>
    <form id="init_asistant" name="init_asistant" action="index.php?install=true" method="POST" enctype="multipart/form-data">

    <!-- Paso 1: Bienvenido --><fieldset class="sectionwrap"><legend>Bienvenido</legend>
    <p class="text">Bienvenido al Sistema de Gestión de Inventario DecoBlue. Este Sistema le permitirá Gestionar toda la información de su negocio. Con el podrá:
    <blockquote class="text">- Registrar Ventas Realizadas e Imprimir Facturas y Reportes.<br>
    - Guardar Información sobre sus Clientes y Empleados.<br>
    - Llevar un Registro sobre los Articulos disponibles en el Inventario y sus Proveedores. <br>
    - Realizar Tareas de manera más sencilla y facil.
    </blockquote></p>
    <p class="text">Pero antes debe crear un Administrador Global y Configurar ciertas opciones para poder comenzar a Usar el Sistema.</p>
    </fieldset>

    <!-- Paso 2: Crear Usuario --><fieldset class="sectionwrap"><legend>Crear Usuario</legend>
    <p class="text">Ingrese un Nombre de Usuario y una Contraseña que servirá para crear la cuenta del Administrador Global.</p>
    <!-- Nombre de Usuario --><p><label for="username">Usuario: </label><input id="username" name="username" type="text" class="inputbox1"></p><br>
    <!-- Contraseña --><p><label for="password1">Contraseña: </label><input id="password1" name="password1" type="password" class="inputbox1"></p><br>
    <!-- Confirmar Contraseña --><p><label for="password2">Confirmar Contraseña: </label><input id="password2" name="password2" type="password" class="inputbox1"></p>
    </fieldset>

    <!-- Paso 3: Otros Datos --><fieldset class="sectionwrap"><legend>Otros Datos</legend>
    <p class="text">Ingrese su Nombre, Email, Cedula y Fecha de Nacimiento (Formato: AAAA-MM-DD).</p>
    <!-- Nombre --><p><label for="name">Nombre: </label><input id="name" name="name" type="text" class="inputbox1"></p><br>
    <!-- Email --><p><label for="email">Email: </label><input id="email" name="email" type="text" class="inputbox1"></p><br>
    <!-- Cedula --><p><label for="ci">Cedula: </label><input id="ci" name="ci" type="text" class="inputbox1"></p><br>
    <!-- Fecha de Nacimiento --><p><label for="born_date">Fecha de Nacimiento: </label><input id="born_date" name="born_date" type="text" class="inputbox1" placeholder="AAAA-MM-DD"></p>
    </fieldset>

    <!-- Paso 4: Finalizar --><fieldset class="sectionwrap"><legend>Finalizar</legend>
    <p class="text">Ingrese el Codigo de Activación dado por el Desarrollador del Sistema.</p>
    <!-- Email --><p><label for="act_cod">Codigo de Activación: </label><input id="act_cod" name="act_cod" type="text" class="inputbox1"></p><br>
    <input type="submit" value="Finalizar" name="submit" id="submit" class="button2">
</fieldset>

<!-- Form (End) -->


</form></div>
<?php } ?>
</body>
</html>