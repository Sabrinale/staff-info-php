
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
        <a href="search.php">Hae henkilöt</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>
	<article>
	<?php
try {
	require_once "formPDO.php";
	
	$database = new formPDO();  // Luo yhteyden kantaan
	
	$result = $database->allForm(); // Haetaan kannasta kaikki rivit
	
	//print_r($tulos);
	
	foreach ($result as $form) {
		print("<p>Nimi: " . $form->getSurname());
		print("".$form->getFirstname());
		print("<br>Osoite: " . $form->getAddress());
		print("<br>Lisatieto: " . $form->getComment() . "</p>");
		?><a href ="list.php?id=<?php echo $database->getLkm()?>">delete</a>
		<?php
	}
	
	print("<p>Yhteensä " . $database->getLkm() . " henkilöä</p>");
	
} catch ( Exception $error ) {
	print("<p>Virhe: " . $error->getMessage ());
	header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage () );
	//exit ();
}

?>

  	</article>
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
</html>