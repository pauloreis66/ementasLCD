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

//input[type=checkbox] {
//  transform: scale(1.2);
//}


input[type=checkbox].css-checkbox {
		position:absolute; 
		z-index:-1000; 
		left:-1000px; 
		overflow: hidden; 
		clip: rect(0 0 0 0); 
		height:1px; 
		width:1px; 
		margin:-1px; 
		padding:0; 
		border:0;
}

input[type=radio].css-radio {
	position:absolute; 
	z-index:-1000; 
	left:-1000px; 
	overflow: hidden; 
	clip: rect(0 0 0 0); 
	height:1px; 
	width:1px; 
	margin:-1px; 
	padding:0; 
	border:0;
}

input[type=radio].css-radio + label.css-labelrad {
	padding-left:33px;
	height:28px; 
	display:inline-block;
	line-height:28px;
	background-repeat:no-repeat;
	background-position: 0 0;
	font-size:12px;
	vertical-align:middle;
	cursor:pointer;
}

input[type=radio].css-radio:checked + label.css-labelrad {
	background-position: 0 -28px;
}

label.css-labelrad {
	background-image:url(2radio.png);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

input[type=checkbox].css-checkbox + label.css-labelchk {
	padding-left:35px;
	height:25px; 
	display:inline-block;
	line-height:25px;
	background-repeat:no-repeat;
	background-position: 0 0;
	font-size:12px;
	vertical-align:middle;
	cursor:pointer;
}

input[type=checkbox].css-checkbox:checked + label.css-labelchk {
	background-position: 0 -25px;
}

label.css-labelchk {
	background-image:url(2checkbox.png);
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}


input[type=text], select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

input.short[type=text], select.short {
    width: 25%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
}

input.inactive[type=text], select.inactive {
    width: 25%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    background: #eee;
    color: #727272;
}


label {
    padding: 12px 12px 12px 0;
    display: inline-block;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
	width: 30%;
    //float: right;
}

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

.col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
}

