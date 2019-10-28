<?php
include("components/conexion/conexion.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';

if($_GET['function']=="edit" && $_POST['save']) {		
		
		$client_name = $_POST['client_name'];
		$client_ci = $_POST['client_ci'];
		$client_address = $_POST['client_address'];
		$client_tel = $_POST['client_tel'];
		
		$query= "UPDATE `".$dbname."`.`cliente` SET 
cedula = '$client_ci',
nombre = '$client_name', 
direccion = '$client_address',
telefono = '$client_tel' WHERE cedula = '$_GET[id]'";
		
		$rs = mysql_query($query);
		
 	if($rs == true) {
			echo "<script language=javascript>alert('Informacion del Cliente Editada con exito en el inventario')</script>";
			echo '<script>location="content.php?option=admin&task=clientes"</script>'; }
		else {
			echo "Ha Ocurrido un Error: Cliente no agregado al registro"; 
			echo '<script>location="content.php?option=admin&task=clientes"</script>';} 
			
}

    $query2 = mysql_query("SELECT * FROM cliente WHERE cedula = '$_GET[id]'") ;
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
	<form action="content.php?option=admin&amp;task=edit_client&amp;function=edit&id=<?php echo $_GET['id']?>" method="post" id="edit_client">
	<tr class="row0">
				<td><label for="client_name">Nombre del Cliente: </label><input class="inputbox" type="text" name="client_name" id="client_name" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['nombre'];?>"> 	<div id="client_name_text" class="info_box"><p>Ingrese el Nombre del Cliente, si lo desea puede hacerlo junto a su apellido.</p></div></td></tr> 
                  
	<tr class="row0"><td>		
    <label for="client_ci">C.I.: </label><input class="inputbox" type="text" name="client_ci" id="client_ci" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['cedula'];?>">
<div id="client_ci_text" class="info_box"><p>Ingrese el número de Cedula de Identidad del Cliente o RIF.</p></div></td></tr>
                
        	<tr class="row0"><td>	        
            <label for="client_address">Dirección: </label><input class="inputbox"type="text" name="client_address" id="client_address" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['direccion'];?>">
<div id="client_address_text" class="info_box"><p>Ingrese la Dirección del Cliente.</p></div></td></tr>
            
            
<tr class="row0"><td>
<label for="client_tel">Telefono: </label><input class="inputbox" type="number" name="client_tel" id="client_tel" onfocus="showHelp(this);" onblur="hideHelp(this);" value="<?php echo $values['telefono'];?>">
<div id="client_tel_text" class="info_box"><p>Numero de Telefono de Contacto del Cliente.</p></div></td></tr>

			<tr align="center"><td><input type="submit" name="save" value="Guardar Información"></td></tr>
				
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