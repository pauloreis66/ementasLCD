<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 2px solid #f1f1f1;}

* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 325px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
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
	font-size: 1.0em;
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

span.psw {
    float: right;
    padding-top: 16px;
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
  width:20%;
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
  width:60%;
  padding:0 20px;
}
.right {
  background-color:#ffffff;
  float:left;
  width:20%;
  padding:15px;
  margin-top:7px;
  text-align:center;
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
<p><img src="aeblogo200.png" alt="Logo"></p>
    <a href="index.html">HOME</a>
	<?php
		ini_set('default_charset','UTF-8');
		session_start();
		if (isset($_SESSION['username'])) {
			echo "<a href='logout.php'>LOGOUT</a>";
		}
		else {
			echo "<a href='login.php'>LOGIN</a>";
		}
	?>
    <a href="#">SHOW MEAL!</a>
	<a href="manager.php">VOLTAR</a>
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
  
  <form action="managerUploaderParser.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">

  <h2>UPLOAD CSV & PARSER</h2>
  	<hr>
	<p><strong>Período Escolar:</strong>&nbsp;&nbsp;&nbsp;
	<input class="w3-radio" type="radio" name="periodo" value="1" checked>
		<label>1ºPeríodo</label>&nbsp;&nbsp;&nbsp;
		<input class="w3-radio" type="radio" name="periodo" value="2">
		<label>2ºPeríodo</label>&nbsp;&nbsp;&nbsp;
		<input class="w3-radio" type="radio" name="periodo" value="3">
		<label>3ºPeríodo</label>
	</p>
	
	<p><strong>Tipo de Ementa:</strong>&nbsp;&nbsp;&nbsp;
		<select class="w3-select" name="tipo">
			<option value="" disabled selected>Escolher tipo...</option>
			<option value="1">Mediterrânica</option>
			<option value="2">Vegetariana</option>
			<option value="3">Alergia a Ovo</option>
			<option value="4">Alergia a Leite</option>
			<option value="5">Alergia a Ovo e Leite</option>
			<option value="6">Alergia a Glúten</option>
			<option value="0">Todas</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<strong>Data de início:</strong>&nbsp;&nbsp;&nbsp;<input type="date" name="dataini" class="w3-select">
	</p>
	
	<p><strong>Ficheiro CSV:</strong>&nbsp;&nbsp;&nbsp;
		<input type="file" name="fileToUpload" id="fileToUpload">
	</p>
	<hr>
	<div class="container">
		<button type="submit" name="submit">Enviar CSV</button>
		<button type="reset" class="cancelbtn">Limpar dados</button>
	</div>
</form>

  </div>

  <div class="right">
    <h2>Sobre...</h2>
    <p>Plataforma de gestão de Ementas Escolares para uso na solução Digital Signage.</p>
	<p><img src="meal-clipart.png" alt="Meals"></p>
  </div>
</div>

<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">2018 © copyright <strong>Agrupamento de Escolas da Batalha</strong></div>

</body>
</html>
