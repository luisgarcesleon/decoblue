<?php
include("components/conexion/conexion.php");
if($_GET['mode']=='truncate_sale') {

		$query = "  TRUNCATE TABLE `venta` ";
		$rs = mysql_query($query);
    echo '<script>location="content.php?option=admin"</script>';


} elseif($_GET['task'] == 'delete_sale'){

		$id = $_GET['id'];
		$query = "DELETE FROM venta WHERE id_compra = '$id' ";
		$rs = mysql_query($query);

                   if(get_rows("venta") == 0) {
	    echo '<script>location="content.php?option=admin"</script>';
        } else {
   echo '<script>location="content.php?option=admin&task=ventas"</script>';    }


} else {

echo "Funcion Erronea";

}
?>