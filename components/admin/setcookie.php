<?php

	$purchase_code = $_GET['purchase_id'];
	$c =  $_GET['purchase_no'];
	   $client2 = $_GET['client'];
	   
	$p_id = "purchase_id".$c;

	setcookie($p_id,$purchase_code,time()+90000,"/decoblue/", "localhost");

if($_GET['mode_false']=='on') {
	
		Header('location: .././../content.php?option=admin&task=venta&purchase_id='.$purchase_code.'&client='.$client2.'&purchase_no='.$c.'&display=register');
	} else {

	Header('location: .././../content.php?option=admin&task=venta&function=sale&purchase_id='.$purchase_code.'&client='.$client2.'&purchase_no='.$c.'');

	}
if($_GET['new_sale']=='on') {
	$d = $_GET['purchase_no'];
		for ($i = 1; $i <= $d; $i++) {
	
	$c_name = "purchase_id".$i;
	setcookie ($c_name, "", time() - 90000, "/decoblue/", "localhost");
		
				Header('location: .././../content.php?option=admin&task=venta&function=sale');
		}
	
	
}
?>

