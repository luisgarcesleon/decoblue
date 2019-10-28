<?php

if (stristr(htmlentities($_SERVER['PHP_SELF']), "paginar.php")) {
	   Header("Location: ../index.php");  die(); }


class paginar {
	# Obtener el total de resultados
	function mostrar($a) {
		$this->mostrar = $a ;
	}
	function paginar($a) {
		$this->codigo = $a ;
		$con = mysql_query(eregi_replace('select (.+) from','select count(*) from',$this->codigo)) ;
		$this->total_resultados = mysql_result($con,0,0) ;
	}
	# Procesar el código SQL
	function procesar_codigo() {
		$this->total_pag = ceil($this->total_resultados/$this->mostrar) ;
		switch(true) {
			case $_GET['pag'] < 1 :
				$_GET['pag'] = 1 ;
				break ;
			case $_GET['pag'] > $this->total_pag :
				$_GET['pag'] = $this->total_pag ;
		}
		$desde = ereg('[0-9]+',$_GET['pag']) ? ($_GET['pag'] - 1) * $this->mostrar : 0 ;
		$con = mysql_query($this->codigo." limit $desde,$this->mostrar") ;
		return $con ;
	}
	# Crear la URL evitando repetir varias veces la variable de página (ej. index.php?id=noticias&n=1&pag=1)
	function url() {
		foreach ($_GET as $nombre => $valor) {
			if ($nombre != 'pag') {
				$valor = urlencode($valor) ;
				$url .= "$nombre=$valor&" ;
			} }
		return $url ; }
	function crear_paginas() {
		# Para los que usan enlaces tipo www.pagina.com/?seccion=descargas
		if(strstr($_SERVER['PHP_SELF'],'/index.php')) {
			$_SERVER['PHP_SELF'] = str_replace('/index.php','/',$_SERVER['PHP_SELF']) ;
		}
		$max_paginas = 8 ;
		$url = $this->url() ;
		$pag_anterior = $_GET['pag'] - 1 ;
		if($pag_anterior >= 1) {
			$paginas[] = "<a href=\"$_SERVER[PHP_SELF]?$url"."pag=1\" class=\"eforo\">Primera</a>" ;
			$paginas[] = "<a href=\"$_SERVER[PHP_SELF]?$url"."pag=$pag_anterior\" class=\"eforo\">«</a>" ;
		}
		if($this->total_pag > $max_paginas) {
			$this->total_pag_mostrar = $max_paginas ;}
		else {
			$this->total_pag_mostrar = $this->total_pag ; }
		$pag_desde = ($_GET['pag']-$max_paginas/2) ;
		if($pag_desde < 1) {
			$pag_desde = 1 ;
		}
		$pag_hasta = ($_GET['pag']+$max_paginas/2) ;
		if($pag_hasta > $this->total_pag) {
			$pag_hasta = $this->total_pag ;
		}
		for($a = $pag_desde ; $a <= $pag_hasta ; $a++) {
			$paginas[] = ($a != $_GET['pag']) ? "<a href=\"$_SERVER[PHP_SELF]?$url"."pag=$a\" class=\"eforo\">$a</a>" : $a ;
		}
		$pag_siguiente = $_GET['pag'] + 1 ;
		if($pag_siguiente <= $this->total_pag) {
			$paginas[] = "<a href=\"$_SERVER[PHP_SELF]?$url"."pag=$pag_siguiente\" class=\"eforo\">»</a>" ;
			$paginas[] = "<a href=\"$_SERVER[PHP_SELF]?$url"."pag=$this->total_pag\" class=\"eforo\">Ultima</a>" ;
		}
		$paginas =
		'<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td>Páginas: <b>'.$this->total_pag.'</b></td>
		<td><div align="right">'.@implode(', ',$paginas).'</div></td>
		</tr>
		</table>
		' ;
		echo $paginas ;
	} }
?>