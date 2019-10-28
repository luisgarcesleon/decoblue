<?php
include("components/conexion/conexion.php"); 

include("pagination.php"); 


if($_GET['display']=='' OR empty($_GET['display'])) {
  $display = '20';
} else {
  $display = $_GET['display'];
 
}

   if($_POST['search']) {
	   
	 $link = '<a href="content.php?option=admin&task=clientes">Volver al Registro de Clientes</a>';
            $search = "WHERE cedula LIKE '%$_POST[search_ci]%'";}

    $query = new paginar("SELECT * FROM cliente $search ORDER BY cedula ASC");
    $query->mostrar($display);
    $con = $query->procesar_codigo();

  if(mysql_num_rows($con)== 0) {
			echo "<script language=javascript>alert('Cliente no encontrado en el registro')</script>";
			echo '<script>location="content.php?option=admin&task=clientes"</script>';
           
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
			<div class="m">
			<div class="clear-separator"></div>
            
<!-- ---------- Opciones de Clientes ---------- -->   

	<table class="adminlist" cellpadding="1">
		<thead>
		
	  <th class="title">
				Opciones de Clientes
		</th>

		</thead>

        	
		<tbody>

					<tr class="row0">
				<td><a href="content.php?option=admin&task=add_client">Agregar Cliente al registro</a>
				  </td>
                    

			</tr>
            
            		<tr class="row0">
				<td>
               <form action="content.php?option=admin&task=clientes" method="post" name="adminForm2">
				Buscar Cliente por Cedula:
				<input type="text" name="search_ci" id="search_ci" value="" class="text_area"/>
				<input name="search" type="submit" id="search" value="Buscar">
				<input name="reset" type="reset" id="search" value="Restablecer">      <?php echo $link; ?> 
                
                </form>
                
     
				  </td>
                    

			</tr>
	  </tbody>
	</table>   
    

			<div class="clear-separator"></div>
            
<table class="adminlist" cellpadding="1">
		<thead>
		
				<th class="title">
				Clientes Registrados
			</th>

		</thead>
	</table>       


	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>


				<th width="20%" class="title">Nombre</th>
				<th width="20%" class="title" >Cédula</th>
		<th width="20%" class="title">Dirección</th>
				<th width="20%" class="title">Telefono</th>
                <th width="20%" class="title">Opciones</th>
				
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


?>
					<tr class="row0">
				<td align="center">
				 	<?php echo $user['nombre'];?>	</td>

				<td align="center">
                	 	<?php echo $user['cedula'];?>	
				</td>
				<td align="center">
					<?php echo $user['direccion'];?>	
					
				</td>
				<td align="center">
								<?php echo $user['telefono'];?>		</td>

                  <td align="center">
				<a href="content.php?option=admin&task=edit_client&id=<?php echo $user['cedula'];?>">Editar</a> -
                <a onclick="return confirm('¿Esta Seguro que desea Eliminar este Cliente?')" href="content.php?option=admin&task=delete_client&id=<?php echo $user['cedula'];?>">Eliminar	</a></td>

				

			</tr><?php }?>
					</tbody>
	</table>


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

  
  ?>