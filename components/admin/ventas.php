<?php
// Este Script muestra el Registro de Ventas realizadas.

    // Archivo que divide los resultados SQL en Paginas
    include("pagination.php");

    if(isset($_COOKIE['id'])) { $id_auth = $_COOKIE['id']; } else { $id_auth = ''; }

  	$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
	$auth_data = mysql_fetch_array($auth);

	if($auth_data['user_type'] == '1' OR $auth_data['user_type'] == '2' OR $auth_data['user_type'] == '3' ) {
	    echo '<!-- Autorizado -->';

    if(isset($_POST['search'])) { $search = $_POST['submit']; } else { $search = ''; }

    if($search) {

    $link = '<a href="content.php?option=admin&amp;task=ventas">Volver al Registro de Ventas</a>';
    $search = "WHERE id_compra LIKE '%$_POST[search_text]%' OR cliente_ci LIKE '%$_POST[search_text]%'";}

    global $link;

    $query = new paginar("SELECT * FROM venta $search ORDER BY fecha ASC");
    $query->mostrar('20');
    $con = $query->procesar_codigo();
	
    if(mysql_num_rows($con) == 0) {
	    echo '<script>alert("No encontrado en el registro"); location="content.php?option=admin&task=ventas"</script>';
            } else {
?>
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

    <div class="complete_main"><!-- Contenedor -->
    <div class="clear-separator"></div><!-- Separador -->

     <!-- Formulario --><form id="search_client" name="search_client" action="content.php?option=admin&amp;task=ventas" method="POST" enctype="multipart/form-data">

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Opciones de Ventas</th></tr><!-- Opciones de Ventas -->
        </thead>

<tbody><!-- Cuerpo de la Tabla -->

    <tr class="row0"><td style="text-align: left"><a href="content.php?option=admin&amp;task=venta&amp;function=sale" title="Realizar Venta">Realizar Venta</a></td></tr>

    <!-- Buscar Cliente --><tr class="row0"><td><label for="name_reg"><strong>Buscar Compra de Cliente por Cedula o Id de Compra:</strong></label>
    <input name="search_text" id="search_text" class="text_area" type="text">
    <!-- Botón Buscar --><input name="search" type="submit" id="search" value="Buscar">
    <!-- Botón Restrablecer --><input name="reset" type="reset" id="search" value="Restablecer">
    <!-- Link Volver --><?php echo $link; ?>
    </td></tr>

    <tr class="row0"><td align="right"><!-- Opciones -->
    <!-- Exportar Registros del Mes --><a href="components/admin/register.php?mode=export_registry&limit=month" target="_blank">Exportar Registros del Mes</a> -
    <!-- Exportar Registros del Dia --><a href="components/admin/register.php?mode=export_registry&limit=day" target="_blank">Exportar Registros del Dia</a> -
    <!-- Borrar Registros de Venta --><a href="content.php?option=admin&amp;task=delete_sale&mode=truncate_sale" onclick="return confirm('¿Esta Seguro que desea Borrar los Registros de Venta por completo? Una vez que haga Click en Aceptar no podrá deshacer esta acción')">Borrar Registros de Venta</a>
    </td></tr>

        </tbody>
    </table>
</form>

    <div class="clear-separator"></div><!-- Separador -->

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr><th class="title">Ventas Registradas</th></tr><!-- Titulo -->
        </thead>
    </table>

    <table class="adminlist" cellpadding="1">
	    <thead>
            <tr>
    <th width="8%" class="title">Cod.</th>
    <th width="10%" class="title">Cédula</th>
	<th width="10%" class="title">Cantidad</th>
	<th width="10%" class="title">Precio</th>
    <th width="8%" class="title">Pago</th>
    <th width="8%" class="title">Total</th>
    <th width="11%" class="title">ID</th>
    <th width="21%" class="title">Fecha</th>
    <th width="14%" class="title">Opciones</th>
            </tr>
	    </thead>

        <tfoot>
			<tr><td colspan="9"><del class="container"><?php $query->crear_paginas()?></del></td></tr>
		</tfoot>

    <tbody>

    <?php while($user = mysql_fetch_array($con)){    ?>

    <tr class="row0"><td align="center"><?php echo $user['cod_art'];?></td><!-- Codigo de Articulo -->
                    <td align="center"><?php echo $user['cliente_ci'];?></td><!-- C.I. del Cliente -->
				    <td align="center"><?php echo $user['cantidad'];?></td><!-- Cantidad de Articulos -->
	                <td align="center"><?php echo $user['precio'];?></td><!-- Precio Unitario -->
                    <td align="center"><?php echo $user['tipo_pago'];?></td><!-- Tipo de Pago -->
                    <td align="center"><?php echo $user['total'];?></td><!-- Total de la Compra -->
                    <td align="center"><?php echo $user['id_compra'];?></td><!-- Codigo de Compra -->
                    <td align="center"><?php echo $user['fecha'];?></td><!-- Fecha de Compra -->

                    <td align="center"><!-- Opciones -->
                        <a href="javascript:abrir2('components/admin/register.php?mode=sale&purchase_id=<?php echo $user['id_compra'];?>&client=<?php echo $user['cliente_ci'];?>','700','700')" title="Imprimir">Imprimir</a> -
                         <a onclick="return confirm('¿Esta Seguro que desea Eliminar esta Venta?')"  href="content.php?option=admin&amp;task=delete_sale&id=<?php echo $user['id_compra'];?>">Eliminar</a>
                    </td>
    </tr>
        <?php }?>
    </tbody>
</table>

    <noscript>¡Advertencia! JavaScript debe estar habilitado para un correcto funcionamiento del Sistema</noscript>
</div>
<?php }} ?>