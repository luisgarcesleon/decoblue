<?php
include("components/conexion/conexion.php"); 

include("pagination.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';

	
	$art_id = $_GET['art_id'];
	$id = $_GET['id'];

  	$query = mysql_query("SELECT * FROM articulo WHERE cod_art = '$art_id'");
	$data = mysql_fetch_array($query);
	
	$query2 = mysql_query("SELECT * FROM articulo_proveedor WHERE cod_art = '$art_id'");
	$data2 = mysql_fetch_array($query2);
	
	$cod_ref = $data2['cod_ref'];
	
	$query3 = mysql_query("SELECT * FROM proovedor WHERE cod_ref = '$cod_ref'");
	$data3 = mysql_fetch_array($query3);
	
	
	
	if($_GET['display']=='' OR empty($_GET['display'])) {
  $display = '20';
} else {
  $display = $_GET['display'];
 
}


    $query = new paginar("SELECT * FROM venta WHERE cod_art = '$id' ORDER BY fecha ASC");
    $query->mostrar($display);
    $con = $query->procesar_codigo();
	

	if($_GET['function']=="view") {


  ?>
  
  <div class="clear-separator"></div>
    
    

	<div id="content-box">
		<div class="border">
			<div class="padding">

				<div id="toolbar-box">
   			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>

   		<div class="clr"></div>


		<div id="element-box">
			<div class="t">

		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>
			<div class="m">
            
	<div class="clear-separator"></div>
    
<!-- ---------- Opciones de Inventario ---------- -->   

	<table class="adminlist" cellpadding="1">
		<thead>
		
	  <th class="title">
				Opciones de Inventario
		</th>

		</thead>

        	
		<tbody>

					<tr class="row0">
				<td><a href="content.php?option=admin&task=add_art">Ingresar Nuevo Producto en el inventario</a>
				  </td>
                    

			</tr>
            
            		<tr class="row0">
				<td>
               <form action="content.php?option=admin&task=inventario" method="post" name="adminForm2">
				Buscar Articulo por Codigo:
				<input type="text" name="search_art" id="search_art" value="" class="text_area"/>
				<input name="search" type="submit" id="search" value="Buscar">
				<input name="reset" type="reset" id="search" value="Restablecer">    
                
                </form>
                
     
				  </td>
                    

			</tr>
	  </tbody>
	</table>   
    
	<div class="clear-separator"></div>
    
<table class="adminlist" cellpadding="1">
		<thead>
		
  <th class="title">
				Articulo
	</th>

		</thead>
	</table>           


	<table class="adminlist" cellpadding="1">
	



		<tbody>
       <th colspan="7" align="left">Articulo: <?php echo $data['nombre'];?>| Codigo: <?php echo $data['cod_art'];?></th>

					<tr class="row0">
				<td>
				  	Precio: <?php echo $data['precio_venta'];?>&nbsp;&nbsp;&nbsp;</td>


				<td>
			 	Stock Minimo: <?php echo $data['stock_min'];?>
				</td>
				<td>
				Stock Real: <?php echo $data['stock_real'];?>	</td></tr>

				<tr class="row0"><th colspan="7" align="left"><strong>Descripción:</strong></br>
				
				<?php echo $data['descri_art'];?>	</th></tr>
                
 <tr class="row0"><th colspan="7" align="left"><strong>Proveedor:</strong></br>
 	<?php echo $data3['nombre'];?> | <?php echo $data3['rifp'];?> | Telefono de Contacto: <?php echo $data3['telefono'];?></br>
    Dirección: <?php echo $data3['direccion'];?> 
                </th>
                    </tr>

 <tr class="row0"><th colspan="7" align="left"><strong>Opciones:</strong></br>
				<a href="content.php?option=admin&task=edit_art&id=<?php echo $data['cod_art'];?>">Editar</a> | <a href="content.php?option=admin&task=delete_art&id=<?php echo $data['cod_art'];?>">Borrar	</a> | <a href="content.php?option=admin&task=articulo&function=sales_register&id=<?php echo $data['cod_art'];?>">Registro de Ventas</a>
                </th>
                    </tr>

					</tbody>
	</table>
	<div class="clear-separator"></div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>

		<noscript>
			¡Advertencia! JavaScript debe estar habilitado para un correcto funcionamiento de la Administración		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<?php } 

	if($_GET['function']=="sales_register") {	?>

  <div class="clear-separator"></div>
    
    

	<div id="content-box">
		<div class="border">
			<div class="padding">

				<div id="toolbar-box">
   			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>

   		<div class="clr"></div>


		<div id="element-box">
			<div class="t">

		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>
			<div class="m">
            
	<div class="clear-separator"></div>
    
<!-- ---------- Opciones de Inventario ---------- -->   

	<table class="adminlist" cellpadding="1">
		<thead>
		
	  <th class="title">
				Opciones de Inventario
		</th>

		</thead>

        	
		<tbody>

					<tr class="row0">
				<td><a href="content.php?option=admin&task=add_art">Ingresar Nuevo Producto en el inventario</a>
				  </td>
                    

			</tr>
            
            		<tr class="row0">
				<td>
               <form action="content.php?option=admin&task=inventario" method="post" name="adminForm2">
				Buscar Articulo por Codigo:
				<input type="text" name="search_art" id="search_art" value="" class="text_area"/>
				<input name="search" type="submit" id="search" value="Buscar">
				<input name="reset" type="reset" id="search" value="Restablecer">    
                
                </form>
                
     
				  </td>
                    

			</tr>
	  </tbody>
	</table>   
    
	<div class="clear-separator"></div>
    
<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
  <th colspan="9" class="title">
				Registro de Venta
	</th></tr>

		</thead>
        	<tfoot>
			<tr>
				<td colspan="10">
					<del class="container"><?php $query->crear_paginas()?></del>				</td>
			</tr>
		</tfoot>



		<tbody>
       <th colspan="8" align="left">Articulo: <?php echo $data['nombre'];?>| Codigo: <?php echo $data['cod_art'];?> | Precio: <?php echo $data['precio_venta'];?> | Stock Minimo: <?php echo $data['stock_min'];?> | Stock Real: <?php echo $data['stock_real'];?></th>

		

			<tr class="row1">
	
		
				<th width="15%"class="title">
					Nombre</a>				</th>
				<th width="10%" class="title" >
				C.I.				</th>
                
                		<th width="10%" class="title" >
			Telefono				</th>
                
				<th width="10%" class="title" nowrap="nowrap">

					Cantidad				</th>
	<th width="10%" class="title" nowrap="nowrap">

				Tipo de Pago			</th>
	<th width="20" class="title" nowrap="nowrap">

				Fecha		</th>
                
                           <th width="15%" class="title" nowrap="nowrap">

			Total	</th>
                <th width="15%" class="title" nowrap="nowrap">

			ID Compra	</th>
			
			
			</tr>



<?php 



while($user = mysql_fetch_array($con)){
	$query4 = mysql_query("SELECT * FROM cliente WHERE cedula = '$user[cliente_ci]'");
	$data4 = mysql_fetch_array($query4);
	

?>

	<tr class="row0">
				<td><?php echo $data4['nombre'];?>	
				  				</td>


				<td>
			<?php echo $user['cliente_ci'];?>	
				</td>
				<td><?php echo $data4['telefono'];?>	
					 	</td>

				<td align="center">

<?php echo $user['cantidad'];?>	</td>

	<td align="center">

<?php echo $user['tipo_pago'];?></td>
				<td nowrap="nowrap">
					<?php echo $user['fecha'];?>
                    </td>
				<td>
							<?php echo $user['total'];?>	</td>
                    <td><?php echo $user['id_compra'];?>
	</td>
                    

			</tr>

<?php 
} 
?> 
	

					</tbody>
	</table>
	<div class="clear-separator"></div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>

		<noscript>
			¡Advertencia! JavaScript debe estar habilitado para un correcto funcionamiento de la Administración		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<?php 
}
} else {
	
	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}
?>