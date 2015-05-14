<?php
$xml = new SimpleXMLElement('<xml/>');
//IMPORTANT: this document must start with the line above, otherwise: ERROR!

include '/pages/dbconnect.php'; 

/*that file (dbconnect) should have your database connection settings 
**or just create a database connection handle here.
**my database connection here is called "$conn"
**/

//print_r($conn); //for debugging


$stmt= $conn->query('Select * from dbtable'); 
//replace with your table name or custom query



while ($row=$stmt->fetch(PDO::FETCH_ASSOC )){
		$id=$row['id'];
		$territoireID = $row['territoireId'];
		$city=$row['city'];
		$zip=$row['zipCode'];
/**/my table had these columns: id, territoireID, city, ZIP....replace these with yours
**some programmer might create abstract script to pull your tables automagically. 
**This script is simple and clean
**/

		$territoire = $xml->addChild('Territoire'); //create an XML root object and expand on it
		
		$territoire->addChild('id',$id);
		$territoire->addChild('territoireId', $territoireID);
		$territoire->addChild('territoireId', $id);
		$territoire->addChild('city', $city);
		$territoire->addChild('zip', $zip);
		
/**If you want to add other Node add another block that starts with a new object from the XML handler as follow	
 * *according to your database table objects
 * */
// 		$user=$xml->addChild("User");
// 		$user->addChild('admin',Mike'); 
// 		$user->addChild('Age', 34);
// 		$user->addChild('Nationality','haitian');	
}


//generate XML file

Header('Content-type: text/xml');
print($xml->asXML());

