<script type="text/javascript">
// Funcion para Abrir Venta PopUp
function abrir(url,anchura,altura,scroll)
{
var centrado = (screen.width/0)-(altura/0);
window.open(url, "", "scrollbars="+scroll+",left="+centrado+",top=10,width="+anchura+",height="+altura);
}
function abrir2(url,anchura,altura,scroll)
{
var centrado = (screen.width/2)-(altura/2);
window.open(url, "", "scrollbars="+scroll+",center="+centrado+",top=10,width="+anchura+",height="+altura);
}

</script>
<?php
// Este Script hace posible las ventas y los registros de ventas.

    if(isset($_COOKIE['id'])) { $id_auth = $_COOKIE['id']; } else { $id_auth = ''; }

  	$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
	$auth_data = mysql_fetch_array($auth);

	if($auth_data['user_type'] == '1' OR $auth_data['user_type'] == '2' OR $auth_data['user_type'] == '3' ) {
		echo '<!-- Autorizado -->';

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

    if(isset($_POST['submit'])) { $submit = $_POST['submit']; } else { $submit = ''; }
    if(isset($_GET['function']) && $_GET['function'] == "confirm_purchase") { $function1 = $_GET['function']; } else { $function1 = ''; }
    if(isset($_GET['purchase_no'])) { $function2 = $_GET['purchase_no']; } else { $function2 = ''; }
    if(isset($_GET['function'])) { $function5 = $_GET['function']; } else { $function5 = ''; }

    $p_no = $function2;
    $ip = $_SERVER["REMOTE_ADDR"];
    $purchase_code = rand(1111111111, 9999999999);
    $wait_msg = '<div align="center"><img src="/media/images/loading.gif" border="0" alt="Espere..." /></div><div align="center">Venta Exitosa</div>';
    $wait_msg2 = '<div align="center"><img src="/media/images/loading.gif" border="0" alt="Espere..." /></div><div align="center">Agregando Producto...</div>';

    global $p_no, $ip, $purchase_code, $wait_msg, $wait_msg2;

    if(isset($_GET['purchase'])) { $function3 = $_GET['purchase']; } else { $function3 = ''; }

	if($function3  == 'true') {

    $art_name2 = $_GET['art_name'];
    $client2 = $_GET['client'];
    $art_cant2 = $_GET['cant'];
    $art_price2 = $_GET['price'];
    $pay_type2 = $_GET['pay_tipe'];
	$cod_art2 = $_GET['cod_art'];
	$p_id = "purchase_id";
    $total =  $art_cant2*$art_price2;

    mysql_query("UPDATE articulo SET stock_real=stock_real-$art_cant2 WHERE cod_art='$cod_art2'");
	mysql_query("INSERT INTO venta VALUES (NULL,'$cod_art2','$client2','$art_cant2','$art_price2','$pay_type2','$total', '$purchase_code','$date')");

	echo '<script>location="components/admin/setcookie.php?purchase_id='.$purchase_code.'&purchase_no='.$p_no.'"</script>';

}

	if($function3  == 'false') {

    $art_name2 = $_GET['art_name'];
    $client2 = $_GET['client'];
    $art_cant2 = $_GET['cant'];
    $art_price2 = $_GET['price'];
    $pay_type2 = $_GET['pay_tipe'];
	$cod_art2 = $_GET['cod_art'];
	$p_id = "purchase_id";
    $total =  $art_cant2*$art_price2;

    mysql_query("UPDATE articulo SET stock_real=stock_real-$art_cant2 WHERE cod_art='$cod_art2'");
	mysql_query("INSERT INTO venta VALUES (NULL,'$cod_art2','$client2','$art_cant2','$art_price2','$pay_type2','$total', '$purchase_code','$date')") ;

	echo '<script>location="components/admin/setcookie.php?purchase_id='.$purchase_code.'&purchase_no='.$p_no.'&client='.$client2.'&mode_false=on"</script>'; 
}

    if(isset($_GET['display'])) { $function4 = $_GET['display']; } else { $function4 = ''; }

	if($function4 == 'register') {
        if(empty($_GET['purchase_no'])) {
	echo '<!-- No Hay Compras -->
    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">No Hay Compras Cargadas Aún</th></tr><!-- Titulo -->
        </thead>
</table>';
	            } else {
	
        $d = $_GET['purchase_no'];
	    $cl = $_GET['client'];

	echo '<!-- Compras Cargadas -->
    <div class="complete_main"><!-- Contenedor -->
    <div class="clear-separator"></div><!-- Separador -->

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Realizar Venta Manual</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row0"><td align="right"><!-- Opciones -->
    <!-- Nueva Compra --><a href="components/admin/setcookie.php?purchase_id='.$purchase_code.'&purchase_no='.$p_no.'&new_sale=on">Realizar una Nueva Compra</a> -';
    echo " <!-- Imprimir Factura --><a href=javascript:abrir2('components/admin/register.php?purchase_no=$d&client=$cl','700','700')>Imprimir Factura</a> -";
    echo '<!-- Exportar Factura en PDF --><a href="#" onclick="'; echo "return alert('Funcion no Disponible')"; echo '">Exportar Factura en PDF</a>
    </td></tr>

    </tbody>
</table>

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Articulos Comprados</th></tr><!-- Titulo -->
        </thead>';
  
    for ($i = 1; $i <= $d; $i++) {

	$c_name = "purchase_id".$i;
	
	$ps_id = $_COOKIE[$c_name];

    $query_sale = mysql_query("SELECT * FROM venta WHERE id_compra = '$ps_id'");
    $display = mysql_fetch_array($query_sale);
	
	$cod = $display['cod_art'];

	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);

	 echo '<table class="adminlist" cellpadding="1">
		<thead>
			<tr>


				<th class="title">

		'.$display2['nombre'].' ('.$cod.')


            </th>
	</tr>

		</thead>

		   <tbody>

<tr class="row0">
			  <td>Compra No.: '.$display['id_compra'].'</td></tr>


<tr class="row0">
			  <td>Fecha: '.$display['fecha'].'</td></tr>

<tr class="row0">
			  <td>Cantidad: '.$display['cantidad'].' Unidad(es)</td>
			  

			  <td>Precio:'.$display['precio'].' Bs.F.</td></tr> 
			  
<tr class="row0">
			  <td>Total: '.$display['total'].' Bs.F.</td>
			  
			  <td>Tipo de Pago: '.$display['tipo_pago'].'</td></tr> 		  

			  			  
		      </tbody>
     
     
  </table>';

}

	}
			}
	
	


		
