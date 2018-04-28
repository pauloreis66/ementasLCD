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
	<a href="manageUploadCSV.php">VOLTAR</a>
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
				<th>Período Escolar:</th>
				<th>Tipo de Ementa:</th>
				<th>Ficheiro CSV:</th>
			</tr>
		</thead>
		<tr>

	<?php
		//tipos de ficheiros permitidos
		$csv_mimetypes = array('text/csv', 'text/plain', 'application/csv', 'text/comma-separated-values', 'application/excel', 'application/vnd.ms-excel', 'application/vnd.msexcel', 'text/anytext', 'application/octet-stream', 'application/txt');

	
		if (isset($_POST["submit"]) ) {
	
			if (isset($_FILES["fileToUpload"])) {
				
				if (!in_array($_FILES['fileToUpload']['type'], $csv_mimetypes)) {
					header('Location: managerParser.php');
					exit;
				}
		
				//se existe um erro ao enviar o ficheiro
				if ($_FILES["fileToUpload"]["error"] > 0) {
					echo "<td colspan='3'>Error Return Code: " . $_FILES["fileToUpload"]["error"] . "<br /></td>";
				}
				else {
						//exibir detalhes do envio
						$p='';
						$t='';
						if (isset($_POST['periodo'])) {
							$p=$_POST['periodo'];
						}
						if (isset($_POST['tipo'])) {
							$t=$_POST['tipo'];
						}
						
						echo "<td>".$p."</td><td>".$t."</td>";
						
						//exibir os detalhes do ficheiro
						echo "<td>";
						echo "Upload: " . $_FILES["fileToUpload"]["name"] . "<br />";
						echo "Type: " . $_FILES["fileToUpload"]["type"] . "<br />";
						echo "Size: " . ($_FILES["fileToUpload"]["size"] / 1024) . " Kb<br />";
						echo "Temp file: " . $_FILES["fileToUpload"]["tmp_name"] . "<br />";
						echo "</td>";

						//se o ficheiro já existe
						if (file_exists("uploads/" . $_FILES["fileToUpload"]["name"])) {
							echo $_FILES["fileToUpload"]["name"] . " já existe. ";
							echo "</td>";
						}
						else {
							//guarda o ficheiro na pasta "uploads" com o nome gerado
							$token = date("YmdHis");					
							$storagename = $token.".txt";
							move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $storagename);
							echo "Guardado: uploads/".$storagename."<br />";
							echo "</td>";
							
						//my parser
						echo "<tr><td colspan='3'>";
						$row = 1;
						$file2parse = "uploads/" . $storagename;
						//variaveis para refeições
						$semana=0;
						$sopa='';
						$prato='';
						$salada='';
						$sobremesa='';
						$pao='';
						if (($handle = fopen($file2parse, "r")) !== FALSE) {
							while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
								$num = count($data);
								echo "$num fields in line $row: <br />\n";
								$row++;
								for ($c=0; $c < $num; $c++) {
									//echo $data[$c] . "<br />\n";
									//if (strlen($data[$c]>0)) {
										echo $data[$c] . " ";
									//}

								}
								echo "<br />\n";
							}
							fclose($handle);
						}
						echo "</td></tr>";
						//end parser
						}
						
					
				}
			} else {
						echo "<td colspan='3'>No file selected.<br /></td>";
				}
		}
		
	?>
		</tr>
	</table>
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
