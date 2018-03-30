<?php
	//verificar o nível da sessão
	session_start();
	if (!isset($_SESSION['username'])) {
			header('Location: login.php');
	}
	else {
		$username=$_SESSION['username'];
		echo "Hey ".$username."!<br>&nbsp;";
}

	//verificar se os campos estão preenchidos
	if (!empty($_POST) AND ( empty($_POST['tipo']) OR empty($_POST['periodo']) OR empty($_POST['semana']) OR empty($_POST['data']) OR empty($_POST['dia']) ) ) {
		
		$modo = $_GET['mode'];
		$id = $_GET['id'];
		
		echo 'temos erro';
		//header("Location: managerDatabaseRecord.php?id=".$id."&mode=".$modo);
		//exit;
	}
	

	//Connect To Database
	require('connect.php');
	
	//definir variáveis para escrever no registo
	$tipo = $_POST['tipo'];
	$periodo = $_POST['periodo'];
	$semana = $_POST['semana'];
	$data = $_POST['data'];
	$dia = $_POST['dia'];
	$sopa = $_POST['sopa'];
	$prato = $_POST['prato'];
	$salada = $_POST['salada'];
	$sobremesa = $_POST['sobremesa'];
	$pao = $_POST['pao'];
	$mostrar = 0;
	if (isset($_POST['mostrar'])) {
		$mostrar = 1;
	}
	$feriado = 0;
	if (isset($_POST['feriado'])) {
		$feriado = 1;
	}
	
	//verificar o nome do atributo input
	if (isset($_POST['cancel'])) {
		header("Location: managerDatabase.php");
		exit;
    }
    elseif (isset($_POST['save'])) {
		$consulta = "INSERT INTO ementas1 (periodo, tipo, semana, data, dia, sopa, prato, salada, sobremesa, pao, mostrar, feriado) VALUES ('$periodo', '$tipo', '$semana', '$data', '$dia', '$sopa', '$prato', '$salada', '$sobremesa', '$pao', '$mostrar', '$feriado')";
		$resultado = mysqli_query($ligacao, $consulta);
		if (($resultado) !=1) {
			//caso não tenha sido inseridos com sucesso os dados
			echo "Erro ao inserir novo registo: " . $resultado . "<br>" . mysqli_error($ligacao);
			header("Location: managerDatabase.php");
			exit;
			}
		else {
			echo "Inserido novo registo com sucesso. ";
			header("Location: managerDatabase.php");
			exit;
		}
	}
	elseif (isset($_POST['doit'])) {
		$modo = $_GET['mode'];
		$id = $_GET['id'];
		if ($modo == 'edit') {
			$consulta = "UPDATE ementas1 SET periodo='".$periodo."',tipo='".$tipo."',semana='".$semana."',data='".$data."',dia='".$dia."',sopa='".$sopa."', prato='".$prato."', salada='".$salada."', sobremesa='".$sobremesa."', pao='".$pao."', mostrar='".$mostrar."', feriado='".$feriado."' WHERE ID=".$id;
			$resultado = mysqli_query($ligacao, $consulta);
			echo $consulta;
			if (($resultado) !=1) {
				echo "Erro ao atualizar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				header("Location: managerDatabase.php");
				exit;
			}
			else {
				echo "Registo atualizado com sucesso. ";
				header("Location: managerDatabase.php");
				exit;
			}
		}
		elseif ($modo == 'delete') {
			$consulta = "DELETE FROM ementas1 WHERE ID=".$id;
			$resultado = mysqli_query($ligacao, $consulta);
			if (($resultado) !=1) {
				echo "Erro ao eliminar registo: " . $resultado . "<br>" . mysqli_error($ligacao);
				//header("Location: managerDatabase.php");
				//exit;
			}
			else {
				echo "Registo eliminado com sucesso. ";
				header("Location: managerDatabase.php");
				exit;
			}
		}
	}

	mysqli_close($ligacao);
?>