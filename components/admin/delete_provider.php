<?php
include("components/conexion/conexion.php"); 

		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);

	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') {
		echo '<!-- Autorizado -->';


if($_GET['task'] == 'delete_provider'){

		$id = $_GET['id'];
		$query = "DELETE FROM proovedor WHERE cod_ref = '$id' ";
		$rs = mysql_query($query);

        if(get_rows("proovedor") == 0) {
	    echo '<script>location="content.php?option=admin"</script>';
        } else {
   echo '<script>location="content.php?option=admin&task=proveedor"</script>';  }

} else {

echo "Funcion Erronea";

}


} else {

	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}
	?>