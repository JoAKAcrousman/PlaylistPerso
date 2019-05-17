<?php
//header("Content-Type: application/json; charset=UTF-8");

// check HTTP method
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method !== 'post') {
	http_response_code(405);
	echo json_encode(array('message' => 'This method is not allowed.'));
	exit();
}

// include data
require_once "../data/MyPDO.elisaciaks9.include.php";

// response status
http_response_code(200);


$input = file_get_contents('php://input');
//echo $input;

if (!isset($input) || empty($input)) {
	echo json_encode(array("error" => "Missing params ".$input));
	http_response_code(422);
}
else {
	$json_obj = json_decode($input,true);
	//echo $json_obj;

	if(!isset($json_obj['nom_playlist']))
	{
		echo json_encode(array("error" => "Missing name of the playlist"));
		exit();
	}


/////////////PARCOURIR LE TABLEAU DES ID TITRE//////////////
//tableau de valeurs donc voir comment l'entrer dans la BDD
if(!isset($json_obj['id']))
{
	echo json_encode(array("error" => "Missing the id title"));
	exit();
}
else{
	foreach($json_obj as $key1 => $valeur1)
	{
		foreach ($json_obj as $key2=>$valeur2)
		{  
			if(is_array($valeur2))
			{
			    //la fonction count permet de récupérer la taille de mon tableau
				$taille_max = count($valeur2);
				for ($i=0; $i <$taille_max ; $i++)
				{ 
				   	//echo $valeur2[$i];
				}
			}
		}
	}
}
	
	//$serialize = serialize($json_obj['id']);
	//var_dump($serialize);
	//$id_titre = $serialize;

	//prb ici parce que le tableau est converti en string
	$id_titre_list = $json_obj['id'];
	$nom_playlist = $json_obj['nom_playlist'];

//echo "$id_titre";

// foreach($id_titre as $value){
//     echo $value . "<br>";
// }


////////////////////////////////////////
////////Création de la playlist/////////
////////////////////////////////////////
	$stmt = MyPDO::getInstance()->prepare(<<<SQL
	INSERT INTO Playlist(nom_playlist)
	VALUES (:nom_playlist)
SQL
);

	$stmt->bindParam(':nom_playlist', $nom_playlist);
	$stmt->execute();

	//retourne l'identifiant de la derniere valeur insérée
	$id_playlist = MyPDO::getInstance()->lastInsertId();

	$resp = array("id_playlist" => $id_playlist, "nom_playlist" => $nom_playlist);
	//echo json_encode($resp);
////////////////////////////////////////
////////////////////////////////////////
////////////////////////////////////////


////////////////////////////////////////
//Lien entre les titres et la playlist//
////////////////////////////////////////

foreach($id_titre_list as $value){

$id_titre = (int)$value;

echo $id_titre . "<br>";
    $stmt2 = MyPDO::getInstance()->prepare(<<<SQL
        INSERT INTO link_titre_playlist(id_titre, id_playlist)
		VALUES (:id_titre, :id_playlist)
SQL
    );

    $stmt2->execute(array("id_titre" => $id_titre, "id_playlist" => $id_playlist));
    
}
	 exit();



// 	$stmt = MyPDO::getInstance()->prepare(<<<SQL
// 	INSERT INTO link_titre_playlist(id_titre, id_playlist)
// 	VALUES (:id_titre, :id_playlist)
// SQL
// );
	
// 	$stmt->bindParam(':id_titre', $id_titre);
// 	$stmt->bindParam(':id_playlist', $id_playlist);
// 	$stmt->execute();

// 	$resp2 = array("id_titre" => $id_titre, "id_playlist" => $id_playlist);
// 	//echo json_encode($resp2);
// 	exit();

////////////////////////////////////////
////////////////////////////////////////
////////////////////////////////////////
}

?>
