<?php
// Este Script ayuda al usuario a recuperar su Usuario y Contraseña en caso de extravío.

    // Recuperar Informacion
    define('_MENSAJE_1_','Recuperar Informacion
    Este mensaje ha sido enviado a tu e-mail debido a que se ha solicitado recuperar tu
    información de Cuenta Usuario. Se te dará una nueva contraseña la cual podrás modificar en
    la sección "Editar Perfil".

    Datos Actualizados:
    Usuario: ');

define('_MENSAJE_2_','   Contraseña : ');
define('_MENSAJE_1_1','Recuperar Informacion

Nuestro Sistema de Recuperación de Cuentas ha generado una nueva Contraseña con su información.
Para evitar que terceras personas cambien su información sin su aceptación debe autorizar el cambio
aqui: '.$dirw.'content.php?option=web&task=recovery_info');

    if(isset($_GET['function']) && $_GET['function'] == "change") { $function1 = $_GET['function']; } else { $function1 = ''; }

    if($function1 == "change"){

	$user_id2 = $_GET['user_id'];
	$user_pass2 = $_GET['hash'];

    $query_info2 = mysql_query("SELECT * FROM usuarios WHERE id ='$user_id2' AND password = '$user_pass2'");
    $user2 = mysql_fetch_array($query_info2);

    if(mysql_num_rows($query_info2) == 0) {
        exit("Ha ocurrido un Error al intentar recuperar tu información");
            } else {

    $randpass = rand(000000,999999);
    $randpassmd5 = md5($randpass);

    mysql_query("UPDATE usuarios SET password = '$randpassmd5' WHERE id = '$user_id2'");

    $mensaje = _MENSAJE_1_.''.$user2['username'].''._MENSAJE_2_.''.$randpass.'';

//______________________________________________________________________________________//
// Datos Requeridos para Enviar Email
    $mailTo = "$user[email]";
    $mailFrom = "admin@decoblue.com.ve";
    $mailFromName = "DecoBlue";
    $mailSubject = "Recuperación de Información";
    $mailMessage = "$mensaje";

//______________________________________________________________________________________//
// Enviar Email
    mail($mailTo, $mailSubject, $mailMessage, "From: $mailFromName <$mailFrom>\r\n");

    echo 'Se te ha enviado la nueva contraseña actualizada a tu email';
        }} else {

    if(isset($_POST['submit'])) { $submit = $_POST['submit']; } else { $submit = ''; }

    if($submit) {

	$info_text = $_POST['name_reg'];

    $query_info = mysql_query("SELECT * FROM usuarios WHERE username = '$info_text' OR email = '$info_text'");
    $user = mysql_fetch_array($query_info);

	$user_id = $user['id'];
	$user_pass = $info['password'];

    if(mysql_num_rows($query_info)!= 0){

    $mensaje = _MENSAJE_1_1.'&function=change&user_id='.$user_id.'&hash='.$user_pass.'';

//______________________________________________________________________________________//
// Datos Requeridos para Enviar Email
    $mailTo = "$user[email]";
    $mailFrom = "admin@decoblue.com.ve";
    $mailFromName = "DecoBlue";
    $mailSubject = "Recuperación de Información";
    $mailMessage = "$mensaje";

//______________________________________________________________________________________//
// Enviar Email
    mail($mailTo, $mailSubject, $mailMessage, "From: $mailFromName <$mailFrom>\r\n");

    echo "Se ha enviado un Mensaje de Confirmación a tu E-mail";
    echo '<a href="index.php" title="Salir">Salir</a>';     } else {

    echo "Usuario no Encontrado verifique si la información que encontro es correcta.";
        }} else {               ?>
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

    <!-- Formulario --><form id="recovery_info" name="recovery_info" action="content.php?option=web&task=recovery_info" method="POST" enctype="multipart/form-data" class="form-validate">

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">¿Olvido toda su Información?</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row0"><td align="center">No se preocupe, dentro de poco la recuperará. Es muy fácil y solo le tomará 1 minuto.</td></tr>

	<!-- Campo 1: Nombre o Email --><tr class="row0"><td><label for="name_reg"><strong>Usuario o Email:</strong></label>
    <input name="name_reg" id="name_reg" maxlength="50" size="40" class="inputbox required" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
	<div id="name_reg_text" class="info_box"><p>Ingrese su nombre de Usuario o su Direccion de Correo Electronico (Email).</p></div></td></tr>

    <!-- Botón --><tr class="row0"><td><input name="submit" value="Recuperar Información" class="button validate" type="submit"></td></tr>

        </tbody>
    </table>
</form>

    <div class="clear-separator"></div><!-- Separador -->
</div>
<?php   }}      ?>