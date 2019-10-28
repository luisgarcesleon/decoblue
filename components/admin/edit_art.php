<?php
include("components/conexion/conexion.php");

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';


if($_GET['function']=="edit" && $_POST['save']) {		
		
		$art_name = $_POST['art_name'];
		$art_price= $_POST['art_price'];
		$art_stock_min = $_POST['art_stock_min'];
		$art_stock_real = $_POST['art_stock_real'];
		$art_desc = $_POST['art_desc'];
		$cod_ref = $_POST['provider'];
		
		$query01 = "UPDATE `".$dbname."`.`articulo` SET
nombre = '$art_name',
precio_venta = '$art_price', 
descri_art = '$art_desc',
stock_real ='$art_stock_real',
stock_min = '$art_stock_min' WHERE cod_art = '$_GET[id]'";
		$rs1 = mysql_query($query01);
		
		$query02= "UPDATE `".$dbname."`.`articulo_proveedor` SET
cod_ref  = '$cod_ref' WHERE cod_art = '$_GET[id]'";

		$rs2 = mysql_query($query02);

 	if($rs1 == true && $rs2 == true) {
			echo "<script language=javascript>alert('Articulo Editado con exito al inventario')</script>";
			echo '<script>location="content.php?option=admin&task=inventario"</script>'; }
		else {
			echo "Ha Ocurrido un Error: Articulo no agregado al inventario"; 
			echo '<script>location="content.php?option=admin&task=inventario"</script>';} 
			
}

    $query2 = mysql_query("SELECT * FROM articulo WHERE cod_art = '$_GET[id]'") ;
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
	<form action="content.php?option=admin&amp;task=edit_art&amp;function=edit&id=<?php echo $_GET['id']?>" method="post" id="edit_art">
	<tr class="row0">
				<td>		<label for="art_name">Ingrese nombre del Articulo: </label><input class="inputbox" type="text" name="art_name" value="<?php echo $values['nombre'];?>"></td></tr>
                
        	<tr class="row0"><td>	        
            <label for="art_price">Ingrese su Precio de Venta (IVA INCLUIDO) en Bsf: </label><input class="inputbox"type="text" name="art_price" value="<?php echo $values['precio_venta'];?>"></td></tr>
            
            
			<tr class="row0"><td><label for="art_stock_min">Cantidad Minima en el Stock: </label><input class="inputbox" type="number" name="art_stock_min"   value="<?php echo $values['stock_min'];?>"></td></tr>
         <tr class="row0"><td>   <label for="art_stock_real">Cantidad Real en el Stock: </label> <input class="inputbox" type="number" name="art_stock_real" value="<?php echo $values['stock_real'];?>"></td></tr>
			<tr class="row0"><td> <label for="art_desc">Ingrese una descripción del Producto: </label> <textarea class="inputbox" name="art_desc" cols="50" rows="1"><?php echo $values['descri_art'];?></textarea></td></tr>

 		<tr class="row0"><td> <label for="provider_name">Proveedor del Producto: </label> <select name="provider">   <option value=""></option>
<?php    

	$query_inf0 = mysql_query("SELECT * FROM articulo_proveedor WHERE cod_art= '$_GET[id]'");
     $info_p0 = mysql_fetch_array($query_inf0);
	 
	 if($info_p0['cod_art']==$values['cod_art']) {
		 $select = 'selected="selected"';
		 } else {  $select = '';
			 }
		 
	$query_inf = mysql_query("SELECT * FROM proovedor ORDER BY cod_ref");
     while($info_p = mysql_fetch_array($query_inf)){
   
	
    
?>        
        
          <option value="<?php echo $info_p['cod_ref']; ?>" <?php echo $select;?>> <?php echo $info_p['nombre']; ?></option>
        
        
        <?php } ?> </select>
        
 <div id="provider_name_text" class="info_box"><p>Seleccione un Proveedor.</p></div></td></tr>
             
            
			<tr align="center"><td><input type="submit" name="save" value="Guardar Modificación"></td></tr>
				
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
