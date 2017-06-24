
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
        <a href="search.php" >Hea henkilöt</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>
	<article>
	<form action="search.php" method="post">
				
				<label>Search surname:   </label>
   <br/>
  <input type="text" name="search"  >
				
			</form>
			<br>
<?php
if (isset ( $_POST ["search"] )  != "") {
	try {
		require_once "formPDO.php";

		$database = new formPDO();
		$result = $database->searchForm($_POST ["search"]);
		
		foreach ($result as $form) {
			print("<p>Nimi: " . $form->getSurname());
			print("<br>Osoite: " . $form->getAddress());
			print("<br>Salary: " . $form->getSalary() . "</p>");
		}
		
		
	
	} catch ( Exception $error ) {
		//print("Virhe: " . $error->getMessage());
		header ( "location: virhe.php?virhe=" . $error->getMessage () );
		exit ();
	}
}
?>


  	</article>
	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>

</body>
</html>