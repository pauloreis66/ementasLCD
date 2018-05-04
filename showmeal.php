<?php

	//verificar se foi indicado uma data e um tipo de ementa
	if (!empty($_POST)) {
		
		if (empty(str_replace(array("0", "-", ":", " "), "", $_POST['dataini']))) {
			//a data está vazia
			if (!isset($_POST['tipo'])) {
				header('Location: showmeal2.php');
				exit;
			}
			else {
				$t=$_POST['tipo'];
				header('Location: showmeal2.php?t='.$t);
				exit;
			}
		}
		else {
			//a data nao está vazia
			$var=$_POST['dataini'];
			$data = str_replace('-', '/', $var);
			if (!isset($_POST['tipo'])) {
				header('Location: showmeal2.php?data='.$data);
				exit;
			}
			else {
				$t=$_POST['tipo'];
				header('Location: showmeal2.php?data='.$data.'&t='.$t);
				exit;
			}
		}

	}
	
?>