if($submit && $function1 == "confirm_purchase"){
       $art_name = htx($_POST['art_name']);
    $client = $_POST['client'];
    $art_cant = $_POST['art_cant'];
    $art_price =  htx($_POST['art_price']);
    $pay_type = $_POST['pay_type'];
	$cod_art = $_POST['cod_art_hid'];
	echo '
<div class="complete_main">
	 <table class="adminlist" cellpadding="1">
		<thead>
			<tr>
		
		
				<th class="title">
  
		Confirmar Venta
        

            </th>
	</tr>

		</thead>
         <tbody>
            
	<tr class="row0">
		
		 <div class="form">
         
         

			  <td align="center">¿Desea agregar más productos a la compra?
<p><a href="content.php?option=admin&task=venta&purchase=true&art_name='.$art_name.'&client='.$client.'&cod_art='.$cod_art.'&cant='.$art_cant.'&price='.$art_price.'&pay_tipe='.$pay_type.'&purchase_no='.$p_no.'">Si, agregar más productos.</a> |<a href="content.php?option=admin&task=venta&purchase=false&art_name='.$art_name.'&client='.$client.'&cod_art='.$cod_art.'&cant='.$art_cant.'&price='.$art_price.'&pay_tipe='.$pay_type.'&purchase_no='.$p_no.'"> No, proceder a realizar la compra.</a> 
</p></div>
			  </td></tr> 
			       </tbody>
     
  </table>

			  
	
	';
	



}


 elseif($function5 == 'sale') {
	

if(get_rows("proovedor") == 0) {
  $alert1 = '   <table class="adminlist" cellpadding="1">
		<thead>

	  <th class="title">
				Alerta
		</th>

		</thead>


		<tbody>
 	<tr class="row3">
				<td>No se han agregado Proveedores al Registro. <a href="content.php?option=admin&task=add_provider" title="Agregar Proveedor">Haga click para Agregar Proveedores</a></td>
                  </tr>
                  	  </tbody>
	</table>';

}   else {  $alert1 = ''; }

if(get_rows("proovedor") >= 1 && get_rows("articulo") == 0) {
    $alert2 = '     <table class="adminlist" cellpadding="1">
		<thead>

	  <th class="title">
				Alerta
		</th>

		</thead>


		<tbody>
 	<tr class="row3">
				<td>No se han agregado Articulos al Inventario. <a href="content.php?option=admin&task=add_art" title="Agregar Articulos">Haga click para Agregar Articulos</a></td>
                  </tr>
                  	  </tbody>
	</table>';

}     else {  $alert2 = '';}

		 ?>
<script type="text/javascript" src="web/common.js"></script>
    <div class="complete_main"><!-- Contenedor -->
    <div class="clear-separator"></div><!-- Separador -->

    <?php   echo $alert1;
            echo $alert2;?>

    <!-- Formulario --><form id="venta" name="venta" action="content.php?option=admin&amp;task=venta&amp;function=confirm_purchase&amp;purchase_no=<?php if(empty($_GET['purchase_no'])) { $c = 1; } elseif(isset($_GET['purchase_no'])==TRUE) { $c = $_GET['purchase_no']+1; } echo $c;?>" method="POST" enctype="multipart/form-data" class="form-validate">

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Realizar Venta Manual</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row0"><td align="center">Sistema de Registro de Ventas Digital Automatizado.</td></tr>

	<!-- Campo 1: Codigo Articulo --><tr class="row0"><td><label for="art_name"><strong>Ingresa el Codigo del Articulo:</strong></label>
    <input name="art_name" id="art_name" maxlength="50" size="40" class="inputbox" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
	<div id="art_name_text" class="info_box"><p>Ingresa el Codigo del Articulo. Si lo olvidaste utiliza la herramienta "Buscar Articulo"" y selecciona el articulo.</p></div>
 	<input name="cod_art_hid" id="cod_art_hid" type="hidden">

    <!-- Botón Buscar Articulo --><input name="search_button" id="search_button" value="Buscar Articulo" onClick="abrir('components/admin/search.php?function=art','250','700')" type="button"></td></tr>

    <!-- Campo 2: Cedula --><tr class="row0"><td><label for="client"><strong>Cedula:</strong></label>
    <input name="client" id="client" maxlength="25"  size="40" class="inputbox" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="client_text" class="info_box"><p>Ingrese la Cedula del Usuario, pero antes verifique si este esta registrado como cliente en la Base de Datos con la Opción "Buscar Cliente".</p></div>

    <!-- Botón Buscar Cliente --><input name="search_button2" id="search_button2" value="Buscar Cliente" onClick="abrir('components/admin/search.php?function=client','250','700')" type="button"></td></tr>

    <!-- Campo 3: Cantidad --><tr class="row0"><td><label for="art_cant"><strong>Cantidad:</strong></label>
    <input name="art_cant" id="art_cant" class="inputbox" size="40" maxlength="50" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text">
    <div id="art_cant_text" class="info_box"><p>Ingrese Cantidad comprada del articulo.</p></div></td></tr>

    <!-- Campo 4: Precio --><tr class="row0"><td><label for="art_price"><strong>Precio:</strong></label>
    <input name="art_price" id="art_price" class="inputbox" size="10" maxlength="10" onfocus="showHelp(this);" onblur="hideHelp(this);" type="text"><strong>BsF.</strong>
    <div id="art_price_text" class="info_box"><p>Precio del Articulo por unidad en BsF.</p></div></td></tr>

    <!-- Campo 5: Forma de Pago --><tr class="row0"><td><label for="pay_type"><strong>Forma de Pago:</strong></label>
    <select name="pay_type" id="pay_type" class="inputbox" onfocus="showHelp(this);" onblur="hideHelp(this);">
        <option value="Credito">Credito</option>
        <option value="Debito">Debito</option>
        <option value="Cheque">Cheque</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Otro">Otro</option>
    </select>
    <div id="pay_type_text" class="info_box"><p>Seleccione la Forma de Pago del Cliente.</p></div></td></tr>

    <tr class="row0"><td><input name="submit" value="Realizar Venta" class="button" type="submit"></td></tr>

        </tbody>
    </table>
</form>

    <div class="clear-separator"></div><!-- Separador -->
<?php
    if(empty($_GET['purchase_id'])) {
	echo '<!-- No Hay Compras -->
    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">No Hay Compras Cargadas Aún</th></tr><!-- Titulo -->
        </thead>
</table>';
	            } else {

echo '  <!-- Compras Cargadas -->
        <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Articulos Comprados</th></tr><!-- Titulo -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->';

    $d = $_GET['purchase_no'];
	
    for ($i = 1; $i <= $d; $i++) {
	
	$c_name = 'purchase_id'.$i;
	
	$ps_id = $_COOKIE[$c_name];

    $query_sale = mysql_query("SELECT * FROM venta WHERE id_compra = '$ps_id'");
    $display = mysql_fetch_array($query_sale);
	
	$cod = $display['cod_art'];
	
	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);
	

echo '<tr class="row4"><td align="center">'.$display2['nombre'].' ('.$cod.').</td></tr><!-- Articulo y Codigo -->
    <tr class="row0"><td>Compra No.: '.$display['id_compra'].'</td></tr>
    <tr class="row0"><td>Fecha: '.$display['fecha'].'</td></tr>
    <tr class="row0"><td>Cantidad: '.$display['cantidad'].' Unidad(es)</td>
    <td colspan="2">Precio:'.$display['precio'].' Bs.F.</td></tr>
    <tr class="row0"><td>Total: '.$display['total'].' Bs.F.</td>
    <td>Tipo de Pago: '.$display['tipo_pago'].'</td></tr>';         }

echo ' </tbody>
</table>';	}
?>
</div>
<?php } }?>