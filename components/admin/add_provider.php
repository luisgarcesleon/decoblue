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
include("components/conexion/conexion.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';


if($_GET['function']=="add" && $_POST['save']) {
		

		$cod_ref = $_POST['cod_ref']; 
		$rifp = $_POST['rifp'];
		$address= $_POST['address'];
		$p_number = $_POST['p_number'];
		
		$query = "INSERT INTO `".$dbname."`.`proovedor` (
`nombre` ,
`direccion` ,
`telefono` ,
`rifp`
) VALUES 
('$cod_ref','$rifp','$address','$p_number')";
		
		$rs = mysql_query($query);
		
 	if($rs == true) {
			echo "<script language=javascript>alert('Proveedor añadido')</script>";
			echo '<script>location="content.php?option=admin&task=proveedor"</script>'; }
		else {
			echo "Error al guardar los datos"; 
			echo '<script>location="content.php?option=admin&task=proveedor"</script>';} 
			
}



?>
<script type="text/javascript" src="web/common.js"></script>
<div class="complete_main">



    
    <table class="adminlist" cellpadding="1">
		<thead>
			<tr>
		
		
				<th class="title">
  

Agregar Proveedor
</th>
	</tr>

		</thead>

<tbody>

				  		
                        <div class="form">
	<form action="content.php?option=admin&amp;task=add_provider&amp;function=add" method="post" id="add_art">
	<tr class="row0">
				<td>		<label for="cod_ref">Nombre: </label><input class="inputbox" type="text" name="cod_ref" id="cod_ref" onfocus="showHelp(this);" onblur="hideHelp(this);">
                <div id="cod_ref_text" class="info_box"><p>Ingrese Nombre de la empresa o negocio que provee.</p></div></td></tr> 
                  
	<tr class="row0"><td>		
    <label for="rifp">RIF: </label><input class="inputbox"  type="text" name="rifp" id="rifp" onfocus="showHelp(this);" onblur="hideHelp(this);"> 
<div id="rifp_text" class="info_box"><p>Ingrese el RIF de la Empresa o negocio que provee.</p></div></td></tr>
                
        	<tr class="row0"><td>	        
            <label for="address">Dirección: </label><input class="inputbox" type="text" name="address" id="address" onfocus="showHelp(this);" onblur="hideHelp(this);">
<div id="address_text" class="info_box"><p>Ingrese la dirección del negocio o empresa.</p></div></td></tr>
            
            
<tr class="row0"><td>
<label for="p_number">Telefono: </label><input class="inputbox" type="number" name="p_number" id="p_number" onfocus="showHelp(this);" onblur="hideHelp(this);">
<div id="p_number_text" class="info_box"><p>Ingrese el telefono de contacto del proveedor.</p></div></td></tr>

       
			<tr align="center"><td><input type="submit" name="save" value="Guardar Informacion"></td></tr>
				
</form>
</div>	
					</tbody>
	</table>


  
    <!-- end .content --> <div class="clear"></div>  
    <div class="clear"></div>  
</div>

<?php } else {
	
	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}

?>