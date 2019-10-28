<?php
// Este Script hace posible que una persona se registre en el Sistema.

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
    $ac_code = rand(111111, 999999);

    if(isset($_POST['submit'])) { $submit = $_POST['submit']; } else { $submit = ''; }

    if($submit) {

    $admin_uname =  htx($_POST['admin-username_reg']);
    $admin_gpass = md5($_POST['admin-password']);
    $pass101 = $_POST['password_reg'];
    $pass2 = $_POST['confirm_password'];

    $sql_000 = mysql_query("SELECT * FROM usuarios WHERE username = '$admin_uname' OR email = '$admin_uname'");
	$autorization = mysql_fetch_array($sql_000);

    if($autorization['password'] === $admin_gpass) { if($pass101 == $pass2){

    $pass1 = md5($_POST['password_reg']);
    $name = htx($_POST['name_reg']);
    $nick =  htx($_POST['username_reg']);
    $nick101 = $_POST['username_reg'];
    $email101 = $_POST['email'];
    $email =  htx($_POST['email']);
    $ip = $_SERVER["REMOTE_ADDR"];
    $us_type = '3';

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
        (user_reg, username, password, email, user_type, ip, nombre)
        VALUES ('$date','$nick','$pass1','$email','$us_type','$ip','$name')")) {

    echo '<script>alert("Ha Ocurido un Error al Registrarse. Intente de Nuevo"); window.location="javascript:history.back()";</script>'; }

    echo $wait_msg.'<script>location="index.php?username='.$nick.'"</script>'; }

    }} else {   ?>

<script type="text/javascript" src="web/common.js"></script>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('confirm_password', function (value) { return ($('password_reg').value == value); }	);
	});
// -->
</script>
    <div class="complete_main"><!-- Contenedor -->
    <div class="clear-separator"></div><!-- Separador -->

    <!-- Formulario --><form id="sign_up" name="sign_up" action="content.php?option=sign_up" method="POST" enctype="multipart/form-data" class="form-validate">

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Regístrate</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row0"><td align="center">Registrarse es muy fácil y solo toma 1 minuto.</td></tr>

	<!-- Campo 1: Nombre --><tr class="row0"><td><label for="name_reg"><strong>Nombre:</strong></label>
    <input name="name_reg" id="name_reg" maxlength="50" size="40" class="inputbox required" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
	<div id="name_reg_text" class="info_box"><p>Ingresa solamente tu Primer Nombre, Ej.: Luis.</p></div></td></tr>

    <!-- Campo 2: Usuario --><tr class="row0"><td><label for="username_reg"><strong>Nombre de Usuario</strong></label>
    <input name="username_reg" id="username_reg" maxlength="25" size="40" class="inputbox required validate-username" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="username_reg_text" class="info_box"><p>Solo están permitidos letras del Alfabeto Latino (A-Z), números (0-9) y carácteres como: guión (-) y guión bajo (_). Se permite como mínimo 3 carácteres y debe iniciar con una letra.</p></div></td></tr>

    <!-- Campo 3: Email --><tr class="row0"><td><label for="email"><strong>Email:</strong></label>
    <input name="email" id="email" class="inputbox required validate-email" size="40" maxlength="100" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="email_text" class="info_box"><p>Se requiere que ingrese un E-mail real. Su correo no será publicado sin su permiso o utilizado para enviarle Spam o correo basura.</p></div></td></tr>

    <!-- Campo 4: Contraseña --><tr class="row0"><td><label for="password_reg"><strong>Contraseña:</strong></label>
    <input name="email" id="email" class="inputbox required validate-email" size="40" maxlength="100" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="password_reg_text" class="info_box"><p>Se permite un mínimo de 4 carácteres. No puede contener espacios y es sensible a las mayúsculas.<br>Ej.: AZULejo = azulejo.</p></div></td></tr>

    <!-- Campo 5: Verificación de Contraseña --><tr class="row0"><td><label for="confirm_password"><strong>Repite tu contraseña:</strong></label>
    <input name="confirm_password" id="confirm_password" class="inputbox required validate-passverify" size="40" maxlength="32" onfocus="showHelp(this);" onblur="hideHelp(this);" type="password">
    <div id="confirm_password_text" class="info_box"><p>Por seguridad, debes verificar tu contraseña volviendola a escribir.</p></div></td></tr>

    <!-- Campo 6: Administrador Global --><tr class="row0"><td><label for="admin-username_reg"><strong>Administrador Global: </strong></label>
    <input name="admin-username_reg" id="admin-username_reg" class="inputbox required" size="40" maxlength="32" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="admin-username_reg_text" class="info_box"><p>Para poder registrar un nuevo usuario, el Administrador Global del sistema debe autorizarlo. Ingresa el nombre de usuario del Administrador Global del sistema.</p></div></td></tr>

    <!-- Campo 7: Administrador Global --><tr class="row0"><td><label for="admin-password"><strong>Contraseña Global: </strong></label>
    <input name="admin-password" id="admin-password" class="inputbox required" size="40" maxlength="32" onfocus="showHelp(this);" onblur="hideHelp(this);" type="password">
    <div id="admin-password_text" class="info_box"><p>Para poder registrar un nuevo usuario, el Administrador Global del sistema debe autorizarlo. Ingresa la contraseña del Administrador Global del sistema.</p></div></td></tr>

    <!-- Botón --><tr class="row0"><td><input name="submit" value="Registrate" class="button validate" type="submit"></td></tr>

        </tbody>
    </table>
</form>

    <div class="clear-separator"></div><!-- Separador -->
</div>
<?php } ?>