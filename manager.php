<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

h2 {
	text-align:center;
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
		session_start();
		if (isset($_SESSION['username'])) {
			echo "<a href='logout.php'>LOGOUT</a>";
		}
		else {
			echo "<a href='login.php'>LOGIN</a>";
		}
	?>
    <a href="manageShowMeal.php">SHOW MEAL!</a>
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
<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>UPLOAD CSV & PARSER</h2>
	<p>&nbsp;</p>
    <p>Envio do CSV para realizar processo de Parsing.</p>
	<p>Parser do CSV e inserção de registos na BD.</p>
	<p>&nbsp;</p>
	<div class="imgcontainer">
		<p><a href='manageUploadCSV.php'><img src="upload.png" alt="Upload"></a></p>
	</div>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>REGISTOS DE REFEIÇÃO</h2>
	<p>&nbsp;</p>
    <p>Tarefas CRUD de registos existentes na BD.</p>
	<p>Configurar exibição de registos de refeição.</p>
	<p>&nbsp;</p>
		<div class="imgcontainer">
	<p><a href='managerDatabase.php'><img src="database.png" alt="Database"></a></p>
	</div>
  </div>
</div>

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
