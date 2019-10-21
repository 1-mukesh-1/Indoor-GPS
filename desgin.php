<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
<style>
</style>
</head>
<body onload="javascript:find()">
<?php
echo '<div>';
for ($i=0; $i <= 36; $i++) { 
	for($j=0;$j<=75;$j++)
	{
		$x=$j*20;
		$y=$i*20;
		$co=$j.",".$i;
		echo '<div id="'.$co.'" style="height:20px;width:20px;position:absolute;top:'.$y.'px;left:'.$x.'px" class="w3-metro-light-blue"></div>';
	}
	echo '<br>';
}
echo '</div>';
?>
<p id="demo" class="w3-display-topmiddle"></p>
<div class="w3-left tot" onclick="showCoords(event)">
	<div style="width: 600px;height: 110px;position: absolute;top: 0px;left: 0px" class="w3-grey"></div>
	<div style="width: 610px;height: 110px;position: absolute;top: 0px;left: 920px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 220px;left: 0px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 420px;left: 0px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 220px;left: 1420px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 420px;left: 1420px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 110px;left:0px" class="w3-grey"></div>
	<div style="width: 1530px;height: 110px;position: absolute;top: 640px;left:0px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 530px;left:0px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 110px;left: 1420px" class="w3-grey"></div>
	<div style="width: 110px;height: 110px;position: absolute;top: 530px;left: 1420px" class="w3-grey"></div>
	<div style="width: 296px;height: 310px;position: absolute;top: 220px;left: 220px;opacity: 0.7;" class="w3-light-green"></div>
	<div style="width: 296px;height: 310px;position: absolute;top: 220px;left: 616px;opacity: 0.7;;" class="w3-light-green"></div>
	<div style="width: 296px;height: 310px;position: absolute;top: 220px;left: 1012px;opacity: 0.7;" class="w3-light-green"></div>
	<div style="width: 20px;height: 20px;position: absolute;top: 365px;left: 70px;border-radius: 50%" class="w3-red">A</div>
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
		$q='select * from coordinates where trans=1';
		$p=$pd->query($q);
		$i=0;
		$id=array(0);
		$latd=array(0);
		$longd=array(0);
		while($row=$p->fetch())
		{
			array_push($id, $row[1]);
			array_push($latd, $row[3]*100000000000000);
			array_push($longd, $row[5]*100000000000000);
			$i=$i+1;
		}
		echo '<br><br>';
		$lat_final=array_unique($latd);
		$long_final=array_unique($longd);
	}
	$len1=count($lat_final);
	$len2=count($long_final);
	$post_string="0";
	for($i=0;$i<$len1;$i++)
	{
		$post_string=$post_string." ".$lat_final[$i];
	}
	$post_string=$post_string."-0";
	for($i=0;$i<$len2;$i++)
	{
		$post_string=$post_string." ".$long_final[$i];
	}
	echo '<form action="newdesgin.php" method="POST" name="myform">
	<button type="submit" value="'.$post_string.'" name="sub">Get desgin</button>
	</form>
	';
?>
</body>
</html>
