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
		

		$cod_art = $_POST['cod_art']; 
		$art_name = $_POST['art_name'];
		$art_price= $_POST['art_price'];
		$art_stock_min = $_POST['art_stock_min'];
		$art_stock_real = $_POST['art_stock_real'];
		$art_desc = $_POST['art_desc'];
			$cod_ref = $_POST['provider'];
			
		$query = "INSERT INTO `".$dbname."`.`articulo` (
`cod_art` ,		
`nombre` ,
`precio_venta` ,
`descri_art` ,
`stock_real` ,
`stock_min`
) VALUES 
('$cod_art','$art_name','$art_price','$art_desc','$art_stock_real','$art_stock_min')";
		
		$rs = mysql_query($query);
				$query2 = "INSERT INTO `".$dbname."`.`articulo_proveedor` (
`cant_sum` ,		
`precio` ,
`cod_art` ,
`cod_ref`
) VALUES 
('$art_stock_real','$art_price','$cod_art','$cod_ref')";
		
		$rs2 = mysql_query($query2);
		
		
 	if($rs == true) {
			echo "<script language=javascript>alert('Articulo agregado con exito al inventario')</script>";
			echo '<script>location="content.php?option=admin&task=inventario"</script>'; }
		else {
			echo "Ha Ocurrido un Error: Articulo no agregado al inventario"; 
			echo '<script>location="content.php?option=admin&task=inventario"</script>';} 
			
}



?>
<script type="text/javascript" src="web/common.js"></script>
<div class="complete_main">



    
    <table class="adminlist" cellpadding="1">
		<thead>
			<tr>
		
		
				<th class="title">
  

Agregar articulo al inventario
</th>
	</tr>

		</thead>

<tbody>

				  		
                        <div class="form">
	<form action="content.php?option=admin&amp;task=add_art&amp;function=add" method="post" id="add_art">
	<tr class="row0">
				<td>		<label for="cod_art">Codigo del Articulo: </label><input class="inputbox" type="text" name="cod_art" id="cod_art" onfocus="showHelp(this);" onblur="hideHelp(this);"> <input name="Submit" type="button" value="Buscar Articulo" onClick="abrir('components/admin/search.php?function=art','250','700')" />
                <div id="cod_art_text" class="info_box"><p>Ingrese Codigo del Articulo que deseas añadir al Inventario, pero antes verifique que este codigo no haya sido ingresado antes en el sistema con la herramienta "Buscar".</p></div></td></tr> 
                  
	<tr class="row0"><td>		
    <label for="art_name">Nombre del Articulo: </label><input class="inputbox"  type="text" name="art_name" id="art_name" onfocus="showHelp(this);" onblur="hideHelp(this);"> 
<div id="art_name_text" class="info_box"><p>Ingrese el Nombre del Articulo que deseas añadir al Inventario.</p></div></td></tr>
                
        	<tr class="row0"><td>	        
            <label for="art_price">Precio de Venta (Con IVA). Bsf: </label><input class="inputbox" type="text" name="art_price" id="art_price" onfocus="showHelp(this);" onblur="hideHelp(this);">
<div id="art_price_text" class="info_box"><p>Ingrese el Precio de Venta con IVA incluido en Bolivares Fuertes.</p></div></td></tr>
            
            
<tr class="row0"><td>
<label for="art_stock_min">Cantidad Minima en el Stock: </label><input class="inputbox" type="number" name="art_stock_min" id="art_stock_min" onfocus="showHelp(this);" onblur="hideHelp(this);">
<div id="art_stock_min_text" class="info_box"><p>Limite mínimo de Unidades de este articulo que pueden haber en el Stock.</p></div></td></tr>

         <tr class="row0"><td>   
   <label for="art_stock_real">Cantidad Real en el Stock: </label> <input class="inputbox" type="number" name="art_stock_real" id="art_stock_real" onfocus="showHelp(this);" onblur="hideHelp(this);">
<div id="art_stock_real_text" class="info_box"><p>Cantidad de Unidades existentes de este articulo en el Stock.</p></div></td></tr>

			<tr class="row0"><td> <label for="art_desc">Descripción del Producto: </label> <textarea class="inputbox" id="art_desc" name="art_desc" cols="50" rows="1" onfocus="showHelp(this);" onblur="hideHelp(this);"></textarea>
 <div id="art_desc_text" class="info_box"><p>Ingrese una Descripción detallada del articulo y sus caracteristicas.</p></div></td></tr>
 
 		<tr class="row0"><td> <label for="provider_name">Proveedor del Producto: </label> <select name="provider">   <option value=""></option>
<?php    
	$query_inf = mysql_query("SELECT * FROM proovedor ORDER BY cod_ref");
     while($info_p = mysql_fetch_array($query_inf)){
   
	
    
?>        
        
          <option value="<?php echo $info_p['cod_ref']; ?>"> <?php echo $info_p['nombre']; ?></option>
        
        
        <?php } ?> </select>
        
 <div id="provider_name_text" class="info_box"><p>Seleccione un Proveedor.</p></div></td></tr>
 
			<tr align="center"><td><input type="submit" name="save" value="Guardar Articulo"></td></tr>
				
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
