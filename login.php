<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 2px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	font-size: 1.0em;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
	font-size:1em;
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
    <a href="#">SHOW MEAL!</a>
	<p>&nbsp;</p>
  </div>

  <div class="main"><br>

  <?php 
		//session_start();
		require('connect.php');
		if (isset($_POST['uname']) AND isset($_POST['psw'])) {
			$username=$_POST['uname'];
			$password=$_POST['psw'];
			$query="SELECT * FROM utilizadores WHERE username='$username' AND password='$password'";
			$result=mysqli_query($ligacao, $query) or die(mysqli_error($ligacao));
			$count=mysqli_num_rows($result);
			if ($count==1) {
				$_SESSION['username']=$username;
			}
			else {
				$fmsg="Credenciais inválidas!";
			}
		}
		if (isset($_SESSION['username'])) {
			$username=$_SESSION['username'];
			//echo "Hai " . $username. "!";
			//echo "<a href='logout.php'>Logout</a>";
			header('Location: manager.php');
		}
		else {
			?>
<form method="POST">
  <div class="imgcontainer">
    <img src="userProfile.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username:</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
<?php
		}
?>

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
