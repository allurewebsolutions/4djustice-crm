<?php

// We will be using this class to define each selectbox

class SelectBox{
	public $items = array();
	public $defaultText = '';
	public $title = '';
	
	public function __construct($title, $default){
		$this->defaultText = $default;
		$this->title = $title;
	}
	
	public function addItem($name, $connection = NULL){
		$this->items[$name] = $connection;
		return $this; 
	}
	
	public function toJSON(){
		return json_encode($this);
	}
}


/* Configuring the selectboxes */

// Practice Area selectbox

$practiceareaSelect = new SelectBox('What is the Practice Area?','Choose a Practice Area');
$practiceareaSelect->addItem('Criminal','criminalSelect')
			       ->addItem('Personal Injury','piSelect');

// Criminal Sub Practicea Area types

$criminalSelect = new SelectBox('What is the Sub Practice Area?','Choose a Sub Practice Area');
$criminalSelect ->addItem('Aiding & Abetting')
				->addItem('Arson')
				->addItem('Assault / Battery')
				->addItem('Bribery')
				->addItem('Burglary')
				->addItem('Child Abuse')
				->addItem('Child Pornography')
				->addItem('Computer Crime')
				->addItem('Conspiracy')
				->addItem('Credit Card Fraud')
				->addItem('Disorderly Conduct')
				->addItem('Domestic Violence')
				->addItem('Drug Cultivation & Manufacturing')
				->addItem('Drug Distribution / Trafficking')
				->addItem('Drug Possession')
				->addItem('DUI / DWI')
				->addItem('Embezzlement')
				->addItem('Extortion')
				->addItem('Forgery')
				->addItem('Hate Crimes')
				->addItem('Hit and run')
				->addItem('Identity Theft')
				->addItem('Indecent Exposure')
				->addItem('Insurance Fraud')
				->addItem('Internet crimes')
				->addItem('Juvenile crimes')
				->addItem('Kidnapping')
				->addItem('Manslaughter: Involuntary')
				->addItem('Manslaughter: Voluntary')
				->addItem('MIP: A Minor in Possession')
				->addItem('Money Laundering')
				->addItem('Murder: First-degree')
				->addItem('Murder: Second-degree')
				->addItem('Open Container Law')
				->addItem('Perjury')
				->addItem('Prostitution')
				->addItem('Public Intoxication')
				->addItem('Pyramid Schemes')
				->addItem('Racketeering / RICO')
				->addItem('Rape')
				->addItem('Restraining Order Violations')
				->addItem('Robbery')
				->addItem('Securities Fraud')
				->addItem('Sex crimes')
				->addItem('Sexual Assault')
				->addItem('Stalking')
				->addItem('Tax Evasion / Fraud')
				->addItem('Telemarketing Fraud')
				->addItem('Theft / Larceny')
				->addItem('Wire Fraud  Federal Crimes');
			   

// Personal Injury Sub Practicea Area types

$piSelect = new SelectBox('What is the Sub Practice Area?','Choose a Sub Practice Area');
$piSelect->addItem('Wrongful Death')
	     ->addItem('Montorcycle Accident');

// Register all the select items in an array

$selects = array(
	'practiceareaSelect'			=> $practiceareaSelect,
	'criminalSelect'			=> $criminalSelect,
	'piSelect'		=> $piSelect
);

// We look up this array and return a select object depending
// on the $_GET['key'] parameter passed by jQuery

// You can modify it to select results from a database instead

if(array_key_exists($_GET['key'],$selects)){
	header('Content-type: application/json');
	echo $selects[$_GET['key']]->toJSON();
}
else{
	header("HTTP/1.0 404 Not Found");
	header('Status: 404 Not Found');
}

?>