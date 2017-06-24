<?php
require_once "form.php";

class formPDO {
	private $db;
	private $lkm;
	
	function __construct($dsn = "mysql:host=localhost;dbname=form", $user = "root", $password = "salainen") {
		// Ota yhteys kantaan
		$this->db = new PDO ( $dsn, $user, $password );
		
		// Virheiden jäljitys kehitysaikana
		$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		
		// MySQL injection estoon (paramerit sidotaan PHP:ssä ennen SQL-palvelimelle lähettämistä)
		$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		
		// Tulosrivien result road määrä
		$this->lkm = 0;
	}
	
	// Metodi palauttaa tulosrivien määrän
	function getLkm() {
		return $this->lkm;
	}
	
	public function allForm() {
		$sql = "SELECT id, firstname, surname, address, postcode, city, phone, salary, timeStart, comment FROM form";
		
		// Valmistellaan lause
		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();
			
			throw new PDOException ( $error [2], $error [1] );
		}
		
		// Ajetaan lauseke
		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();
			
			throw new PDOException ( $error [2], $error [1] );
		}
		
		// Käsittellään hakulausekkeen tulos
		$result = array ();
		
		// Pyydetään haun tuloksista kukin rivi kerrallaan
		while ( $row = $stmt->fetchObject () ) {
			// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
			$form = new Form ();
			
			$form->setId ( $row->id );
			$form->setFirstname ( utf8_encode ( $row->firstname ) );
			$form->setSurname ( utf8_encode ( $row->surname ) );
			$form->setAddress ( utf8_encode ( $row->address ) );
			$form->setPostcode ( $row->postcode );
			$form->setCity ( utf8_encode ( $row->city ) );
			$form->setPhone ( utf8_encode ( $row->phone ) );
			$form->setSalary ( utf8_encode ( $row->salary ) );
			$form->setTimeStart ( utf8_encode ( $row->timeStart ) );
			$form->setComment ( utf8_encode ( $row->comment ) );
			
			// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
			$result [] = $form;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $result;
	}
	
	public function searchForm($surname) {
		$sql = "SELECT id, firstname, surname, postcode, city, address, phone, salary, timeStart, comment
		        FROM form
				WHERE surname = :surname";
		
		// Valmistellaan lause, prepare on PDO-luokan metodeja
		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();
			throw new PDOException ( $error [2], $error [1] );
		}
		
		// Sidotaan parametrit
		$stmt->bindValue ( ":surname", $surname, PDO::PARAM_STR );
		
		// Ajetaan lauseke
		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();
			
			if ($error [0] == "HY093") {
				$error [2] = "Invalid parameter";
			}
			
			throw new PDOException ( $error [2], $error [1] );
		}
		
		// Käsittellään hakulausekkeen tulos
		$result = array ();
		
		while ( $row = $stmt->fetchObject () ) {
			// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
			$form = new Form ();
			
			$form->setId ( $row->id );
			$form->setfirstName ( utf8_encode ( $row->firstname ) );
			$form->setSurname ( utf8_encode ( $row->surname ) );
			$form->setAddress ( utf8_encode ( $row->address ) );
			$form->setPostcode ( $row->postcode );
			$form->setCity ( utf8_encode ( $row->city ) );
			$form->setPhone ( utf8_encode ( $row->phone ) );
			$form->setSalary ( utf8_encode ( $row->salary ) );
			$form->setTimeStart  ( $row->timeStart ) ;
			$form->setComment ( utf8_encode ( $row->comment ) );
			
			// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
			$result [] = $form;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $result;
	}
	
	function addForm($form) {
		$sql = "insert into form (surname, firstname, address, postcode, city, phone, salary, timeStart, comment)
		        values (:surname, :firstname, :address, :postcode, :city, :phone, :salary, :timeStart, :comment)";
		
		// Valmistellaan SQL-lause
		if (! $stmt = $this->db->prepare ( $sql )) {
			$error = $this->db->errorInfo ();
			throw new PDOException ( $error [2], $error [1] );
		}
		
		// Parametrien sidonta
		$stmt->bindValue ( ":firstname", utf8_decode ( $form->getFirstname() ), PDO::PARAM_STR );
		$stmt->bindValue ( ":surname", utf8_decode ( $form->getSurname () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":address", utf8_decode ( $form->getAddress () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":postcode", utf8_decode ( $form->getPostcode () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":city", utf8_decode ($form->getCity () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":phone", utf8_decode ( $form->getPhone () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":salary", utf8_decode ( $form->getSalary () ), PDO::PARAM_INT );
		$stmt->bindValue ( ":timeStart", utf8_decode ( $form->getTimeStart () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":comment", utf8_decode ( $form->getComment () ), PDO::PARAM_STR );
		// Jotta id:n saa lisäyksestä, täytyy laittaa tapahtumankäsittely päälle
		$this->db->beginTransaction();
		
		// Suoritetaan SQL-lause (insert)
		if (! $stmt->execute ()) {
			$error = $stmt->errorInfo ();
			
			if ($error [0] == "HY093") {
				$error [2] = "Invalid parameter";
			}
			 
			// Perutaan tapahtuma
			$this->db->rollBack();
			
			throw new PDOException ( $error [2], $error [1] );
		}
		
		$this->lkm = 1;
		
		// id täytyy ottaa talteen ennen tapahtuman päättymistä
		$id = $this->db->lastInsertId ();
		
		$this->db->commit();
		
		// Palautetaan lisätyn ilmoituksen id
		return $id;
	}
	
}
?>