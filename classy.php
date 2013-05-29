<?php

require_once("admin/constants.php");
$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);

if(isset($_GET['fields'])) {
	$rows = array(); // allows the addition of rows later
	$fields = explode("_",($_GET['fields'])); // stores fields
	foreach($fields as $field) {
		//gets the row for each field
		$query = $db->prepare("SELECT * FROM classyFields WHERE name = ?");
		$query->execute(array($field));
		$row = $query->fetch(PDO::FETCH_BOTH);
		if($row) {
			$rows[] = $row;
		} else {
			$rows[] = array(0,' ','','',' ','','');
		}
	}
	//$rows must be list of lists so that the loop will work
	echo xmlOut($rows);
} else {
	echo 'Invalid';
}

function xmlOut($rows) {
		//taken from http://www.tonymarston.co.uk/php-mysql/dom.html
		// create a new XML document
		$doc = new DomDocument('1.0');
		// create root node
		$root = $doc->createElement('root');
		$root = $doc->appendChild($root);
		// process one row of sql request at a time
	  	// add node for each row
	  	$occ = $doc->createElement("FIELD");
	  	$occ = $root->appendChild($occ);
	 	// add a child node for each field
		foreach($rows as $row) {
			$child = $doc->createElement('Name');
			$child = $occ->appendChild($child);
			$value = $doc->createTextNode($row['name']);
			$value = $child->appendChild($value);
			
			$child = $doc->createElement('Content');
			$child = $occ->appendChild($child);
			$value = $doc->createTextNode($row['content']);
			$value = $child->appendChild($value);
		}
		// get completed xml document
		$xml_string = $doc->saveXML();
		return $xml_string;
		/*Output
		<?xml version="1.0"?>
		<cms>
		  <FIELD>
			<Name>value1</Name>
			<Content>value2</Content>
		  </FIELD>
		</cms>' */
	}