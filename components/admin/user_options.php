<?php

    if(isset($_COOKIE['id'])) { $id_auth = $_COOKIE['id']; } else { $id_auth = ''; }

  	$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
	$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type'] == '1') {
		echo '<!-- Autorizado -->';

if($_GET['function']=="change_type") {

    if(isset($_POST['save'])) { $save = $_POST['save']; } else { $save = ''; }

	if($save) {
			$user_type = $_POST['user_type'];
		
		$query2 = "UPDATE `".$dbname."`.`usuarios` SET user_type = '$user_type' WHERE id = '$_GET[id]'";
	
		$rs2 = mysql_query($query2);
		
 	if($rs2 == true) {
			echo "<script language=javascript>alert('Tipo de Usuario Modificado con Exito')</script>";
			echo '<script>location="content.php?option=admin&task=usuarios"</script>'; }
		else {
			echo "Ha Ocurrido un Error: Datos no Modificados"; 
			echo '<script>location="content.php?option=admin&task=usuarios"</script>';} 
			
			
}
	
?>


<div class="complete_main">



    
    <table class="adminlist" cellpadding="1">
		<thead>
			<tr>
		
		
				<th class="title">
  

Cambiar Tipo de Usuario
</th>
	</tr>

		</thead>

<tbody>

				  		
                        <div class="form">
	<form action="content.php?option=admin&task=user_options&function=change_type&id=<?php echo $_GET['id']?>" method="post" id="edit_art">
	
 		<tr class="row0"><td> <label for="user_type">Tipo de Usuario: </label> <select name="user_type">  
<?php    

	$query_inf0 = mysql_query("SELECT * FROM usuarios WHERE id = '$_GET[id]'");
     while($info_p0 = mysql_fetch_array($query_inf0)){

echo '<option value="1"'; 
if($info_p0['user_type']== 1) { echo ' selected="selected"'; } echo '>Administrador Global</option>';}

echo '<option value="2"'; 
if($info_p0['user_type']== 2) { echo ' selected="selected"'; } echo '>Administrador</option>';
	
echo '<option value="3"'; 
if($info_p0['user_type']== 3) { echo ' selected="selected"'; } echo '>Vendedor</option>';	
    
?>        
 </select>
        
 <div id="provider_name_text" class="info_box"><p>Seleccione un Proveedor.</p></div></td></tr>
             
            
			<tr align="center"><td><input type="submit" name="save" value="Guardar Modificación"></td></tr>
				
</form>
</div>	
					</tbody>
	</table>


  
    <!-- end .content --> <div class="clear"></div>  
    <div class="clear"></div>  
</div>



<?php
	} elseif($_GET['function']=="delete_user") {
   	$id = $_GET['id'];
    if($id_auth == $id) {
      	echo '<script language=javascript>alert("No puedes Borrarte a ti mismo. Función no Permitida.")</script><script>location="content.php?option=admin&task=usuarios"</script>';

    }  else {

		$query = "DELETE FROM usuarios WHERE id = '$id' ";
		$rs = mysql_query($query);

   echo '<script>location="content.php?option=admin&task=usuarios"</script>';     }


		} else { echo "Función Erronea";  }



		
		

} else {
	
	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}

	?>