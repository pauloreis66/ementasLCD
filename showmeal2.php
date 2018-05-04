<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- margin: topo direita fundo esquerda --->

<style>
* {
  box-sizing: border-box;
}

.item {
  float:left;
  width:100%;
  height: 20%;
  padding:0 10px;
}


.imgcontainer {
    text-align: center;
    margin: 15px 0 15px 0;
	color: #1D4999;
	font-family: Arial, Helvetica, sans-serif;
	font-size:1.5em;
	font-weight: bold;
}

img.dish {
    width: 25%;
    border-radius: 25%;
}

img.calendar {
    display: block;
    margin: auto;
}

.itop { vertical-align: top; }
.ibottom { vertical-align: bottom; }
.ileft { float: left; }
.iright { float: right; }

span.line {
    font-size: 2.4em;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	padding-right: 10px;
}
span.line span {
    vertical-align: 300%;
    background: white;
	color: #000;
	
}
span#top {
    vertical-align: top;
}


h1 {
	text-align: center;
	margin: 0px 0px 0px 0px;
	color: #000;
	font-family: Arial, Helvetica, sans-serif;
	font-size:5.25em;
	font-weight: bold;
}
p.dish {
	text-align: left;
	color: #000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 2.4em;
	font-weight: bold;
}

h2 {
	text-align: center;
	margin: 10px 0px 10px 0px;
	color: #fff;
	font-family: Arial, Helvetica, sans-serif;
	font-size:1.8em;
	font-weight: bold;
}

h3 {
	text-align: center;
	margin: 0px;
	color: #000;
	font-family: Arial, Helvetica, sans-serif;
	font-size:1.3em;
	font-weight: bold;
}

/* Create two unequal columns that floats next to each other */
.column {
    float: left;
    padding: 0px;
	height: 125px;
    //height: 300px; /* Should be removed. Only for demonstration */
}

.left {
  width: 80%;
  float: left;
}

.right {
  width: 20%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}


@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .left, .right {
    width:100%;
  }
}
</style>
</head>
<body style="font-family:Verdana;color:#aaaaaa;">

<?php

function ValidaData($dat){
	$data = explode("/","$dat"); // fatia a string $dat em pedaços, usando / como referência
	$y = $data[0];
	$m = $data[1];
	$d = $data[2];

	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 1){
		return $dat;
	} else {
		return date('Y-m-d');
	}
}


require('connect.php');

$diasemana = array('domingo', 'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado');
$meses = array( 'JANEIRO', 'FEVEREIRO', 'MARÇO', 'ABRIL', 'MAIO', 'JUNHO', 'JULHO', 'AGOSTO', 'SETEMBRO', 'OUTUBRO', 'NOVEMBRO', 'DEZEMBRO´');

//não foi enviado uma data pelo url
if (!isset($_GET['data'])) {
	$MES = $meses[date("n")-1];
	$DIA = date("j");
	$data = date('Y-m-d');
	$diasemana_numero = date('w', strtotime($data));
	$SEMANA = $diasemana[$diasemana_numero];
}
else {
	//foi enviada uma data pelo url
	$data = ValidaData($_GET['data']);
	$dataarray = explode("/","$data");
	$DIA = $dataarray[2];
	$m = $dataarray[1];
	$MES = $meses[$m-1];
	$data2 = str_replace('/', '-', $data);
	$data = date('Y-m-d', strtotime($data2));
	$diasemana_numero = date('w', strtotime($data));
	$SEMANA = $diasemana[$diasemana_numero];
}

//verifica que tipo de ementa foi enviada pelo url
if (!isset($_GET['t'])) {
	$t=1;
} else {
	$t=$_GET['t'];
	}

