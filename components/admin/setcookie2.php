<?php

    if($_GET['mode']== 'delete_all'){
	    setcookie('id', '', time() - 90000);
	    setcookie('username', '', time() - 90000);
	    setcookie('password', '', time() - 90000);

        	Header("location: ../../index.php");
}
?>