<html>
	<head>
		<title>login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">

		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
		.w3-lobster {
		  font-family: "Comic Sans MS", cursive, sans-serif;
		}
		#home{
		border-style: solid;
		border-width: 0px 0px 10px 0px;
		color:#cccccc
		}
		body{
		}
		
		</style>
	</head>
	<body class="w3-metro-light-blue w3-padding">
	<?php

	if(isset($_POST['cani']))
	{

	$user=$_POST['user'];
	$pass=$_POST['pass'];
		$pd=new PDO('mysql:host=localhost;dbname=hack','root','');
		$q='select * from users';
		$p=$pd->query($q);
		while($row=$p->fetch())
		{
			if($user==$row[0])
			{
				if($pass==$row[1])
				{
					header("Location: main.php");
				}
			}
		}
	}
	?>
		<div class="w3-container w3-margin w3-lobster w3-metro-purple w3-card-4">
	        <img src="images/logo.jpeg" class="w3-margin" align="left" style="width:100px ; height:100px; border-radius: 20%" /> 
	        <h2 style="color:white;" class="w3-lobster w3-margin-top">Find My Way</h2>
			<h4 onclick="redirect1()" class="w3-margin w3-button w3-hover-black w3-round-large w3-white w3-right w3-padding">Create Account</h4>
			<h4 onclick="document.getElementById('id01').style.display='block'" class="w3-margin w3-hover-black w3-white w3-round-large w3-button w3-right w3-padding">Login</h4>
			<br>
	    </div>
	    <div id="id01" class="w3-modal">
		    <div class="w3-modal-content w3-card-4 w3-metro-purple w3-animate-zoom" style="max-width:600px">

		      <div class="w3-center"><br>
		        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
		        <img src="images/user.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
		      </div>
		      <form class="w3-container" method="POST" action="index.php">
		        <div class="w3-section">
		          <label><b>Username</b></label>
		          <input class="w3-input w3-border w3-black w3-margin-bottom" type="text" placeholder="Enter Username" name="user" required>
		          <label><b>Password</b></label>
		          <input class="w3-input w3-border w3-black" type="password" placeholder="Enter Password" name="pass" required>
		          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
		          <button class="w3-button w3-block w3-metro-light-blue w3-section w3-padding" name="cani" value="clicked" type="submit">Login</button>
		        </div>
		      </form>
		      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
		        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
		        <span class="w3-right w3-padding w3-hide-small">Forgot<a href="#">password?</a></span>
		      </div>

		    </div>
		  </div>
	</body>
</html>
<script type="text/javascript">
	function redirect1()
	{
		window.location="createaccount.php";
	}
</script>