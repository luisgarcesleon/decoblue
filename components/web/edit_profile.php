<?php
// Este Script permite al Usuario Editar su Perfil y Datos Personales.

    if(isset($_POST['save'])) { $save = $_POST['save']; } else { $save = ''; }
    if(isset($_GET['function']) && $_GET['function'] == "edit") { $edit = $_GET['function']; } else { $edit = ''; }

    if($edit == "edit" && $save) {
        if($_POST['contrasena1'] && $_POST['contrasena2']){
            if($_POST['contrasena1'] == $_POST['contrasena2']){

    $contrasena = md5($_POST['contrasena1']);

    mysql_query("UPDATE usuarios SET password ='$contrasena' WHERE id = '$_COOKIE[id]'");

    } else {    $error = "Las contraseñas no coinciden";    }}

    // Función para que los Datos ingresados sean seguros y evitar Inyección SQL.
    function html($texto) {
    $texto = trim($texto) ;
    $texto = htmlspecialchars($texto) ;
    return $texto ;     }

    // Establecer Zona Horaria y Fecha Actual
    date_default_timezone_set('America/Caracas');
    $fecha = time();
	$date = date("Y-m-d H:i:s");

    $nombre = html($_POST['nombre']);
    $apellido = html($_POST['apellido']);
    $email = html($_POST['email']);
    $ci = html($_POST['ci']);
    $sexo = html($_POST['sexo']);
    $pais = html($_POST['pais']);
    $descripcion = html($_POST['descripcion']);
    $born_date = html($_POST['born_date']);
    $ip = $_SERVER["REMOTE_ADDR"];
    $id = $_COOKIE['id'];

	$query = "UPDATE `".$dbname."`.`usuarios` SET 
		cedula = '$ci', 
        born_date='$born_date',
		email='$email',
        pais='$pais',
		sexo='$sexo',
		descripcion='$descripcion',
		ip='$ip',
		nombre='$nombre',
		apellido = '$apellido'
		WHERE id='$id'";


	$rs = mysql_query($query);
		
 	if($rs == true) {
			echo "<script language=javascript>alert('Tu perfil se ha editado con éxito.')</script>";
			echo '<script>location="content.php?option=admin&task=usuarios"</script>'; }
		else {
			echo "Ha ocurrido un error, no se han podido editar los datos"; 
			echo '<script>location="content.php?option=admin&task=usuarios"</script>';  }}

    $query = mysql_query("SELECT * FROM usuarios WHERE id='$id'");
    $datos = mysql_fetch_array($query);                     ?>

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

    <!-- Formulario --><form id="edit_profile" name="edit_profile" action="content.php?option=web&amp;task=edit_profile&amp;function=edit" method="POST" enctype="multipart/form-data" class="form-validate">

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Editar Perfil</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row4"><td><strong>Cambiar Contraseña</strong></td></tr><!-- Titulo -->

    <!-- Campo 1.1: Nueva Contraseña --><tr><td><label for="contrasena1">Nueva Contraseña: </label>
    <input name="contrasena1" id="contrasena1" class="inputbox" onfocus="showHelp(this);" onblur="hideHelp(this);" type="password">
    <div id="contrasena1_text" class="info_box"><p>Ingrese una nueva contraseña.</p></div></td></tr>

    <!-- Campo 1.2: Confirmar Nueva Contraseña --><tr><td><label for="contrasena2">Confirma tu Nueva Contraseña: </label>
    <input name="contrasena2" id="contrasena2" class="inputbox" onfocus="showHelp(this);" onblur="hideHelp(this);" type="password">
    <div id="contrasena2_text" class="info_box"><p>Confirme su nueva contraseña.</p></div></td></tr>

	<tr class="row4"><td><strong>Datos de Usuario y Perfil</strong></td></tr><!-- Titulo -->

    <!-- Campo 2.1: Email --><tr><td><label for="email">Email: </label>
    <input name="email" id="email" class="inputbox" value="<?php echo $datos['email'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="email_text" class="info_box"><p>Edite su Dirección de Correo Electronico.</p></div></td></tr>

    <!-- Campo 2.2: Nombre --><tr><td><label for="email">Nombre:</label>
    <input name="nombre" id="nombre" class="inputbox" value="<?php echo $datos['nombre'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="nombre_text" class="info_box"><p>Edite su Nombre.</p></div></td></tr>

     <!-- Campo 2.3: Apellido --><tr><td><label for="apellido">Apellido: </label>
     <input id="apellido" name="apellido" class="inputbox" value="<?php echo $datos['apellido'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
     <div id="apellido_text" class="info_box"><p>Edite su Apellido.</p></div></td></tr>

    <!-- Campo 2.4: Cedula de Identidad --><tr><td><label for="ci">Cedula de Identidad: </label>
    <input id="ci" name="ci" class="inputbox" value="<?php echo $datos['cedula'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="ci_text" class="info_box"><p>Edite su Cedula de Identidad.</p></div></td></tr>

    <!-- Campo 2.5: Fecha de Nacimiento --><tr><td><label for="born_date">Fecha de Nacimiento (Año-Mes-Dia): </label>
    <input id="born_date" name="born_date" class="inputbox" value="<?php echo $datos['born_date'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="born_date_text" class="info_box"><p>Edite su Fecha de Nacimiento, debe seguir el siguiente patrón Año-Mes-Dia. Ejemplo: 1999-02-26.</p></div></td></tr>

    <!-- Campo 2.6: Pais --><tr><td><label for="pais">Pais: </label>
    <input id="pais" name="pais" class="inputbox" value="<?php echo $datos['pais'];?>" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="pais_text" class="info_box"><p>Edite su Pais</p></div></td></tr>

    <!-- Campo 2.7: Sexo --><tr><td><label for="sexo">Sexo: </label>
    <select name="sexo" id="sexo" class="inputbox">
    <option value="0" <?php if($datos['sexo'] == '0') { echo 'selected="selected"'; } ?>>Masculino</option>
    <option value="1" <?php if($datos['sexo'] == '1'){ echo 'selected="selected"'; } ?>>Femenino</option>
    </select></td></tr>

    <!-- Campo 2.8: Sexo --><tr><td><label for="descripción">Descripción Personal: </label>
    <textarea id="descripcion" name="descripcion" class="inputbox" cols="40" rows="2" onfocus="showHelp(this);" onblur="hideHelp(this);"><?php echo $datos['descripcion'];?></textarea>
    <div id="descripcion_text" class="info_box"><p>Ingrese una Descripción Personal Breve.</p></div></td></tr>

    <!-- Botón --><tr class="row0"><td><input name="save" value="Guardar Información" class="button validate" type="submit"></td></tr>

        </tbody>
    </table>
</form>

    <div class="clear-separator"></div><!-- Separador -->
</div>