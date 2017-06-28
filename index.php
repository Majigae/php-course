<?php

session_start();
if (count ($_GET) == 1) {
	if (!isset($_SESSION[$key=key($_GET)])) {
		$_SESSION[$key]=0;
	}

	setcookie($key,++$_SESSION[$key], time()+600*1);
};


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP-Course</title>
	<style>
		body {background-color: lightgrey; font-family: 'Calibri', sans-serif; overflow-y: scroll;}
		aside {background-color: white; width: 300px; height: 100%; margin: 0; position: fixed; top: 0; left: 0; padding: 70px 0 0 0 ;}
		aside li {list-style-type: none; padding: 0 0 15px 10px; font-size: 120%;}
		a { color: black;}
		section {margin: 5% 0 5% 35%;}
		h1 {font-size: 180%; color: midnightblue;}
		table, td, th {border: 1px solid black; }
		td, th {padding: 10px; text-align: center;}
		span, .leer {color: red;}
		img {height: 32px; width: 32px;}
		.auswahl {background-image: url("shopping-cart.png"); background-size: 80%; background-position: center; background-repeat: no-repeat; height: 32px; width: 32px; }
		.highlight {font-size: 110%; background-color: moccasin;}

	</style>
</head>
<body>
	<aside>
		<ul>
			<li><a href="aufgabe1.php">Aufgabe 1</a></li>
			<li><a href="aufgabe2.php">Aufgabe 2</a></li>
			<li><a href="aufgabe3.php">Aufgabe 3</a></li>
			<li><a href="aufgabe4.php">Aufgabe 4</a></li>
		</ul>
	</aside>
	<section>
