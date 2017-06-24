<?php
require "form.php";
session_start();
if (isset($_POST["save"])){
    $form= new Form( $_POST ["surname"],$_POST ["firstname"],$_POST ["address"],$_POST ["postcode"],$_POST ["city"],$_POST ["phone"],$_POST ["salary"],$_POST ["timeStart"],$_POST ["comment"]);
    
    $_SESSION["confirmation"] = $form;
    session_write_close();
    
    $surnameError = $form->checkSurname();
    $firstnameError = $form->checkFirstname();
    $addressError = $form->checkAddress();
    $postcodeError = $form->checkPostcode();
    $cityError = $form->checkCity();
    $phoneError = $form->checkPhone();
    $salaryError = $form->checkSalary();
    $timeStartError = $form->checkTimeStart();
    $commentError = $form->checkComment();

    if ($surnameError == 0 && $firstnameError == 0 &&  $addressError == 0 && $postcodeError == 0 && $cityError == 0 && $phoneError == 0 && $salaryError == 0 && $timeStartError == 0 && $commentError  == 0 ) {
   try {
      require_once "formPDO.php";
    
      $database = new formPDO();  // Luo yhteyden kantaan
      $id = $database->addForm($form);
      $form->setId($id);
      $_SESSION["confirmation"]->setId($id);
    
    } catch ( Exception $error ) {
      //print("<p>Virhe: " . $error->getMessage ());
      header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage() );
      exit ;
    }
    session_write_close();
    header("location: confirmation.php");
    exit;
  }
}
elseif (isset($_POST["cancel"])){
    unset($_SESSION["confirmation"]);
    header ("location: index.php");
    

    exit("Sorry, please try again");
}
else{
    if(isset($_SESSION["confirmation"])) {
    $form = $_SESSION["confirmation"];
    $surnameError = $form->checkSurname();
    $firstnameError = $form->checkFirstname();
    $addressError = $form->checkAddress();
    $postcodeError = $form->checkPostcode();
    $cityError = $form->checkCity();
    $phoneError = $form->checkPhone();
    $salaryError = $form->checkSalary();
    $timeStartError = $form->checkTimeStart();
    $commentError = $form->checkComment();
    }
    else {
   $form= new Form();
   $surnameError = 0; 
   $firstnameError = 0; 
   $addressError = 0;
   $postcodeError = 0;
   $cityError = 0;
   $phoneError = 0;
   $salaryError = 0;
   $timeStartError = 0;
   $commentError = 0;
    }

}
//print_r($form);
?>
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
    <div class="fixed-width">
	<nav>
		 <a href="etusivu.php">Etusivu</a>
		<a href="index.php" >Lisää henkilöt</a>
        <a href="confirmation.php" >Henkilöt</a>
        <a href="search.php" >Hae henkilö (JSON)</a>
        <a href="setting.php">Asetukset</a>
 
	</nav>

	<article>
        <form action="index.php" method="post">
      <div class="myClass">  
            <label>Suku-ja etunimi:   </label>
   
  <input type="text" name="surname" value="<?php print(htmlentities($form->getFirstname(), ENT_QUOTES, "UTF-8"));?>">
        <input type="text" name="firstname" value="<?php print(htmlentities($form->getSurname(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $surnameError ) . "</span>") ;
print ("<span class='pun'>" . $form->getError ( $firstnameError ) . "</span>") ;
?> 
  <br><br>
            <label>Lähiosoite:       </label>
     
  <input type="text" name="address" value="<?php print(htmlentities($form->getAddress(), ENT_QUOTES, "UTF-8"));?>">
        <?php
print ("<span class='pun'>" . $form->getError ( $addressError ) . "</span>") ;?>
  <br><br>
            <label>Postinumero:      </label>
  
  <input type="text" name="postcode" value ="<?php print(htmlentities($form->getPostcode(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $postcodeError ) . "</span>") ;?>
  <br><br>
            <label>Postitoimipaikka:</label>
   
  <input type="text" name="city" value ="<?php print(htmlentities($form->getCity(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $cityError ) . "</span>") ;?>
  <br><br>
            <label>Puhelin:         </label>
   <input type="text" name="phone" value ="<?php print(htmlentities($form->getPhone(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $phoneError ) . "</span>") ;?>
  <br><br>
            <label>Palkka:          </label>
   <input type="text" name="salary" value ="<?php print(htmlentities($form->getSalary(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $salaryError ) . "</span>") ;?>
  <br><br>
            <label>Työsuhteen alku: </label>

<input type="text" name="timeStart" value ="<?php print(htmlentities($form->getTimeStart(), ENT_QUOTES, "UTF-8"));?>">
<?php
print ("<span class='pun'>" . $form->getError ( $timeStartError ) . "</span>") ;?>
  <br><br>
            <label>Lisätieto:       </label>
  <textarea name="comment" rows="5" cols="40" ><?php print(htmlentities($form->getComment(), ENT_QUOTES, "UTF-8"));?></textarea>
<?php
print ("<span class='pun'>" . $form->getError ( $commentError ) . "</span>") ;?>
  <br><br>
  <input type="submit" name="save" value="Save"> 
  <input type="submit" name="cancel" value="Cancel"> 
  </div>
</form>
		
	</article>

	<footer>
		Thao Le 1605356<br> Web-ohjelmointi
	</footer>
</div>
</body>
</html>

