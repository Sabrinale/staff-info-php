<?php
	 	if (isset($_POST["user"])) {
setcookie("user",$_POST['user'] , time() + (8600*365), "/");
if(!isset($_COOKIE["user"])) {
     echo "Cookie named is not set!";
} else {
     echo "Cookie  is set!<br>";
     echo  $_COOKIE["user"];
}
if(isset($_POST['submit'])){
header("Location: etusivu.php");
exit;
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Assignment 1</title>
<meta name="author" content="Le Thao 1605356">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="header">
<img src="logo.jpg" alt="Haaga Logo" height="200" width="350">
	<h1>Asetukset</h1>
</div>
    <div class="clear"></div>
	<nav>
		 <a href="etusivu.php" >Etusivu</a>
		<a href="index.php">Lisää hekilö</a>
        <a href="#">Henkilöt</a>
        <a href="setting.php" >Asetukset</a>
 
	</nav>

	 <form action = "setting.php" method = "post" >
	 	<label for ="username ">Nimesi: </label>
	 	<input type="text" name="user">
	 	<button onclick="location.href = 'etusivu.php';" name="submit" >Muuta nimeä</button>
	 	
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
