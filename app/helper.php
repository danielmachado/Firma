<?php

	//function para tratar el texto de la firma, si esta vacio, false, si no el parametro del servicio web
	function message($mess) {
	
		if (isset($mess) == false)
			return false;
	
		return "message=" . $mess;
	
	}
	
	function peticion($url) {
		
		$sesionCURL = curl_init($url);
	
		//curl_setopt($sesionCURL, CURLOPT_PROXY, "156.35.14.6:8888");
		curl_setopt($sesionCURL, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($sesionCURL, CURLOPT_TIMEOUT, 60);
		$datos = curl_exec($sesionCURL);
		curl_close($sesionCURL);
		
		return $datos;
		
	}
	
	//Comprueba si entra el modo Help
	function check_help(){
		if(isset($_GET["help"]))
			return true;
		return false;
	}
	
	//Comprueba que exista, y comprueba que sea una justificacion valida
	function position($pos) {
	
		if (isset($pos) == false)
			return false;
		else if (strcmp($pos, "c") == 0)
			return "justification=" . $pos;
		else if (strcmp($pos, "l") == 0)
			return "justification=" . $pos;
		else if (strcmp($pos, "r") == 0)
			return "justification=" . $pos;
	
	}
	
	//Comprueba que se pasa una fuente
	function fonts($font) {
	
		if (isset($font) == false)
			return false;
		else if (check_font($font) == false)
			return false;
	
		return "font=" . $font;
	}
	
	//Comprueba que la fuente existe
	function check_font($font) {
	
		$array = get_fonts();
		
		foreach ($array as $i) {
			if (strcmp($font, $i)==0){
				return true;
			}
		}
		return false;
	}
	
	//Obtiene las fuentes del sistema
	function get_fonts() {
	
		$d = dir("./fonts/");
		
		$array = array();
	
		while (false !== ($entry = $d -> read())) {
	
			$entry = trim($entry, ".flf");
			
			$array[] = $entry;
			
		}
		$d -> close();
	
		return $array;
	}
?>