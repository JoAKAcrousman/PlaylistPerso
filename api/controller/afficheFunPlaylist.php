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

$musiques = array();

$nom_mood = $_GET['mood'];

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT nom_titre, Titre.id_titre, nom_artiste, nom_album
	FROM `Titre`, `Mood`, `link_titre_mood`, `Artiste`, `link_titre_artiste`,`Album`,`link_titre_album`
	WHERE Titre.id_titre = link_titre_album.id_titre
	AND Album.id_album = link_titre_album.id_album
	AND Titre.id_titre = link_titre_artiste.id_titre
	AND Artiste.id_artiste = link_titre_artiste.id_artiste
	AND Mood.id_mood = link_titre_mood.id_mood
	AND Titre.id_titre = link_titre_mood.id_titre
	AND Mood.nom_mood = '$nom_mood' 
SQL
);

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	$musique = array(
		 "titre" => $row['nom_titre'], "artiste" => $row['nom_artiste'], "album" => $row['nom_album'], "id" => $row['id_titre']);
	$musiques[] = $musique;
}

echo json_encode($musiques, JSON_UNESCAPED_UNICODE);

?>