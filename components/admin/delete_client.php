<?php
include("components/conexion/conexion.php"); 


		$id_auth = $_COOKIE['id'];
  		$auth = mysql_query("SELECT * FROM usuarios WHERE id = '$id'");
		$auth_data = mysql_fetch_array($auth);
		
	if($auth_data['user_type']=='1' OR $auth_data['user_type']=='2') { 
		echo '<!-- Autorizado -->';


if($_GET['task'] == 'delete_client'){

		$id = $_GET['id'];	
		$query = "DELETE FROM cliente WHERE cedula = '$id' ";
		$rs = mysql_query($query);

                if(get_rows("cliente") == 0) {
	    echo '<script>location="content.php?option=admin"</script>';
        } else {
      echo '<script>location="content.php?option=admin&task=clientes"</script>';  }



} else { 

echo "Funcion Erronea";

}

} else {
	
	echo '<script language=javascript>alert("No puedes acceder a esta sección.")</script><script>location="index.php"</script>';

}
	?>