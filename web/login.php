<?php
    include("components/conexion/conexion.php");
    if(isset($_GET['username'])) {  $user = $_GET['username']; }  else { $user = ''; }
?>
<!DOCTYPE HTML>
<html style="display: block;" lang="es-es">
<head>
<meta charset="utf-8">
<title>DecoBlue &middot; Inicia Sesión</title>

<style type="text/css">
body{
    background-image: url("media/images/bg_login.png");
	background-attachment: fixed;
	background-size: contain;
	background-repeat: no-repeat;
	background-color: rgb(34,34,34);	
}

body.msie.ie8{  background-image:none;background-color:#00326B; }

#apDiv1 {
	background-color: rgb(255,255,255);
	padding-top: 30px;
	padding-left: 40px;
	position: absolute;
	left: 372px;
	top: 93px;
	width: 360px;
	height: 370px;
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

#apDiv1 p {
	margin-top: 5px;
	margin-bottom: 10px;
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
	font-size: 36px;
	font-weight: lighter;

}

footer {
	display: block;
}
</style>
</head>

<body>
    <div id="apDiv1">
    <form id="login" name="login" action="login.php?mode=in" method="POST" enctype="multipart/form-data">
        <p class="title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inicia Sesión</p>

    <!-- Nombre de Usuario --><label for="username">Usuario</label><p><input id="username" name="username" type="text" class="inputbox1" value="<?php echo $user;?>" ></p><br>

    <!-- Contraseña --><label for="password">Contraseña</label><p><input id="password" name="password" type="password" class="inputbox1"></p>

    <!-- Entrar --><input id="entrar" name="entrar" type="submit" class="button1" value="Entrar"><br><br>

    <p> <a title="Registrar Usuario" href="content.php?option=sign_up">Registrate</a><br>
        <a title="¿Olvidaste tu clave?" href="content.php?option=web&amp;task=recovery_info">Olvide mi Información</a></p>
</form></div>
</body>
</html>