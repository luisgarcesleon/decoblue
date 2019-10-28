
<?php

include("components/conexion/conexion.php"); 

include("pagination.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';



if($_GET['display']=='' OR empty($_GET['display'])) {
  $display = '20';
} else {
  $display = $_GET['display'];
 
}

   if($_POST['search']) {
	   
	 $link = '<a href="content.php?option=admin&task=inventario">Volver a la Lista Completa de Articulos</a>';
            $search = "WHERE cod_art LIKE '%$_POST[search_art]%' OR nombre LIKE '%$_POST[search_art]%'";}

    $query = new paginar("SELECT * FROM articulo $search ORDER BY cod_art ASC");
    $query->mostrar($display);
    $con = $query->procesar_codigo();

        if(mysql_num_rows($con)== 0) {
			echo "<script language=javascript>alert('Articulo no Encontrado en el Inventario')</script>";
			echo '<script>location="content.php?option=admin&task=inventario"</script>';
           
 } else { 

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
				<input name="reset" type="reset" id="search" value="Restablecer">      <?php echo $link; ?> 
                
                </form>
                
     
				  </td>
                    

			</tr>
	  </tbody>
	</table>   
    
<!-- ---------- Alertas ---------- -->     
	<div class="clear-separator"></div>
<table class="adminlist" cellpadding="1">
		<thead>

	  <th class="title">
				Alertas
		</th>

		</thead>


		<tbody>
<?php
	    $query_alert = mysql_query("SELECT * FROM articulo");
		while($data = mysql_fetch_array($query_alert)){
			
	$s = 10;

if($data['stock_real'] <= $data['stock_min'] && $data['stock_real'] > 0) {
 $style = "row3";
 echo'
 	<tr class="'.$style.'">
				<td><a href="">'.$data['nombre'].' <strong>(Código:  '.$data['cod_art'].')</strong>. Quedan Cantidades Minimas del Articulo. Contacte a su Proveedor. </br>+Mas información.</a>
				  </td>
                  </tr>';

} elseif($data['stock_real'] <= ($s+$data['stock_min']) && $data['stock_real'] > $data['stock_min'] ) {
	 $style = "row5";
	 
 echo'
 	<tr class="'.$style.'">
				<td><a href="">'.$data['nombre'].' <strong>(Código:  '.$data['cod_art'].')</strong> esta llegando a su limite mínimo. Contacte a su Proveedor para surtir este producto. </br>+Mas información.</a>
				  </td>
                  </tr>';
} elseif($data['stock_real'] == 0) {
 $style = "row4";
 
  echo'
 	<tr class="'.$style.'">
				<td><a href="">'.$data['nombre'].' <strong>(Código:  '.$data['cod_art'].')</strong> esta Completamente Agotado. Contacte a su Proveedor para surtir este producto. </br>+Mas información.</a>
				  </td>
                  </tr>';
} 
 } ?>
	  </tbody>
	</table>
    
        
	<div class="clear-separator"></div>
    
<table class="adminlist" cellpadding="1">
		<thead>
		
  <th class="title">
				Inventario
	</th>

		</thead>
	</table>           


	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
				<th width="2%" class="title">
					#				</th>
		
				<th class="title">
					<a href="javascript:tableOrdering('a.name','desc','');" title="Haz click para ordenar por esta columna">Nombre<img src="/joomla/administrator/images/sort_asc.png" alt=""  /></a>				</th>
				<th width="15%" class="title" >
					<a href="javascript:tableOrdering('a.username','desc','');" title="Haz click para ordenar por esta columna">Precio de venta (BsF.)</a>				</th>
				<th width="5%" class="title" nowrap="nowrap">

					Descripción				</th>
				<th width="5%" class="title" nowrap="nowrap">
					<a href="javascript:tableOrdering('a.block','desc','');" title="Haz click para ordenar por esta columna">Stock Real</a>				</th>
				<th width="15%" class="title">
					<a href="javascript:tableOrdering('groupname','desc','');" title="Haz click para ordenar por esta columna">Stock Minimo</a>				</th>
				<th width="26%" class="title">Opciones</th>
			</tr>


		</thead>

        	<tfoot>
			<tr>
				<td colspan="10">
					<del class="container"><?php $query->crear_paginas()?></del>				</td>
			</tr>
		</tfoot>

		<tbody>
<?php
while($user = mysql_fetch_array($con)){
	
	$s = 10;

if($user['stock_real'] <= $user['stock_min'] && $user['stock_real'] > 0) {
 $style = "row3";
 echo'	<th colspan="7" bgcolor="#F75037" style="color: #000000" align="center">Solo quedan Cantidades Minimas de este Articulo en el Stock</th>';
} elseif($user['stock_real'] <= ($s+$user['stock_min']) && $user['stock_real'] > $user['stock_min'] ) {
	 $style = "row5";
 echo'	<th colspan="7" bgcolor="#FFE1E1" style="color: #000000" align="center">Contacte a su Proveedor para surtir el Stock de este producto</th>';
} elseif($user['stock_real'] == 0) {
 $style = "row4";
  echo'	<th colspan="7" bgcolor="#333333" style=" color: rgb(255,255,255)" align="center">Este Articulo esta Completamente Agotado</th>';
} else {  
	 $style = "row0";
}
?>
					<tr class="<?php echo $style;?>">
				<td>
				  	<?php echo $user['cod_art'];?>			</td>


				<td>
					<a href="content.php?option=admin&task=articulo&function=view&art_id=<?php echo $user['cod_art'];?>	">
						<?php echo $user['nombre'];?></a>
				</td>
				<td>
					 <?php echo $user['precio_venta'];?>		</td>

				<td align="center">

	<?php echo $user['descri_art'];?>	</td>


				<td nowrap="nowrap">
				<?php echo $user['stock_real'];?>
                    </td>
				<td>
					<?php echo $user['stock_min'];?>				</td>
                                        <td align="center">
				<a href="content.php?option=admin&task=edit_art&id=<?php echo $user['cod_art'];?>">Editar</a> -
                <a onclick="return confirm('¿Esta Seguro que desea Eliminar este Articulo?')" href="content.php?option=admin&task=delete_art&id=<?php echo $user['cod_art'];?>">Eliminar	</a></td>
                    

			</tr><?php }?>
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
  
  	}}

  
  ?>