<?php
header("Content-Type: application/json; charset=UTF-8");

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

if (!isset($input) || empty($input)) 
{
	echo json_encode(array("error" => "Missing params ".$input));
	http_response_code(422);
}
else 
{
	$json_obj = json_decode($input,true);

	if(!isset($json_obj['nom_playlist']))
	{
		echo json_encode(array("error" => "Missing name of the playlist"));
		exit();
	}


//prb ici parce que le tableau est converti en string
$id_titre_list = $json_obj['id'];
$nom_playlist = $json_obj['nom_playlist'];

//echo "$id_titre";

// foreach($id_titre as $value){
//     echo $value . "<br>";
// }


// Création de la playlist
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



// Création du lien entre les titres et la playlist
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

}

?>
