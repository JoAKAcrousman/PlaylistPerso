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
include_once ";./data/MyPDO.elisaciaks9.include.php";

// response status
http_response_code(200);






//     $sql = "INSERT INTO Playlist (nom_playlist) VALUES (?)";

//     $requete = $pdo->prepare($sql);
//     $requete->bindValue(1, $_POST["nom_produit"]);


//     $requete->execute();

//     exit();


// }


$stmt = MyPDO::getInstance()->prepare(<<<SQL
	
	INSERT INTO Playlist (nom_playlist) 
	VALUES (:nom_playlist)
SQL
);

$stmt->bindParam('nom_playlist',$nom_playlist);
$stmt->execute();

$resp = array(
		 "nom_playlist" => $row['nom_playlist']);

echo json_encode($resp);
exit();

?>