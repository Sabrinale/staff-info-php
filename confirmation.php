<?php
require "form.php";

session_start();

if (isset($_SESSION["confirmation"])) {
	$form = $_SESSION["confirmation"];
}
else {
	header("location: etusivu.php");
	exit;
}
?>

?>
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<title>Assignment 1</title>
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
	<h1 class="thick">Vahvistus</h1>
</div>
    <div class="clear"></div>
	<nav>
		 <a href="etusivu.php">Etusivu</a>
		<a href="index.php">Lisää hekilö</a>
        <a href="list.php" >Henkilöt</a>
        <a href="search.php" >Hae Henkilöt</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>
	<article>
	<h3>Annoit seuraavat tiedot</h3>
	
		
	     
		<?php 
			print("<p>Nimi: " . $form->getFirstName());
			print("<br>Puhelinnumero " .$form->getSurName()) ;
			print("<br>Osoite: " . $form->getAddress());
			print("<br>Puhelinnumero: " . $form->getPhone());	
			print("<br>Työnhön tulopäivä " . $form->getTimeStart());
			print("<br>Palkka: " . $form->getSalary());
			print("<br>Lisätieto: " . $form->getComment() . "</p>");
			?>
			<form action="index.php">
    			<input type="submit" value="Korjaa" class ="inline" >
    		</form>
			
			<form action ="list.php">
  			<input type="submit" name="save"  value="Tallenta"   >
  			</form>

  			<form action="etusivu.php">
    		<input type="submit" value="Peruuta" />
			</form>

  	</article>
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
</html>