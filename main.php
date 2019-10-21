<!DOCTYPE html>
<html>
<head>
	<title>Start tracing</title>
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
<body class="w3-padding">
	<div>
		<h1 class="w3-button w3-margin w3-padding w3-xxxlarge w3-display-middle w3-green" onclick="redirect()">Start tracing my path</h1>
	</div>
	<?php
	if(isset($_POST['sub']))
	{
		$pd=new PDO('mysql:host=localhost;dbname=hack','root','');
		$q='select number from trans';
		$p=$pd->query($q);
		$row=$p->fetch();
		$trans=$row[0];
			$q='select * from temp order by id asc';
			$p=$pd->query($q);
			while($row=$p->fetch())
			{
				$user="admin";
				$id=$row[0];
				$lati=$row[1];
				$latd=$row[2];
				$longi=$row[3];
				$longd=$row[4];
				$time=2;
				$t=$pd->prepare('insert into coordinates values(?,?,?,?,?,?,?,?)');
				$t->bindparam(1,$user);
				$t->bindparam(2,$id);
				$t->bindparam(3,$lati);
				$t->bindparam(4,$latd);
				$t->bindparam(5,$longi);
				$t->bindparam(6,$longd);
				$t->bindparam(7,$time);
				$t->bindparam(8,$trans);
				$t->execute();
			}
		$p=$pd->prepare("delete from temp where id>1");
		$p->execute();
		$p=$pd->prepare("update temp set id=0,lati=0,latd=0,longi=0,longd=0,time=0");
		$p->execute();
		$p=$pd->prepare('update trans set number=?');
		$trans=$trans+1;
		$p->bindparam(1,$trans);
		$p->execute();
	}
	?>
</body>
</html>
<script type="text/javascript">
	function redirect()
	{
		window.location="trace.php";
	}
</script>