
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Assignment 2</title>
<meta name="author" content="Le Thao 1605356">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="header">
<img src="logo.jpg" alt="Haaga Logo" height="200" width="350">
	<h1>Lisää Henkilö</h1>
</div>
    <div class="clear"></div>
	<nav>
		 <a href="etusivu.php" >Etusivu</a>
		<a href="index.php">Lisää hekilö</a>
        <a href="confirmation.php" >Henkilöt</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>
	<h2> Tervetuloa <?php  	if (isset($_COOKIE["user"])) { 
						echo $_COOKIE["user"] ;
														}
					?>
		
	</h2>
	
	
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
</html>