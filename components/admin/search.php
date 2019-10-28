<?php

	include("../../components/conexion/conexion.php");
    include('pagination2.php');

 if($_GET['function']=="art") {
	
                   ?>
<html><head><title>Buscar Articulo</title></head><body>
<script language="JavaScript" type="text/javascript">/*<![CDATA[*/
    function auto_copy(name, price, cod_art_hid) {
        if (name == '' & price=='' && cod_art=='') {window.alert("Selecciona un Articulo");} else {
   	        window.opener.document.venta.art_name.value = name;
			window.opener.document.venta.art_price.value = price;
			window.opener.document.venta.cod_art_hid.value = cod_art_hid;
	    self.close(); }}
/*]]>*/</script>
<style type="text/css">/*<![CDATA[*/
body{background:#000;color:#FFF;font:11px Verdana,Helvetica,Arial,sans-serif;margin:0px;}
body,td,th{font:11px Verdana,Arial,Helvetica,sans-serif;}
a:hover{color:#D9E4EA;text-decoration:none;text-shadow:0 0 7px #A4DCFF;}
a:link,a:visited{color:#5fb2d0;text-decoration:none;}
/*]]>*/</style>

<table align="center" width="100%" cellpadding="4" cellspacing="1" border="0"><form name="search_user" action="search.php?function=art" method="POST">
<tr><td><strong>Selecciona Articulo</strong></td></tr><tr><td>

<table width="100%"  border="0" cellspacing="0" cellpadding="2">
<tr><td><div align="left">
<input name="search_art" type="text" id="search_art" size="15"><input name="search" type="submit" id="search" value="Buscar"></div></td></tr>

<tr><td><strong>Nombre</strong></td><td><strong>Codigo</strong></td></tr>


<?php
    if(isset($_POST['search'])) { $search = $_POST['search']; } else { $search = ''; }

	if($search) {
            $search = "WHERE cod_art LIKE '%$_POST[search_art]%' OR nombre LIKE '%$_POST[search_art]%'";}

    $query = new paginar("SELECT * FROM articulo $search ORDER BY cod_art ASC");
    $query->mostrar("25");
    $con = $query->procesar_codigo();

        if(mysql_num_rows($con)== 0) {
            echo "Articulo No Encontrado. <a href=\"search.php?function=art\">Regresar</a>.";
            } else { while($datos = mysql_fetch_array($con)){?>

<tr><td><a href="javascript:auto_copy('<?php echo $datos['nombre'];?>','<?php echo $datos['precio_venta'];?>','<?php echo $datos['cod_art'];?>')"><?php echo $datos['nombre'];?></a></td>

<td align="center" valign="middle"><?php echo $datos['cod_art'];?></td></tr><?php }}?><tr><td>
<?php
$query->crear_paginas()?>
</td></tr></table></td></tr></form></table></body></html>

<?php } elseif($_GET['function']=="client") {
	
	?>
	
    
    <html><head><title>Buscar Cliente</title></head><body>
<script language="JavaScript" type="text/javascript">/*<![CDATA[*/
    function auto_copy(name) {
        if (name == '') {window.alert("Selecciona un Articulo");} else {
   	        window.opener.document.venta.client.value = name;
	    self.close(); }}
/*]]>*/</script>
<style type="text/css">/*<![CDATA[*/
body{background:#000;color:#FFF;font:11px Verdana,Helvetica,Arial,sans-serif;margin:0px;}
body,td,th{font:11px Verdana,Arial,Helvetica,sans-serif;}
a:hover{color:#D9E4EA;text-decoration:none;text-shadow:0 0 7px #A4DCFF;}
a:link,a:visited{color:#5fb2d0;text-decoration:none;}
/*]]>*/</style>

<table align="center" width="100%" cellpadding="4" cellspacing="1" border="0"><form name="search_user" action="search.php?function=client" method="POST">
<tr><td><strong>Selecciona Cliente</strong></td></tr><tr><td>

<table width="100%"  border="0" cellspacing="0" cellpadding="2">
<tr><td><div align="left">
<input name="search_client" type="text" id="search_client" size="14"><input name="search" type="submit" id="search" value="Buscar"></div></td></tr>

<tr><td><strong>Nombre</strong></td><td><strong>Cedula</strong></td></tr>


<?php
if(isset($_POST['search'])) { $search = $_POST['search']; } else { $search = ''; }

	if($search) {
            $search = "WHERE cedula LIKE '%$_POST[search_client]%' OR nombre LIKE '%$_POST[search_client]%'";}

    $query = new paginar("SELECT * FROM cliente $search ORDER BY cedula ASC");
    $query->mostrar("25");
    $con = $query->procesar_codigo();

        if(mysql_num_rows($con)== 0) {
		echo "<a href=\"../../content.php?option=admin&task=add_client\" target=\"_blank\">Añadir Nuevo Cliente</a>.<br/>";
            echo "Cliente No Encontrado. <a href=\"search.php?function=client\">Regresar</a>.";
            } else { while($datos = mysql_fetch_array($con)){?>

<tr><td><?php echo $datos['nombre'];?></td>

<td align="center" valign="middle"><a href="javascript:auto_copy('<?php echo $datos['cedula'];?>')"><?php echo $datos['cedula'];?></a></td></tr><?php }}?><tr><td>
<?php
$query->crear_paginas()?>
</td></tr></table></td></tr></form></table></body></html>

<?php } else {
	echo "Función No Permitida para esta aplicación.";

}?>