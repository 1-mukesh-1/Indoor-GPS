<?php
	$pd=new PDO('mysql:host=localhost;dbname=hack','root','');
	$p=$pd->prepare('delete from coordinates where 1');
	$p->execute();
	$p=$pd->prepare('update trans set number=1');
	$p->execute();
	header('Location: main.php');
?>