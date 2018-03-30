<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 2px solid #f1f1f1;}
pre {
	font-family: Arial, Helvetica, sans-serif;
	font-size:0.8125em;
}

.w3-table-all, .w3-table-nav {border-collapse:collapse;border-spacing:0;width:100%;display:table}
.w3-table-all, .w3-table-nav{border:1px solid #ccc}
.w3-table-all tr, .w3-table-nav tr{border-bottom:1px solid #ddd}
.w3-table-all tr:nth-child(odd){background-color:#fff}
.w3-table-all tr:nth-child(even){background-color:#f1f1f1}
.w3-hoverable tbody tr:hover,.w3-ul.w3-hoverable li:hover{background-color:#ccc}
.w3-table-all td,.w3-table-all th{padding:4px 4px;display:table-cell;text-align:left;vertical-align:top;font-size:0.7em;}
.w3-table-all th:first-child,.w3-table-all td:first-child{padding-left:8px}

.w3-light-grey,.w3-hover-light-grey:hover,.w3-light-gray,.w3-hover-light-gray:hover{color:#000!important;background-color:#f1f1f1!important}

.w3-table-nav td{padding:4px 4px;display:table-cell;text-align:left;vertical-align:top}

* {
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 50%;
	font-size:1em;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
	width: 50%;
}


.w3-check,.w3-radio {
	width:12px;
	height:24px;
	position:relative;
	top:6px;
}

.w3-select {
	padding:9px 0;
	width:20%;
	border:none;
	border-bottom:1px solid #ccc;
}

.imgcontainer {
    text-align: center;
    margin: 12px 0 6px 0;
}

img.avatar {
    width: 20%;
    border-radius: 25%;
}

.container {
    padding: 16px;
}


h2, p {
	text-align:center;
}

hr {
	border:0;border-top:1px solid #eee;margin:20px 0
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

* {
  box-sizing: border-box;
}
.menu {
  float:left;
  width:15%;
  text-align:center;
}
.menu a {
  background-color:#ffffff;
  padding:8px;
  margin-top:7px;
  display:block;
  width:100%;
  color:black;
  font-weight: bold;
}
.main {
  float:left;
  width:85%;
  padding:0 20px;
}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width:100%;
  }
}
</style>
</head>
<body >

<div style="background-color:#e5e5e5;padding:15px;text-align:center;">
  <h1>AEB Digital Signage</h1>
</div>

<div style="overflow:auto">
<div class="menu">
<p><img src="aeblogo150.png" alt="Logo"></p>
    <a href="index.html">HOME</a>
	<?php
		session_start();
		if (isset($_SESSION['username'])) {
			echo "<a href='logout.php'>LOGOUT</a>";
		}
		else {
			echo "<a href='login.php'>LOGIN</a>";
		}
	?>
    <a href="#">SHOW MEAL!</a>
	<a href="managerDatabase.php">VOLTAR</a>
	<p>&nbsp;</p>
  </div>

  <div class="main"><br>
    <?php 

		if (!isset($_SESSION['username'])) {
			header('Location: login.php');
		}
		else {
			$username=$_SESSION['username'];
			echo "Hey ".$username."!<br>&nbsp;";
		}
  ?>

	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-light-grey">
				<th>ID</th>
				<th>Pe.</th>
				<th>Tipo</th>
				<th>Sem.</th>
				<th>Data</th>
				<th>Dia</th>
				<th>Sopa</th>
				<th>Prato</th>
				<th>Salada</th>
				<th>Sobremesa</th>
				<th>Pão</th>
				<th></th>
			</tr>
		</thead>
<?php
		$registosPagina = 10;
		if (empty($_GET['pagina'])) {
			$_GET['pagina'] = 1;
			$pagina = 1;
		}
		$primeiroReg = ($_GET['pagina'] * $registosPagina) - $registosPagina;
		
		$t=0;
		$p=0;
		$s=0;
	
		require('connect.php');
		#tipo, periodo e semana
		if (isset($_POST['tipo']) AND isset($_POST['periodo']) AND isset($_POST['semana'])) {
			$t=$_POST['tipo'];
			$p=$_POST['periodo'];
			$s=$_POST['semana'];
			$consulta="SELECT * FROM ementas1 WHERE periodo='$p' AND tipo='$t' AND semana='$s' ORDER BY periodo, tipo, semana ASC LIMIT $primeiroReg, $registosPagina";
			$navegar="SELECT * FROM ementas1 WHERE periodo='$p' AND tipo='$t' AND semana='$s' ORDER BY 1";
		}
		else {
			#tipo e periodo
			if (isset($_POST['tipo']) AND isset($_POST['periodo'])) {
				$t=$_POST['tipo'];
				$p=$_POST['periodo'];
				$consulta="SELECT * FROM ementas1 WHERE tipo='$t' AND periodo='$p' ORDER BY tipo, periodo ASC LIMIT $primeiroReg, $registosPagina";
				$navegar="SELECT * FROM ementas1 WHERE tipo='$t' AND periodo='$p' ORDER BY 1";
			}
			else {
				#tipo e semana
				if (isset($_POST['tipo']) AND isset($_POST['semana'])) {
					$t=$_POST['tipo'];
					$s=$_POST['semana'];
					$consulta="SELECT * FROM ementas1 WHERE tipo='$t' AND semana='$s' ORDER BY tipo, semana ASC LIMIT $primeiroReg, $registosPagina";
					$navegar="SELECT * FROM ementas1 WHERE tipo='$t' AND semana='$s' ORDER BY 1";
				}
				else {
					#periodo e semana
					if (isset($_POST['periodo']) AND isset($_POST['semana'])) {
						$p=$_POST['periodo'];
						$s=$_POST['semana'];
						$consulta="SELECT * FROM ementas1 WHERE periodo='$p' AND semana='$s' ORDER BY periodo, semana ASC LIMIT $primeiroReg, $registosPagina";
						$navegar="SELECT * FROM ementas1 WHERE periodo='$p' AND semana='$s' ORDER BY 1";
					}
					else {
						#tipo
						if (isset($_POST['tipo']) AND empty($_POST['periodo']) AND empty($_POST['semana'])) {
							$t=$_POST['tipo'];
							$consulta="SELECT * FROM ementas1 WHERE tipo='$t' ORDER BY tipo, semana ASC LIMIT $primeiroReg, $registosPagina";
							$navegar="SELECT * FROM ementas1 WHERE tipo='$t' ORDER BY 1";
						}
						else {
							#periodo
							if (isset($_POST['periodo']) AND empty($_POST['tipo']) AND empty($_POST['semana'])) {
								$p=$_POST['periodo'];
								$consulta="SELECT * FROM ementas1 WHERE periodo='$p' ORDER BY tipo, periodo, semana ASC LIMIT $primeiroReg, $registosPagina";
								$navegar="SELECT * FROM ementas1 WHERE periodo='$p' ORDER BY 1";
							}
							else {
								#semana
								if (isset($_POST['semana']) AND empty($_POST['tipo']) AND empty($_POST['periodo'])) {
									$s=$_POST['semana'];
									$consulta="SELECT * FROM ementas1 WHERE semana='$s' ORDER BY tipo, periodo, semana ASC LIMIT $primeiroReg, $registosPagina";
									$navegar="SELECT * FROM ementas1 WHERE semana='$s' ORDER BY 1";
								}
								else {
									#tudo
									$consulta="SELECT * FROM ementas1 ORDER BY semana, periodo, tipo ASC LIMIT $primeiroReg, $registosPagina";
									$navegar="SELECT * FROM ementas1 ORDER BY 1";
								}
							}
						}
					}
				}
			}
			
		}
		
		echo $navegar;
		$result=mysqli_query($ligacao, $consulta) or die(mysqli_error($ligacao));
		$resultado = mysqli_query($ligacao, $consulta);
		
		if(!empty(mysqli_num_rows($resultado))) {

		while($linha = mysqli_fetch_array($resultado)){
			
			$id = $linha["ID"];
			$pe = $linha["periodo"];
			$tipo = $linha["tipo"];
			$sem = $linha["semana"];
			$data = $linha["data"];
			$dia = $linha["dia"];
			$sopa = $linha["sopa"];
			$prato = $linha["prato"];
			$salada = $linha["salada"];
			$sobremesa = $linha["sobremesa"];
			$pao = $linha["pao"];
			echo "<tr>";
			echo "<td>" .$id. "</td><td>".$pe."</td><td>".$tipo."</td><td>".$sem."</td>";
			echo "<td>" .$data. "</td><td>".$dia."</td><td>".$sopa."</td><td>".$prato."</td>";
			echo "<td>" .$salada. "</td><td>".$sobremesa."</td><td>".$pao."</td>";
			echo "<td nowrap><a href='managerDatabaseRecord.php?id=".$id."&mode=edit'><img src='edit.png' alt='editar'>Editar</a>&nbsp;<a href='managerDatabaseRecord.php?id=".$id."&mode=delete'><img src='delete.png' alt='eliminar'>Eliminar</a></td>";
			echo "</tr>";
		}
		echo "</table><br>";
		//-----navegação entre páginas
		echo "<table class='w3-table-nav'><tr class='w3-light-grey'><td>";
		echo "<a href='managerDatabaseNew.php'><img src='add.png' alt='novo'>novo registo</a></td>";
		echo "<td>Página:&nbsp;";
		//calcular o numero de registos e numero de paginas necessarias
		$sqlTodosReg = mysqli_query($ligacao, $navegar);
		$totalRegistos = mysqli_num_rows($sqlTodosReg);
		$totalPaginas = ceil($totalRegistos / $registosPagina);
		$totalPaginas++;
		//determinar o valor da pagina atual
		$pagina = $_GET['pagina'];
		//determinar se é a primeira pagina e mostrar numero
		if ($pagina ==1) {
			echo "<a href=?pagina=".($pagina)."></a>";
		}
		else {
			echo "<a href=?pagina=".($pagina-1).">Anterior</a>";
		}
		//determinar numero de paginas e coloca-los
		for ($pag=1; $pag<$totalPaginas; $pag++) {
			//determinar a pagina atual
			if ($pagina == $pag) {
				//apresentar os numeros restantes
				echo "&nbsp;[$pag]&nbsp;";
			}
			else {
				$paginaSeguinte = $pag;
				echo "&nbsp;<a href=?pagina=$paginaSeguinte>$pag</a>&nbsp;";
			}
		}
		//determinar se é a ultima pagina
		if (($pagina+1) < $totalPaginas) {
			//se não é ultima, adiciona ligacao para a seguinte
			echo "<a href=?pagina=".($pagina+1).">Seguinte</a>";
		}
		else {
			echo "";
		}
		echo "</td></tr></table>";
	}
	else {
			//caso não existam registos
			echo "<tr><td colspan='12'>Não existem registos.</td></tr>";
			echo "</table><br>";
			echo "<table class='w3-table-nav><tr class='w3-light-grey'><td align='center'>";
			echo "<a href='managerDatabaseNew.php'><img src='add.png' alt='novo'>novo registo</a></td>";
			echo "</td></tr></table>";
	}
	
?>

	</div>
	<div>
		<pre>Pe.: (1) 1ºPeríodo, (2) 2ºPeríodo, (3) 3ºPeríodo</pre>
		<pre>Tipo: (1) Mediterrânica, (2) Vegetariana, (3) Alergia a ovo, (4) Alergia a leite, (5) Alergia a ovo e leite, (6) Alergia a glúten</pre>
	</div>
</div>
</div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">2018 © copyright <strong>Agrupamento de Escolas da Batalha</strong></div>

</body>
</html>
