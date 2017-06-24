<?php
session_start ();

// Poistetaan istunnosta ilmoitus
unset ( $_SESSION ["ilmoitus"] );

?>
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<title>Assignment 2</title>
<meta name="author" content="Le Thao 1605356">
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<style>
input {
	margin: 0;
	padding: 0;
 float: left;
  
}
  
</style>
<body>
    <div id="header">
<img src="logo.jpg" alt="Haaga Logo" height="200" width="350">
	<h1 class="thick">List</h1>
</div>
    <div class="clear"></div>
	<nav>
		 <a href="etusivu.php">Etusivu</a>
		<a href="index.php">Lisää hekilö</a>
        <a href="list.php" >Henkilöt</a>
        <a href="search.php" >Hae henkilöt</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>
	<article>
	

  	</article>
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
</html>