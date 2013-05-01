<?php 
require_once "helper.php"
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Firmador </title>
		<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
	</head>
	<?php

			$url = "http://156.35.98.27/Firma/app/restFul.php";
			
			if(isset($_POST["message"])){
				if(strlen($_POST["message"])>0){
					$mess = urlencode($_POST["message"]);
					$url = $url."?".message($mess);
					$url = $url."&".position($_POST["justification"]);
					$url = $url."&".fonts($_POST["font"]);
					
					$datos = peticion($url);
				}	
			}		
		
		?>
	<body>
		<div id="console">
			<?php
				if(isset($datos))
			 		echo $datos ?>
		</div>
		<h1>Formulario:</h1>
		<form action="firmador.php" method="post">
			<b>Enter your text:</b>
			<input type="text" name="message">
			<br>
			<b>Choose the font:</b>
				
				<?php
					echo '<select name="font">';
					$array = peticion("http://156.35.98.27/Firma/app/restFul.php?whichFonts");
					$array = unserialize($array);
					foreach ($array as $i) {
						 	if(strlen($i)>1)
						 echo "<option value=\"".$i."\">".$i."</option>";
					
					}
					echo '</select>';	 
				?>
				
			<br>
			<b>Choose the justification style:</b>
			<select name="justification">
				<option value="l" selected="">Left</option>
				<option value="c">Center</option>
				<option value="r">Right</option>
			</select>
			<br>
			<input type="submit" value="Print!">
		</form>
	</body>
</html>