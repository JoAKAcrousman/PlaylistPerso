<?php

header("Content-Type: application/json; charset=UTF-8");

// check HTTP method
$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method !== 'get') {
	http_response_code(405);
	echo json_encode(array('message' => 'This method is not allowed.'));
	exit();
}

// include data
include_once "../data/MyPDO.elisaciaks9.include.php";

// response status
http_response_code(200);

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	-- Récupère aléatoirement une musique de la playlist ProjetSon
	SELECT *
	FROM `Titre`
	INNER JOIN
		(
		SELECT FLOOR( COUNT( * ) * RAND() % (80 - 71 + 1) + 71) AS ValeurAleatoire
		FROM `Titre`
		) AS V ON Titre.id_titre = V.ValeurAleatoire
	INNER JOIN link_titre_playlist ON Titre.id_titre = link_titre_playlist.id_titre
	INNER JOIN Playlist ON link_titre_playlist.id_playlist = Playlist.id_playlist
	WHERE Playlist.id_playlist = '130'
SQL
);
$stmt->execute();

$publi = [];

if(($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
	array_push($publi, $row);
}

echo json_encode($publi, JSON_UNESCAPED_UNICODE);


?>
