<!DOCTYPE html>
<html>
<head>
	<title>Create account</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
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
		</style>
</head>
<body class="w3-padding w3-black">
	<div class="w3-container w3-margin w3-lobster w3-metro-purple w3-card-4">
	        <img src="images/logo.jpeg" class="w3-margin" align="left" style="width:100px ; height:100px; border-radius: 20%" /> 
	        <h2 style="color:white;" class="w3-lobster w3-margin-top">Find My Way</h2>
	        <button class="w3-button w3-red" onclick="redirect1()">Go back</button>
	    </div>
	<?php
	if (!isset($_POST['register'])) {
		echo '
		<div class="w3-card-4 w3-lobster w3-margin">
		  <div class="w3-container w3-metro-purple">
		    <h2>Create Account</h2>
		    <br>
		  </div>
		  <form onsubmit="return check()" name="myform" class="w3-container w3-metro-light-blue" method="POST" action="createaccount.php">
		  	<br>
		    <p>      
		    <label class="w3-text-black"><b>First Name</b></label>
		    <input class="w3-input w3-border w3-black" name="first" type="text" required></p>
		    <p>      
		    <label class="w3-text-black"><b>Last Name</b></label>
		    <input class="w3-input w3-border w3-black" name="last" type="text" required></p>
		    <p>      
		    <label class="w3-text-black"><b>Username</b></label>
		    <input class="w3-input w3-border w3-black" name="user" type="text" required></p>
		    <p>      
		    <label id="pass1" class="w3-text-black"><b>Password</b></label>
		    <input class="w3-input w3-border w3-black" name="pass1" type="password" required></p>
		    <p>      
		    <label id="pass2" class="w3-text-black"><b>Confirm password</b></label>
		    <input class="w3-input w3-border w3-black" name="pass2" type="password" required></p>
		    <p>      
		    <label class="w3-text-black"><b>Mobile number</b></label>
		    <input class="w3-input w3-border w3-black" name="phno" type="number" required></p>
		    <p>
		    <button onclick="check()" class="w3-btn w3-metro-purple w3-right w3-margin w3-padding w3-large" name="register" value="clicked" type="submit">Register</button></p>
		  </form>
		</div>';
	}
	else{
		$c=1;
		$pd=new PDO('mysql:host=localhost;dbname=hack','root','');
		$first=$_POST['first'];
		$last=$_POST['last'];
		$user=$_POST['user'];
		$pass=$_POST['pass1'];
		$phno=$_POST['phno'];
		$q='select * from users';
			$p=$pd->query($q);
			while($row=$p->fetch())
			{
			if($row[0]==$user){
				echo '<h1>This username already exists<br><button onclick="redirect2()" class="w3-margin w3-padding w3-button w3-hover-white w3-red">Try again</button></h1>';
				$c=0;
			}
			}
		if($c!=0)
		{
			$p=$pd->prepare('insert into users values(?,?,?,?,?)');
			$p->bindparam(1,$user);
			$p->bindparam(2,$pass);
			$p->bindparam(3,$first);
			$p->bindparam(4,$last);
			$p->bindparam(5,$phno);
			$p->execute();
			echo '
			<div class="w3-padding w3-container w3-green">
			<h1 class="w3-margin">account created successfully</h1>
			<button onclick="redirect1()" class="w3-button w3-padding w3-margin w3-hover-black w3-pink">Log into my account</button>';
		}
	}
	?>
</body>
</html>
<script type="text/javascript">
	function check()
	{
		var x=document.myform.pass1.value;
		var y=document.myform.pass2.value;
		if(x==y)
		{
			return true;
		}
		else
		{
			alert("Password must be same in both the fields");
			return false;
		}
	}
	function redirect1(){
	window.location = "index.php"
	}
	function redirect2(){
	window.location = "createaccount.php"
	}
</script>