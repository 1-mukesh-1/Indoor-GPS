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
<body>
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
<div style="display: none" class="w3-left tot">
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
<form action="refreshpage.php" method="POST">
	<button type="submit" class="w3-button w3-green w3-right w3-xxlarge">Refresh the Database</button>
</form>
<?php
$str=$_POST['sub'];
echo '<p style="display: none" id="get">'.$str.'</p>';
echo '<button style="position: absolute;top:30px;" class="w3-button w3-center w3-green" onclick="fix()">get map</button>';
?>

</body>
</html>
<script>

var position="38,18";
var i;
var loc=document.getElementById('get').innerHTML;
var lat=new Array();
var lon=new Array();
function fix()
{
	var row=loc.split("-");
	var rowx=row[0].split(" ");
	var rowy=row[1].split(" ");
	var len1=rowx.length;
	var len2=rowy.length;
	for(i=0;i<len1;i++)
	{
		lat.push(parseInt(rowx[i]));
	}
	for(i=0;i<len1;i++)
	{
		lon.push(parseInt(rowy[i]));
	}
	for(i=3;i<len1;i++)
	{
		move(lat[i-1],lon[i-1],lat[i],lon[i]);
	}
}
function move(x1,y1,x2,y2)
{
	var width=x2-x1;
	var height=y2-y1;
	var ang=height/width;
	if(ang>-0.577 && ang<0.577 && width>0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x+1;
		var y=parseInt(arr[1],10);
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>0.577 && ang<1.732 && width>0 && height>0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x+1;
		var y=parseInt(arr[1],10);
		y=y+1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>1.732 && ang<-1.732 && height>0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		var y=parseInt(arr[1],10);
		y=y+1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>-1.732 && ang<-0.577 && width<0 && height>0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x-1;
		var y=parseInt(arr[1],10);
		y=y+1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>-0.577 && ang<0.577 && width<0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x-1;
		var y=parseInt(arr[1],10);
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>0.577 && ang<1.732 && width<0 && height<0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x-1;
		var y=parseInt(arr[1],10);
		y=y-1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else if(ang>1.732 && ang<-1.732 && height<0)
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		var y=parseInt(arr[1],10);
		y=y-1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}
	else
	{
		var arr=position.split(",");
		var x=parseInt(arr[0],10);
		x=x+1;
		var y=parseInt(arr[1],10);
		y=y-1;
		position=x+","+y;
		document.getElementById(position).classList.remove('w3-metro-light-blue');
		document.getElementById(position).classList.add('w3-red');
	}

}
</script>
