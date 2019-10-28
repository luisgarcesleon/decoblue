<?php
// Este Script hace posible que los resultados de Datos grandes se seccionen por paginas.

    if(stristr(htmlentities($_SERVER['PHP_SELF']), "pagination.php")) {
      Header("Location: ../index.php");     die();  }
//______________________________________________________________________________________//

class paginar {

    // Resultados a Mostrar
    function mostrar($a) {
    $this->mostrar = $a; }

	function paginar($a) {
	$this->codigo = $a;

	$con = mysql_query(preg_replace('~ (SELECT) (.+) (FROM) ~ ','SELECT COUNT $2 FROM',$this->codigo));
	$this->total_resultados = mysql_result($con,0,0); }

    // Procesar Codigo SQL
	function procesar_codigo() {
	$this->total_pag = ceil($this->total_resultados/$this->mostrar);

        if (isset($_GET['pag'])) { $pag = $_GET['pag']; } else {  $pag = ''; }

	switch(true) {
	    case $pag < 1:
	        $pag = 1;
		    break;

        case $pag > $this->total_pag:
		    $pag = $this->total_pag;
}}

    $desde = preg_match('[0-9]',$pag) ? ($pag - 1) * $this->mostrar : 0;
	$con = mysql_query($this->codigo." LIMIT $desde,$this->mostrar");
	return $con;
}

    // Procesar URL evitando repetir varias veces la variable de página (ej. index.php?id=noticias&n=1&pag=1)
	function url() {
	    foreach ($_GET as $nombre => $valor) {
			if ($nombre != 'pag') {
				$valor = urlencode($valor) ;
				$url = "$nombre=$valor&" ;
}}

    return $url ;
    global $url;
}


    function crear_paginas() {
	    if (isset($_GET['pag'])) { $pag = $_GET['pag']; } else {  $pag = ''; }

    // Enlaces tipo www.pagina.com/?seccion=descargas
		if(strstr($_SERVER["PHP_SELF"],'/index.php')) {
			$_SERVER["PHP_SELF"] = str_replace('/index.php','/',$_SERVER["PHP_SELF"]) ;  }

        $max_paginas = 8;
		$url = $this->url();
		$pag_anterior = $pag - 1;

		if($pag_anterior >= 1) {
			$paginas_begun[] = '<div class="button2-right"><div class="start"><a href="'.$_SERVER["PHP_SELF"].'?'.$url.'pag=1" title="Inicio">Inicio</a></div></div>';
			$paginas_begun[] = '<div class="button2-right"><div class="prev"><a href="'.$_SERVER["PHP_SELF"].'?'.$url.'pag='.$pag_anterior.'" title="Anterior">Anterior</a></div></div>';
		} else {
            $paginas_begun[] = '<div class="button2-right off"><div class="start"><span>Inicio</span></div></div>';
		    $paginas_begun[] = '<div class="button2-right off"><div class="prev"><span>Anterior</span></div></div>';
        }

		if($this->total_pag > $max_paginas) {
			$this->total_pag_mostrar = $max_paginas;
		} else {
			$this->total_pag_mostrar = $this->total_pag;
		}

		$pag_desde = ($pag-$max_paginas/2);

		if($pag_desde < 1) {    $pag_desde = 1;    }
		$pag_hasta = ($pag+$max_paginas/2);

		if($pag_hasta > $this->total_pag) { $pag_hasta = $this->total_pag; }

		for($a = $pag_desde; $a <= $pag_hasta; $a++) {
			$multi_pg[] = ($a != $pag) ? '<a href="'.$_SERVER["PHP_SELF"].'?'.$url.'pag='.$a.'" title="'.$a.'">'.$a.'</a>' : '<span>'.$a.'</span>';
 		}

		$pag_siguiente = $pag + 1;

		if($pag_siguiente <= $this->total_pag) {
			$paginas_last[] = '<div class="button2-left"><div class="next"><a href="'.$_SERVER["PHP_SELF"].'?'.$url.'pag='.$pag_siguiente.'" title="Siguiente">Siguiente</a></div></div>';
			$paginas_last[] = '<div class="button2-left"><div class="end"><a href="'.$_SERVER["PHP_SELF"].'?'.$url.'pag='.$this->total_pag.'" title="Final">Final</a></div></div>';
		}  else {
         	$paginas_last[] = '<div class="button2-left off"><div class="next"><span>Siguiente</span></div></div>' ;
			$paginas_last[] = '<div class="button2-left off"><div class="end"><span>Final</span></div></div>' ;
		}

		$paginas ='<div class="pagination">'.@implode($paginas_begun).'<div class="button2-left"><div class="page">'.@implode($multi_pg).'</div></div>'.@implode($paginas_last).'<div class="limit">Página '.$pag.' de '.$this->total_pag.'</div><input type="hidden" name="limitstart" valu