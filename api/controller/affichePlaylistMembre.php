<?php

header("Content-Type: application/json; charset=UTF-8");

$nom = $_GET['nom'];
//echo $nom; 

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

$stmt = MyPDO::getInstance()->prepare(<<<SQL
SELECT *
FROM `Playlist`, `Titre`, `link_titre_playlist`,`Album`,`link_titre_album`, `Artiste`, `link_titre_artiste`
WHERE Playlist.id_playlist = link_titre_playlist.id_playlist
AND Titre.id_titre = link_titre_playlist.id_titre
AND Album.id_album = link_titre_album.id_album
AND Titre.id_titre = link_titre_album.id_titre
AND Artiste.id_artiste = link_titre_artiste.id_artiste
AND Titre.id_titre = link_titre_artiste.id_titre
AND Playlist.nom_playlist = '$nom'
SQL
);


$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	$musique = array(
		"id_titre" => $row['id_titre'], "titre_playlist" => $row['nom_playlist'], "id_playlist" => $row['id_playlist'], "nom_titre" => $row['nom_titre'], "nom_album" => $row['nom_album'],"nom_artiste" => $row['nom_artiste']);
	$musiques[] = $musique;
}

echo json_encode($musiques, JSON_UNESCAPED_UNICODE);

?>