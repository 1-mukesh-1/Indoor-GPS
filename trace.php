<?php
if(isset($_POST['sub']))
{
	$count=0;
	$time=0;
	$coords=$_POST['sub'];
	$coord=explode(",",$coords);
	$lati=(int)$coord[0];
	$latd=(double)$coord[0]-$lati;
	$longi=(int)$coord[1];
	$longd=(double)$coord[1]-$longi;
	$change=0;
	$pd=new PDO('mysql:host=localhost;dbname=hack','root','');
	$q='select * from temp';
	$p=$pd->query($q);
	while ($row=$p->fetch()){
		if($row[0]>$count)
		{
			$count=$row[0];
		}
		else{
			$time=0;
		}
	}
	if($count==0)
	{
	$count=$count+1;
	$p=$pd->prepare('update temp set id=?,lati=?,latd=?,longi=?,longd=?');
	$p->bindparam(1,$count);
	$p->bindparam(2,$lati);
	$p->bindparam(3,$latd);
	$p->bindparam(4,$longi);
	$p->bindparam(5,$longd);
	$p->execute();
	}
	else{
	$count=$count+1;
	$p=$pd->prepare('insert into temp values(?,?,?,?,?,?)');
	$p->bindparam(1,$count);
	$p->bindparam(2,$lati);
	$p->bindparam(3,$latd);
	$p->bindparam(4,$longi);
	$p->bindparam(5,$longd);
	$p->bindparam(6,$time);
	$p->execute();
	}
	echo "<h1 class='w3-container w3-black w3-center w3-margin w3-padding'>Timer : ".$count."</h1>";
}
?>
<html>
<head>
	<title>Tracing..</title>
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
		</style>
</head>
<body onLoad="javascript:getLocation()">
<div class="w3-container w3-green w3-margin w3-padding w3-center">
<h1>My current Co-ordinates</h1>
<h1 id="demo"></h1>	
</div>
<p id="coord"></p>
<form action="trace.php" method="POST" name="myform">
	<button name="sub" id="sub" value="abc" style="display: none">submit</button>
</form>
<button onclick="redirect()" class="w3-button w3-green w3-margin w3-padding">Terminate the process</button>
</body>
</html>
<script>
var x = document.getElementById("demo");
var lat=0;
var long=0;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  }
  else{
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  lat=position.coords.latitude;
  long=position.coords.longitude;
  document.getElementById("sub").value=lat+","+long;
  sub();
}
function sub()
{
	setTimeout(function(){document.myform.sub.click();},1000);
}
function redirect()
{
	window.location="stop.php";
}
</script>
