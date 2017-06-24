
<?php
class Form  {
	
	
	private static $error = array (
			- 1 => "Virheellinen tieto",
			0 => "",
			111 => "Sukunimi on pakollinen  ",
			112 => "Sukunimi  on liian lyhyt  ",
			113 => "Sukunimi  on liian pitkä  ",
            114 => "Sukunimi  nimessa saa olla vain kirjaimia ja -  ",
            121 => "Etunimi on pakollinen  ",
			122 => "Etunimi on liian lyhyt",
			123 => "Etunimi on liian pitkä",
            124 => "Etunimi nimessa saa olla vain kirjaimia ja -",
			21 => "Anna  lähiosoite",
			22 => "Sukunimi  on liian lyhyt",
            23 => "Lähiosoite saa olla kirjaimia ja numeroita",
            24 => "Lähioisoite tarvitaa numero",
            31 => "Anna postinumero viidellä numerolla",
            32 => "Postinumero viidellä numerolla",
            41 => "Postitoimipaikka on pakollinen",
			42 => "Postitoimipaikakssa saa olla merkkit a-ä ja -", 
			52 => "Puhelimessa voi olla vain 10 numeroita",
			51 => "Puhelin on pakollinen",
			61 => "Anna kuukausipalkka",
			62 => "Palkka on liian suuri",
			63 => "Palkka on numero",
			71 => "Anna päivämäärä  muodossa vvvv-kk-pp (numeroilla)",
			72 => "Päivämäärä ei ole kelvolinen (päivämäärä  muodossa vvvv-kk-pp (numeroilla))",
			73 => "Päivämäärä muodossa vvvv-kk-pp (numeroilla)",
			81 => "Lisatieto on pakollinen"
			
			
    );
    private $firstname;
     private $surname;
	private $address;
	private $postcode;
	private $city;
    private $phone;
    private $salary;
    private $timeStart;
	private $comment;
	private $id;

function __construct ($firstname="", $surname="", $address="", $postcode ="", $city ="", $phone="", $salary ="", $timeStart ="", $comment ="", $id = 0){
    $this->firstname = $firstname;
     $this->surname = $surname;
     $this->address = $address;
     $this->postcode = $postcode;
     $this->city = $city;
     $this->phone = $phone;
     $this->salary = $salary;
     $this->timeStart = $timeStart;
	 $this->comment = $comment;
	 $this->id = $id;
}
public function setFirstname($firstname) {
		$this->firstname = trim ( $firstname );
	}
public function setSurname($surname) {
		$this->surname = trim ( $surname );
	}
public function setAddress($address) {
		$this->address = trim ( $address );
	}
public function setPostcode($postcode) {
		$this->postcode = trim ( $postcode );
	}
public function setCity($city) {
		$this->city = trim ( $city );
	}
public function setPhone($phone) {
		$this->phone = trim ( $phone );
	}
public function setSalary($salary) {
		$this->salary = trim ( $salary );
	}
public function setComment($comment) {
		$this->comment = trim ( $comment );
	}
public function setTimeStart($timeStart) {
		$this->timeStart = trim ( $timeStart );
	}
 public function getSurname() {
 		return $this->surname;
 	}
 

 public function getFirstname() {
 		return $this->firstname;
 	}
public function checkSurname(){
    
    	if  ($this->surname === "") {
			return 111;
		}
		if (strlen (  $this->surname ) < 2) {
			return 112;
		}
	
		if (strlen ( $this->surname ) > 20) {
			return 113;
		}
        if (preg_match ( "/[^a-zöåä \-]/i", $this->surname )) {
			return 114;
		}
			
		return 0;

}

public function checkFirstname(){
    
    if ($this->firstname === "") {
			return 121;
		}
			
		if (strlen ( $this->firstname ) < 2) {
			return 122;
		}
	
		if (strlen ( $this->firstname  ) > 20) {
			return 123;
		}
			
        if (preg_match ( "/[^a-zöåä \-]/i", $this->firstname )) {
			return 24;
		}
		
		return 0;

}
public function getAddress (){
	return $this->address ;
}
public function checkAddress (){
  if ($this->address === "") {
			return 21;
		}
			
		
		if (strlen ( $this->address ) < 2) {
			return 22;
		}
		
	return 0;

}
public function getPostcode() {
		return $this->postcode;
	}
	
	
	public function checkPostcode() {
		
		if ($this->postcode  === "") {
			return 31;
		}
			
			
		// Onko neljällä numerolla
		if (! preg_match ( "/^\d{5}$/", $this->postcode )) {
			return 32;
		}
		
		return 0;
	}
	public function getCity() {
 		return $this->city;
 	}
public function checkCity(){
    if ($this->city  === "") {
			return 41;
		}
        if (preg_match ( "/[^a-zöåä \-]/i", $this->city )) {
			return 42;
		}
		return 0;

}
public function getPhone() {
		return $this->phone;
	}
	
	
	public function checkPhone() {
	
		if ($this->phone  === "") {
			return 51;
		}
		if (! preg_match ( "/^\d{10}$/", $this->phone )) {
			return 52;
		}
		
		return 0;
	}
public function getSalary() {
		return $this->salary;
	}
public function checkSalary() {
	
		if ($this->salary  === "") {
			return 61;
		}
		if (preg_match ( "/^[0-9\-.,!?]$/i", $this->salary)) {
			return 63;
		}	
		
		if ( $this->salary > 100000 ) {
			return 62;
		}
		return 0;
	}
	
		public function getTimeStart() {
		
		return $this->timeStart;
	}
		public function checkTimeStart() {
		
		
		if  (empty($this->timeStart)) {
			return 71;
		}
			
			$datetime =  $this->timeStart;
			if (date('Y-m-d', strtotime($datetime)) !== $datetime){
				return 72;
			}
			
		
		
		return 0;
	}
	
	public function getComment() {
		return $this->comment;
	}
	
	public function checkComment() {
		if  ($this->comment  === "") {
			return 81;
		}
			
		
		
		return 0;
	}

	public function setId($id) {
		$this->id = trim ( $id );
	}

	public function getId() {
		return $this->id;
	}
	

public static function getError($virhekoodi) {
		if (isset ( self::$error [$virhekoodi] ))
			return self::$error [$virhekoodi];
		
		return self::$error [- 1];
	}
}
	

	


?>

