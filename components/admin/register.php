<?php
	include("../../components/conexion/conexion.php");
    date_default_timezone_set('America/Caracas');

    $cl = $_GET['client'];
    $query_info = mysql_query("SELECT * FROM cliente WHERE cedula = '$cl'");
    $info = mysql_fetch_array($query_info);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factura</title>
     <link rel="stylesheet" type="text/css" href="../../media/css/css-print_style2.css" />
     <link rel="stylesheet" type="text/css" href="../../media/css/css-print_style.css" media="print" />

    <meta name="OBGZip" content="true" />
        <!--[if IE 6]>
    <style type="text/css">
    /* <![CDATA[ */
    html {
        overflow-y: scroll;
    }
    /* ]]> */
    </style>
    <![endif]-->
</head>

<body>

<div>


<table style="width: 100%;">
		<thead>
        			<tr>
		
		
				<th align="left">

		Floristeria DecoBlue


            </th>
	</tr>
<tr>
				<th align="left">

		Cliente: <?php echo $info['nombre'];?> | Cedula:  <?php echo $info['cedula'];?>


            </th></tr>
            	<tr>
				<th align="left">

		Telefono: <?php echo $info['telefono'];?> | Dirección: <?php echo $info['direccion'];?>

</th></tr>

			<tr>
		
		
				<th>

		Factura
        

            </th>
	</tr>

		</thead>
     
     
  </table>

<p>&nbsp;</p>

  <table style="width: 100%;">
<thead>
<tr>
    <th>Articulo (Codigo)</th>
    <th>ID No.</th>

    <th>Cantidad</th>
    <th>Precio (por unidad)</th>

    <th>Sub-Total</th>
</tr>
</thead>
  <tbody>
<?php

if($_GET['mode'] == 'export_registry') {

if($_GET['limit'] == 'month') {

	$date1 = date("Y-m-d H:i:s");
    $m1 = date("m")-1;
	$date2 = date("Y-".$m1."-31 H:i:s");

    $query_sale = mysql_query("SELECT * FROM venta WHERE fecha<$date1");

  echo $date1.'<br>';
  echo $date2;

  while($display = mysql_fetch_array($query_sale)) {
      	$cod = $display['cod_art'];

	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);
        echo '
	<tr><td>
       '.$display2['nombre'].' ('.$cod.')
    </td>
    <td>'.$display['id_compra'].'<bdo dir="ltr"></bdo></td>

    <td>'.$display['cantidad'].'&nbsp;</td>
    <td>'.$display['precio'].'&nbsp;</td>

        <td>'.$display['total'].'</td>
</tr> ';

        $cantidad = $cantidad+$display['cantidad'];
      $total = $total+$display['total'];

}} elseif($_GET['limit'] == 'day') {

	$date1 = date("Y-m-d 00:00:00");
    $d1 = date("d")-1;
	$date2 = date("Y-m-".$d1." 00:00:00");
  echo $date1.'<br>';
  echo $date2;
    $query_sale = mysql_query("SELECT * FROM venta WHERE fecha LIKE '%$date1%'");



  while($display = mysql_fetch_array($query_sale)) {
      	$cod = $display['cod_art'];

	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);
        echo '
	<tr><td>
       '.$display2['nombre'].' ('.$cod.')
    </td>
    <td>'.$display['id_compra'].'<bdo dir="ltr"></bdo></td>

    <td>'.$display['cantidad'].'&nbsp;</td>
    <td>'.$display['precio'].'&nbsp;</td>

        <td>'.$display['total'].'</td>
</tr> ';

        $cantidad = $cantidad+$display['cantidad'];
      $total = $total+$display['total'];

  }
}
}
 elseif($_GET['mode'] == 'sale') {

    $query_sale = mysql_query("SELECT * FROM venta WHERE id_compra = '$_GET[purchase_id] '");
    $display = mysql_fetch_array($query_sale);

	$cod = $display['cod_art'];

	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);

    echo '
	<tr><td>
       '.$display2['nombre'].' ('.$cod.')
    </td>
    <td>'.$display['id_compra'].'<bdo dir="ltr"></bdo></td>

    <td>'.$display['cantidad'].'&nbsp;</td>
    <td>'.$display['precio'].'&nbsp;</td>

        <td>'.$display['total'].'</td>
</tr> ';

        $cantidad = $cantidad+$display['cantidad'];
      $total = $total+$display['total'];

} else {

	$d = $_GET['purchase_no'];
      $cantidad = 0;
      $total= 0;
for ($i = 1; $i <= $d; $i++) {

	$c_name = "purchase_id".$i;

	$ps_id = $_COOKIE[$c_name];

    $query_sale = mysql_query("SELECT * FROM venta WHERE id_compra = '$ps_id'");
    $display = mysql_fetch_array($query_sale);
	
	$cod = $display['cod_art'];

	$name_art = mysql_query("SELECT * FROM articulo WHERE cod_art='$cod'");
    $display2 = mysql_fetch_array($name_art);
	 
	 echo '
	<tr><td>
       '.$display2['nombre'].' ('.$cod.')
    </td>
    <td>'.$display['id_compra'].'<bdo dir="ltr"></bdo></td>

    <td>'.$display['cantidad'].'&nbsp;</td>
    <td>'.$display['precio'].'&nbsp;</td>

        <td>'.$display['total'].'</td>
</tr> ';

        $cantidad = $cantidad+$display['cantidad'];
      $total = $total+$display['total'];


}
}

echo '			<tr>
		    <th></th>
    <th></th>

    <th>'.$cantidad.'</th>
    <th></th>
 
    <th>
	Total: '.$total.'
        

            </th>
	</tr>
';
  		
            
 ?>           
 </tbody> </table></div>	
<script type="text/javascript" language="javascript">
//<![CDATA[
function printPage()
{
    // Do print the page
    if (typeof(window.print) != 'undefined') {
        window.print();
    }
}
//]]>
</script>

<p class="print_ignore">
    <input type="button" id="print" value="Imprimir"
        onclick="printPage()" /></p>

</body>
</html>