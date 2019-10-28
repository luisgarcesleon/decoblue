<?php
// Este Script muestra información de los usuarios registrados en el sistema.

    // Archivo que divide los resultados SQL en Paginas
    include("pagination.php");

    if(isset($_COOKIE['id'])) { $id_auth = $_COOKIE['id']; } else { $id_auth = ''; }

  	$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
	$auth_data = mysql_fetch_array($auth);

	if($auth_data['user_type'] == '1') {
	    echo '<!-- Autorizado -->';

    $pagination = new paginar("SELECT * FROM usuarios ORDER BY 'id' ASC") ;
    $pagination->mostrar('10'); // Numero de Resultados a Mostrar
    $us_con = $pagination->procesar_codigo();   ?>

    <div class="clear-separator"></div><!-- Separador -->


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

<table class="adminlist" cellpadding="1">
		<thead>
		
				<th class="title">
				Usuarios Registrados
			</th>

		</thead>
	</table>       


	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
	
					<th width="20%" class="title" >
					Nombre</th>
				<th width="20%" class="title" >
					Usuario		</th>
		
				
				<th width="15%" class="title">
					Tipo				</th>
				<th width="15%" class="title">

					E-mail			</th>
				<th width="10%" class="title">
					Última Conexion		</th>
				<th width="5%" class="title" >
					ID				</th>
                    
                    		<th width="15%" class="title">
				Opciones			</th>
			</tr>

		</thead>

        	<tfoot>
			<tr>
				<td colspan="10">
					<del class="container"><?php $pagination->crear_paginas()?></del>				</td>
			</tr>
		</tfoot>

		<tbody>
<?php
    while($user = mysql_fetch_array($us_con)){


?>
					<tr class="row0">
			
				<td>
					<a href="">
						<?php echo $user['nombre'];?></a>
				</td>
				<td>
						<?php echo $user['username'];?>				</td>



				
				<td>
				   	<?php
              $type = $user['user_type'];

              if($type=='1') { echo 'Administrador Global';}
              if($type=='2') { echo 'Administrador';}
              if($type=='3') { echo 'Vendedor';}
                    ?>		</td>

				<td>
					<a href="mailto:<?php echo $user['email'];?>">
						<?php echo $user['email'];?></a>
				</td>
				<td nowrap="nowrap">
					<?php echo $user['online_last'];?>
                    </td>
		<td align="center">
					<?php echo $user['id'];?>				</td>
          <?php if($id_auth == $user['id']) { echo '<td align="center">Sin opciones</td></tr>'; } else {?>
                                     <td align="center">
				<a href="content.php?option=admin&task=user_options&function=change_type&id=<?php echo $user['id'];?>">Editar Tipo</a> -
                <a onclick="return confirm('¿Esta Seguro que desea Eliminar este Usuario?')" href="content.php?option=admin&task=user_options&function=delete_user&id=<?php echo $user['id'];?>">Eliminar</a></td>
			</tr><?php }}?>
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

<?php } else {
	
	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}
	?>