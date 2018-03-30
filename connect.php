<?php
	//Connect To Database
	$servidor="localhost";
	$utilizador="root";
	$password="root";
	$basedados="aebsignage";
	
	$ligacao = mysqli_connect($servidor,$utilizador,$password,$basedados);
	if (!$ligacao) {
		die ("Não foi possível ligar à base de dados.".mysqli_error($ligacao));
	}
	$consulta = mysqli_select_db($ligacao, $basedados);
	if (!$consulta) {
		die ("Não foi possível abrir a base de dados.".mysqli_error($ligacao));
	}
	mysqli_set_charset($ligacao, "utf8");
?>