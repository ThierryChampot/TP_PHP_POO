<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" lang="fr">
	<title>TP de PHP objet - Thierry Champot</title>
</head>
<body>

<?php 
include_once 'TableauxValeurs.php';
include_once 'FonctionsAleatoires.php';

class Personne
{
	protected $nom;
	protected $prenom;
	protected $adresse;
	protected $age;
	static protected $id=0;
	public function __construct($Nom,$Prenom,$Adresse,$Age){
		$this->__set("nom",$Nom);
		$this->__set("prenom",$Prenom);
		$this->__set("adresse",$Adresse);
		$this->__set("age",$Age);
		$this->id = self::$id ++;
	}
	public function __set($Prop,$Val){
		$this->$Prop = $Val;
	}
	public function __get($Prop){
		return $this->$Prop;
	}
	public function __toString(){
		return 
		"Nom : ".$this->nom.",<br>".
		"Prénom : ".$this->prenom.",<br>".
		"Adresse : ".$this->adresse.",<br>".
		"Age : ".$this->age."<br>".
		"Id : ".$this->id."<br>";	
	}
}
class Etudiant extends Personne
{
	private $_uFRInscription;
	private $_ville;
	private $_coursSuivis;

	public function __construct(Personne $Pers,$uFRInscription,$ville){
		parent::__construct(
			$Pers->__get("nom"),
			$Pers->__get("prenom"),
			$Pers->__get("adresse"),
			$Pers->__get("age")
			);
		$this->__set("_uFRInscription",$uFRInscription); //
		$this->__set("_ville",$ville); //
		$this->_coursSuivis=[];
	}
	public function __set($Prop,$Val){
		$this->$Prop = $Val;
	}
	public function __get($Prop){
		return $this->$Prop;
	}
	public function __toString(){
		return 
			"Nom : ".$this->nom.",<br>".
			"Prénom : ".$this->prenom.",<br>".
			"Adresse : ".$this->adresse.",<br>".
			"Age : ".$this->age.",<br>".
			"est incrit à l'UFR de : ".$this->_uFRInscription.",<br>".
			"de la ville de ".$this->_ville.",<br>".
			"et porte l'ID n°".$this->_id.".<br>"
	//	" et suit les cours suivants :".$this->_coursSuivis
		;
	}
}

class Professeur extends Personne
{
	private $_salaire;
	private $_uFRInscription;
	private $_ville;
	private $_coursDonnes;

	public function __construct(Personne $Pers,$Salaire,$uFRInscription,$ville){
		parent::__construct(
			$Pers->__get("nom"),
			$Pers->__get("prenom"),
			$Pers->__get("adresse"),
			$Pers->__get("age")
			);
		$this->__set("_salaire",$Salaire);
		$this->__set("_uFRInscription",$uFRInscription);
		$this->__set("_ville",$ville);
		$this->_coursDonnes = [];
	}
	public function __set($Prop,$Val){
		$this->$Prop = $Val;
	}
	public function __get($Prop){
		return $this->$Prop;
	}
	public function __toString(){
		return 
		"Nom : ".$this->nom.",<br>".
		"Prénom : ".$this->prenom.",<br>".
		"Adresse : ".$this->adresse.",<br>".
		"Age : ".$this->age.".<br>".
		"perçoit un salaire de : ".$this->_salaire.",<br>".
		"pour enseigner à l'UFR de : ".$this->_uFRInscription.",<br>".
		"de la ville de ".$this->_ville.",<br>".
		"et porte l'ID n°".$this->id
		;
	}
}
class Cours
{
	private $_theme;
	private $_uFR;
	private $_Professeur;
	private $_listeEtudiants = array();

	public function __construct($Theme,$UFR,$professeur,$ListeEtudiants){
		$this->__set("_theme",$Theme);
		$this->__set("_uFR",$UFR);
		$this->__set("_Professeur",$professeur);
		$this->__set("_Professeur",$professeur);
		$this->__set("_listeEtudiants",$ListeEtudiants);
	}
	public function __set($Prop,$Val){
		$this->$Prop = $Val;
	}
	public function __get($Prop){
		return $this->$Prop;
	}
	public function __toString(){
		return "Thème : ".$this->theme.", Prénom : ".$this->uFR.".<br>";	
	}
}

echo "création de 20 personnes : <br>";
	for ($i=1; $i <= 20; $i++) { 
								$personne[$i] = new Personne(
								// nom aléatoire dans la liste
								valTabSimpleAlea($tabNoms)." ",
								// prénom aléatoir dans la liste
								valTabSimpleAlea($tabPrenoms)." ",
								// adresse aléatoire par concaténation de n°.type voie.nom rue.ville.code postal possible
								rand(1,200)." ".valTabSimpleAlea($tabTypeVoies)." ".valTabSimpleAlea($tabNomsVoies),
								rand(20,40)
								);
	}

echo"Création de 10 étudiants : <br>";
	for ($i=1; $i <= 10; $i++) { 
		$etudiant[$i] = new Etudiant(
									$personne[$i],
									$tabUniversites["DSP"], // UFR en full texte
									$tabCodesVillesUFR["NTE"] // ville
									); 
	}
echo"Création de 10 professeurs : <br>";

	for ($i=11; $i <= 20; $i++) { 
		$professeur[$i] = new Professeur(
										$personne[$i],
										rand(2500,3500)." €",  // générateur de salaire
										$tabUniversites["DSP"], // nom complet d'UFR
										$tabCodesVillesUFR["NTE"] //ville
			);
	} 

echo "Création d'un cours : <br>";
	$cours[] = 
	new Cours(
		valTabSimpleAlea(
			$tabCoursUFR["DSP"]),
			$tabUniversites["DSP"],
			$professeur[rand(11,20)],
			$etudiant
			);

	var_dump($etudiant);
	var_dump($professeur);
	var_dump($cours);
?>
</body>
</html>