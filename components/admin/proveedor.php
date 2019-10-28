<?php

include("pagination.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);

	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';

if(isset($_POST['search'])) { $search1 = $_POST['search']; } else { $search1 = ''; }
   if($search1) {

	 $link = '<a href="content.php?option=admin&task=proveedor">Volver al Registro de Proveedores</a>';
     $search = "WHERE cod_ref LIKE '%$_POST[search_text]%' OR rifp LIKE '%$_POST[search_text]%'";

 }
         global $link, $search;
    $query = new paginar("SELECT * FROM proovedor $search ORDER BY cod_ref ASC");
    $query->mostrar('20');
    $con = $query->procesar_codigo();

 if(mysql_num_rows($con)== 0) {
			echo "<script language=javascript>alert('No encontrado en el registro')</script>";
			echo '<script>location="content.php?option=admin&task=proveedor"</script>';
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
				Opciones
		</th>

		</thead>

        	
		<tbody>

					<tr class="row0">
				<td><a href="content.php?option=admin&task=add_provider">Añadir Proveedor</a>
				  </td>
                    

			</tr>
            
            		<tr class="row0">
				<td>
               <form action="content.php?option=admin&task=proveedor" method="post" name="adminForm2">
				Buscar Proveedor por Nombre o RIF:
				<input type="text" name="search_text" id="search_text" value="" class="text_area"/>
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
				Proveedores Registrados
			</th>

		</thead>
	</table>       
<form action="" method="post" name="">

	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
				<th width="10%" class="title">Cod .Ref</th>
				<th width="20%" class="title" >Nombre</th>
				<th width="15%" class="title">RIF</th>
				<th width="20%" class="title">Direccion</th>
                <th width="15%" class="title">Telefono</th>
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
				 	<?php echo $user['cod_ref'];?>	</td>

				<td align="center">
                	 	<?php echo $user['nombre'];?>	
				</td>
				<td align="center">
					<?php echo $user['rifp'];?>	
					
				</td>
				<td align="center">
								<?php echo $user['direccion'];?>		</td>

                  <td align="center">
				<?php echo $user['telefono'];?></td>
                    <td align="center">
						<a href="content.php?option=admin&task=edit_provider&id=<?php echo $user['cod_ref'];?>">Editar</a> -
                        <a onclick="return confirm('¿Esta Seguro que desea Eliminar este Proveedor?')" href="content.php?option=admin&task=delete_provider&id=<?php echo $user['cod_ref'];?>">Eliminar	</a></td>

			</tr><?php }?>
					</tbody>
	</table>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="a.name" />
	<input type="hidden" name="filter_order_Dir" value="" />

	<input type="hidden" name="f72492c1afa0e657aaaacd83668dde03" value="1" /></form>
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