#$consulta = "SELECT * FROM ementas1 WHERE tipo=" .$t. " AND DATE_FORMAT(data,'%Y-%m-%d') = " .$data;
$consulta = "SELECT * FROM ementas1 WHERE tipo=" .$t. " AND data LIKE '" .$data. "%'";
$resultado = mysqli_query($ligacao, $consulta);
$SOPA= "";
$PRATO= "";
$SALADA= "";
$SOBREMESA= "";
$PAO= "";
if($resultado){ 
		//existe o registo
		while($linha = mysqli_fetch_array($resultado)){
			$SOPA= $linha["sopa"];
			$PRATO= $linha["prato"];
			$SALADA= $linha["salada"];
			$SOBREMESA= $linha["sobremesa"];
			$PAO= $linha["pao"];
		}
}
mysqli_close($ligacao);
?>
<div class="row">
	<div class="column left" style="background-color:#fff;">
	<!-- 80% -->
		<div class="row">
			<div class="column right" style="background-color:#fff;">
			<!-- 20% -->
				<div class="imgcontainer">
					<img src="1sopa200c.png" alt="sopa" class="dish"><br>SOPA
				</div>
			</div>
			<div class="column left" style="background-color:#fff;">
			<!-- 80% -->
			<?php if (strlen($SOPA)<45) {
				echo "<p class='dish'>".$SOPA."</p>";
			}
			else {
				echo "<p>";
				echo "<span class='line'><span id='top'>".$SOPA."</span></span>";
				echo "</p>";
			}
			?>
			<!---
				<p>
				<span class='line'><span id='top'><?php echo $SOPA; ?></span></span>
				</p>
			--->
			</div>
		</div>
		
		<div class="row">
			<div class="column right" style="background-color:#fff;">
			<!-- 20% -->
				<div class="imgcontainer">
					<img src="2prato200c.png" alt="prato" class="dish"><br>PRATO
				</div>
			</div>
			<div class="column left" style="background-color:#fff;">
			<!-- 80% -->
			<?php if (strlen($PRATO)<45) {
				echo "<p class='dish'>".$PRATO."</p>";
			}
			else {
				echo "<p>";
				echo "<span class='line'><span id='top'>".$PRATO."</span></span>";
				echo "</p>";
			}
			?>
			</div>
		</div>
		
		<div class="row">
			<div class="column right" style="background-color:#fff;">
			<!-- 20% -->
				<div class="imgcontainer">
					<img src="3salada200c.png" alt="salada" class="dish"><br>SALADA
				</div>
			</div>
			<div class="column left" style="background-color:#fff;">
			<!-- 80% -->
			<?php if (strlen($SALADA)<45) {
				echo "<p class='dish'>".$SALADA."</p>";
			}
			else {
				echo "<p>";
				echo "<span class='line'><span id='top'>".$SALADA."</span></span>";
				echo "</p>";
			}
			?>
			</div>
		</div>
		
		<div class="row">
			<div class="column right" style="background-color:#fff;">
			<!-- 20% -->
				<div class="imgcontainer">
					<img src="4sobremesa200c.png" alt="sobremesa" class="dish"><br>SOBREMESA
				</div>
			</div>
			<div class="column left" style="background-color:#fff;">
			<!-- 80% -->
			<?php if (strlen($SOBREMESA)<45) {
				echo "<p class='dish'>".$SOBREMESA."</p>";
			}
			else {
				echo "<p>";
				echo "<span class='line'><span id='top'>".$SOBREMESA."</span></span>";
				echo "</p>";
			}
			?>
			</div>
		</div>
		
		<div class="row">
			<div class="column right" style="background-color:#fff;">
			<!-- 20% -->
				<div class="imgcontainer">
					<img src="5pao200c.png" alt="pao" class="dish"><br>PÃO
				</div>
			</div>
			<div class="column left" style="background-color:#fff;">
			<!-- 80% -->
			<?php if (strlen($PAO)<45) {
				echo "<p class='dish'>".$PAO."</p>";
			}
			else {
				echo "<p>";
				echo "<span class='line'><span id='top'>".$PAO."</span></span>";
				echo "</p>";
			}
			?>
			</div>
		</div>
	</div>

	<div class="column right" style="background-color:#fff;">
	<!-- 80% -->
		
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3" class="ibottom"><img src="mtopo.png" class="calendar"></td>
			</tr>
			<tr>
				<td colspan="3" style="background-color:#1D4999;"><h2><?php echo $MES; ?></h2></td>
			</tr>
			<tr>
				<td class="ileft"><img src="mesq1.png" class="calendar"></td>
				<td><h1><?php echo ltrim($DIA,'0'); ?></h1></td>
				<td class="iright"><img src="mdir1.png" class="calendar"></td>
			</tr>
			<tr>
				<td class="ileft"><img src="mesq2.png" class="calendar"></td>
				<td><h3><?php echo $SEMANA; ?></h3></td>
				<td class="iright"><img src="mdir2.png" class="calendar"></td>
			</tr>
			<tr>
				<td colspan="3" class="itop"><img src="mfundo.png" class="calendar"></td>
			</tr>
		
		</table>
		
	</div>
</div>

</body>
</html>