.col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
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
  
      .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
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
    <a href="manageShowMeal.php">SHOW MEAL!</a>
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
		require('connect.php');

	//verificar qual o id e o mode
	$botao = "";
	if(!isset($_GET['id']) AND !isset($_GET['mode'])) {
		//não existe id nem mode
		header("Location: managerDatabase.php");
		exit;
	}
	else {
		if(!isset($_GET['id'])) {
			//não existe id
			header("Location: managerDatabase.php");
			exit;
			}
		else {
			$id = $_GET['id'];
			$modo = $_GET['mode'];
			if ($modo == 'edit') { $botao = "Atualizar"; }
			if ($modo == 'delete') { $botao = "Eliminar"; }
		}
	}
	# Verificar se o registo existe
	$consulta = "SELECT * FROM ementas1 WHERE ID=" .$id;
	$resultado = mysqli_query($ligacao, $consulta);
	
	if($resultado){ 
		//existe o registo
		while($linha = mysqli_fetch_array($resultado)){
			$campo0= $linha["ID"];
			$campo1 = $linha["periodo"];
			$campo2= $linha["tipo"];
			$campo3 = $linha["semana"];
			$campo4 = $linha["data"];
			$campo5 = $linha["dia"];
			$campo6 = $linha["sopa"];
			$campo7 = $linha["prato"];
			$campo8 = $linha["salada"];
			$campo9 = $linha["sobremesa"];
			$campo10 = $linha["pao"];
			$campo11 = $linha["mostrar"];
			$campo12 = $linha["feriado"];
		}
		?>
		<div class="container">
		<form id="form_registo" method="POST" 
			action="processarRegisto.php?id=<?php echo $campo0 ?>&mode=<?php echo $modo ?>">
			
			<div class="row">
				<div class="col-25"><label for="ID">ID:</label></div>
				<div class="col-75">
					<input type="text" class="short inactive" name="ID" value="<?php echo $campo0 ?>" readonly>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Período:</label></div>
				<div class="col-75"><?php 
					$options = array( '1º Período', '2º Período', '3º Período' );
					$output = '';
					for( $i=0; $i<count($options); $i++ ) {
						$item=$i+1;
						if ($modo=='edit') {
							$output = '<input type="radio" name="periodo" id="radio'.$item.'" class="css-radio" value='.$item.' '.($campo1 == $item ? 'checked="checked"' : '' ).'><label for="radio'.$item.'" class="css-labelrad radGroup">'.$options[$i].'</label>';
						}
						else {
							$output = '<input type="radio" name="periodo" id="radio'.$item.'" class="css-radio" value='.$item.' '.($campo1 == $item ? 'checked="checked"' : '' ).' disabled><label for="radio'.$item.'" class="css-labelrad radGroup">'.$options[$i].'</label>';
						}
						echo $output;
					}
					?></div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Tipo:</label></div>
				<div class="col-75"><select name="tipo" class="short" ><?php 
						$options = array( 'Mediterrânica', 'Vegetariana', 'Alergia a ovo', 'Alergia a leite', 'Alergia a ovo e leite', 'Alergia a glúten');
						$output = '';
							for( $i=0; $i<count($options); $i++ ) {
								$item=$i+1;
								if ($modo=='edit') {
									$output = '<option value='.$item.' '.($campo2 == $item ? 'selected="selected"' : '' ).'>'.$options[$i].'</option>';
								}
								else {
									$output = '<option value='.$item.' '.($campo2 == $item ? 'selected="selected"' : '' ).'  disabled>'.$options[$i].'</option>';
								}
								echo $output;
							}
						
					?></select></div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Semana:</label></div>
				<div class="col-75">
						<select name="semana" class="short" ><?php 
							$output = '';
							for( $i=0; $i<15; $i++ ) {
								$item=$i+1;
								if ($modo=='edit') {
									$output = '<option value='.$item.' '.($campo3 == $item ? 'selected="selected"' : '' ).'>'.$item.'</option>';
								}
								else {
									$output = '<option value='.$item.' '.($campo3 == $item ? 'selected="selected"' : '' ).'  disabled>'.$item.'</option>';
								}
								echo $output;
							}
						
					?></select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Data (aaaa-mm-dd):</label></div>
				<div class="col-75">
					<?php 
							if ($modo=='edit') {
								echo '<input type="text" name="data" class="short" value="'.$campo4.'">';
							}
							else {
								echo '<input type="text" name="data" class="short" value="'.$campo4.'" readonly>';
							}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Dia:</label></div>
				<div class="col-75">
						<select name="dia" class="short" ><?php 
							$options = array( 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta');
							$output = '';
							for( $i=0; $i<count($options); $i++ ) {
								$item=$i+1;
								if ($modo=='edit') {
									$output = '<option value='.$options[$i].' '.($campo5 == $options[$i] ? 'selected="selected"' : '' ).'>'.$options[$i].'</option>';
								}
								else {
									$output = '<option value='.$options[$i].' '.($campo5 == $options[$i] ? 'selected="selected"' : '' ).'  disabled>'.$options[$i].'</option>';
								}
								echo $output;
							}
						
					?></select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>SOPA:</label></div>
				<div class="col-75">
					<?php 
						if ($modo=='edit') {
							echo '<input type="text" name="sopa" value="'.$campo6.'">';
						}
						else {
							echo '<input type="text" name="sopa" value="'.$campo6.'" readonly>';
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>PRATO:</label></div>
				<div class="col-75">
					<?php 
						if ($modo=='edit') {
							echo '<input type="text" name="prato" value="'.$campo7.'">';
						}
						else {
							echo '<input type="text" name="prato" value="'.$campo7.'" readonly>';
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>SALADA:</label></div>
				<div class="col-75">
					<?php 
						if ($modo=='edit') {
							echo '<input type="text" name="salada" value="'.$campo8.'">';
						}
						else {
							echo '<input type="text" name="salada" value="'.$campo8.'" readonly>';
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>SOBREMESA:</label></div>
				<div class="col-75">
					<?php 
						if ($modo=='edit') {
							echo '<input type="text" name="sobremesa" value="'.$campo9.'">';
						}
						else {
							echo '<input type="text" name="sobremesa" value="'.$campo9.'" readonly>';
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>PÃO:</label></div>
				<div class="col-75">
					<?php 
						if ($modo=='edit') {
							echo '<input type="text" name="pao" value="'.$campo10.'">';
						}
						else {
							echo '<input type="text" name="pao" value="'.$campo10.'" readonly>';
						}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Mostrar o registo?</label></div>
				<div class="col-75"><?php 
					$output = '';
					if ($modo=='edit') { 
						$output = '<input name="mostrar" type="checkbox" class="css-checkbox" id="checkboxG1"'.($campo11 == 1 ? 'checked="checked"' : '' ).'><label for="checkboxG1" class="css-labelchk">&nbsp;(marcar para sim)</label>';
					}
					else {
						$output = '<input name="mostrar" type="checkbox" class="css-checkbox" id="checkboxG1"'.($campo11 == 1 ? 'checked="checked"' : '' ).' disabled><label for="checkboxG1" class="css-labelchk">&nbsp;(marcar para sim)</label>';
					}
					echo $output;
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"><label>Feriado neste dia?</label></div>
				<div class="col-75"><?php 
					$output = '';
					if ($modo=='edit') { 
						$output = '<input name="feriado" type="checkbox" class="css-checkbox" id="checkboxG2"'.($campo12 == 1 ? 'checked="checked"' : '' ).'><label for="checkboxG2" class="css-labelchk">&nbsp;(marcar para sim)</label>';
					}
					else {
						$output = '<input name="feriado" type="checkbox" class="css-checkbox" id="checkboxG2"'.($campo12 == 1 ? 'checked="checked"' : '' ).' disabled><label for="checkboxG2" class="css-labelchk">&nbsp;(marcar para sim)</label>';
					}
					echo $output;
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-25"></div>
				<div class="col-75">
					<input type="submit" name="doit" value="<?php echo $botao ?>">&nbsp;
					<input type="submit" name="cancel" value="Cancelar" >&nbsp;
				</div>
			</div>
	<?php
	}
	else {
		//caso não existam registos
		echo "Não foi encontrado o registo.";
	}
	?>
		</form>


	</div>
	<div>
		<pre>Pe.: (1) 1ºPeríodo, (2) 2ºPeríodo, (3) 3ºPeríodo</pre>
		<pre>Tipo: (1) Mediterrânica, (2) Vegetariana, (3) Alergia a ovo, (4) Alergia a leite, (5) Alergia a ovo e leite, (6) Alergia a glúten </pre>
	</div>
</div>
</div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">2018 © copyright <strong>Agrupamento de Escolas da Batalha</strong></div>

</body>
</html>
