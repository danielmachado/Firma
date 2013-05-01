<?php
	require_once "Figlet.php";
	require_once "helper.php";
	
	if(isset($_GET["message"]) && !isset($_GET["help"]) && !isset($_GET["whichFonts"])){
		$mess = urldecode($_GET["message"]);
		if(!isset($_GET["justification"])){
			$pos = "l";
		}else{
			$pos = $_GET["justification"];	
		}
		if(!isset($_GET["font"])){
			$font = "standard";
		}else{
			$font = $_GET["font"];	
		}
		
		$f = new Zend_Text_Figlet();
		
		$font = $font . ".flf";
		$f -> setFont($font);
		
		if (strcmp($pos, "l") == 0)
			$pos = 0;
		else if (strcmp($pos, "c") == 0)
			$pos = 1;
		else {
			$pos = 2;
		}
		$f -> setJustification($pos);
		
		echo $f -> render($mess);
	}else if(isset($_GET["help"]) && !isset($_GET["whichFonts"]) && !isset($_GET["message"])){
	
		//Esta versión PHP de Figlet no tiene help
		$url = "http://156.35.98.175/~dani.gayo/figlet/figlet.php?help";
		$datos = peticion($url);
		$sesionCURL = curl_init($url);
		
		echo($datos);
		
	}else if(isset($_GET["whichFonts"]) && !isset($_GET["help"]) && !isset($_GET["message"])){
		echo (serialize(get_fonts()));
		
	}else {
		header("HTTP/1.0 404 Not Found");
	}
?>