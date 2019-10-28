<?php

    include("web/block.php");

    $id = $_COOKIE['id'];
    $query = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
    $datos = mysql_fetch_array($query);

    if($datos['user_type'] == '1' OR $datos['user_type'] == '2' OR $datos['user_type'] == '3') {
        echo '<!-- Autorizado -->';                     ?>

<div class="sidebar1"><!-- Columna Derecha de Opciones -->
    <ul class="nav">

<!-- Opción 1: Realizar Venta --><li><a href="content.php?option=admin&task=venta&function=sale">Realizar Venta</a></li>
<!-- Opción 2: Agregar Cliente --><li><a href="content.php?option=admin&task=add_client">Agregar Cliente</a></li>
<?php if($datos['user_type'] == '1' OR $datos['user_type'] == '2') {        ?>
<!-- Opción 3: Agregar Articulo --><li><a href="content.php?option=admin&task=add_art">Agregar Articulo</a></li>
<!-- Opción 4: Agregar Proveedor --><li><a href="content.php?option=admin&task=add_provider">Agregar Proveedor</a></li>
<?php } else { echo '<!-- No Autorizado -->'; }     ?>
<!-- Opción 5: Acerca --><li><a href="content.php?option=admin&task=acercade">Acerca</a></li>

        </ul>
    <aside><p></p><p></p></aside>
</div>

<div class="main"><!-- Columna Principal Central -->
    <article class="content">

    <h1><center>Seleccione una Opción</center></h1>

<section>
    <div class="clear-separator"></div><!-- Separador -->

    <div class="options"><!-- Menu de Opciones -->

    <ul class="options_buttons">
<?php   if($datos['user_type'] == '1' OR $datos['user_type'] == '2') {
        if(get_rows("articulo") == 0) {

echo '<!-- Opción 1: Agregar Articulo --><li><a href="content.php?option=admin&task=add_art">Agregar Articulo</a></li>';
        } else {        ?>
<!-- Opción 1: Inventario --><li><a href="content.php?option=admin&task=inventario">Inventario</a></li><?php } ?>
<!-- Opción 2: Usuarios --><li><a href="content.php?option=admin&task=usuarios">Usuarios</a></li>
<?php   if(get_rows("proovedor") == 0) {
echo '<!-- Opción 3: Agregar Proveedor --><li><a href="content.php?option=admin&task=add_provider">Agregar Proveedor</a></li>';
        } else {        ?>
<!-- Opción 3: Proveedor --><li><a href="content.php?option=admin&task=proveedor">Proveedores</a></li>
<?php   }} else { echo '<!-- No Autorizado -->'; }
        if(get_rows("cliente") == 0) {
echo '<!-- Opción 4: Agregar Cliente --><li><a href="content.php?option=admin&task=add_client">Agregar Cliente</a></li>';
        } else {        ?>
<!-- Opción 4: Clientes --><li><a href="content.php?option=admin&task=clientes">Clientes</a></li>
<?php } if(get_rows("venta") == 0) {
echo '<!-- Opción 5: Realizar Venta --><li><a href="content.php?option=admin&task=venta&function=sale">Realizar Venta</a></li>';
        } else {        ?>
<!-- Opción 5: Registro de Ventas< --><li><a href="content.php?option=admin&task=ventas">Registro de Ventas</a></li><?php } ?>

        </ul>
    </div>
</section>
</article>
    <div class="clear"></div>
    <div class="clear"></div>
</div>
<?php } else { echo '<script>alert("No puedes acceder a esta sección."); location="index.php"</script>';    } ?>