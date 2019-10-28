<?php
include("components/conexion/conexion.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';



if($_GET['function']=="edit" && $_POST['save']) {		
		
		$cod_ref = $_POST['cod_ref']; 
		$rifp = $_POST['rifp'];
		$address= $_POST['address'];
		$p_number = $_POST['p_number'];
		
		$query= "UPDATE `".$dbname."`.`proovedor` SET 
nombre = '$cod_ref',
direccion = '$address', 
telefono = '$p_number',
rifp ='$rifp' WHERE cod_ref = '$_GET[id]'";
		
		$rs = mysql_query($query);
		
 	if($rs == true) {
			echo "<script language=javascript>alert('Informacion Modificada con Exito')</script>";
			echo '<script>location="content.php?option=admin&task=proveedor"</script>'; }
		else {
			echo "Ha Ocurrido un Error: No se han podido modificar los datos"; 
			echo '<script>location="content.php?option=admin&task=proveedor"</script>';} 
			
}

    $query2 = mysql_query("SELECT * FROM proovedor WHERE cod_ref = '$_GET[id]'") ;
    $values = mysql_fetch_array($query2) ;
	
?>

<div class="complete_main">



    
    <table class="adminlist" cellpadding="1">
		<thead>
			<tr>
		
		
				<th class="title">
  

Editar un articulo del inventario
</th>
	</tr>

		</thead>

<tbody>
                    <div class="form">
	<form action="content.php?option=admin&amp;task=edit_provider&amp;function=edit&id=<?php echo $_GET['id']?>" method="post" id="add_art">
	<tr class="row0">
				<td>		<label for="cod_ref">Nombre: </label><input class="inputbox" type="text" name="cod_ref" id="cod_ref" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['nombre'];?>">
                <div id="cod_ref_text" class="info_box"><p>Ingrese Nombre de la empresa o negocio que provee.</p></div></td></tr> 
                  
	<tr class="row0"><td>		
    <label for="rifp">RIF: </label><input class="inputbox"  type="text" name="rifp" id="rifp" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['rifp'];?>"> 
<div id="rifp_text" class="info_box"><p>Ingrese el RIF de la Empresa o negocio que provee.</p></div></td></tr>
                
        	<tr class="row0"><td>	        
            <label for="address">Dirección: </label><input class="inputbox" type="text" name="address" id="address" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['direccion'];?>">
<div id="address_text" class="info_box"><p>Ingrese la dirección del negocio o empresa.</p></div></td></tr>
            
            
<tr class="row0"><td>
<label for="p_number">Telefono: </label><input class="inputbox" type="number" name="p_number" id="p_number" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['direccion'];?>">
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
