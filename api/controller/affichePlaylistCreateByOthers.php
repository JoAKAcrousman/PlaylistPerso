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

$newmusiques = array();

if(!empty($_GET['nom'])){
    $nom_playlist = $_GET['nom'];
}
else {
    echo json_encode(array("error" => "Missing nom playlist"));
	http_response_code(422);
}

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT DISTINCT nom_titre, Titre.id_titre, nom_artiste, nom_album, nom_playlist
	FROM `Titre`, `Playlist`, `link_titre_playlist`, `Artiste`, `link_titre_artiste`,`Album`,`link_titre_album`
	WHERE Titre.id_titre = link_titre_album.id_titre
	AND Album.id_album = link_titre_album.id_album
	AND Titre.id_titre = link_titre_artiste.id_titre
	AND Artiste.id_artiste = link_titre_artiste.id_artiste
	AND Playlist.id_playlist = link_titre_playlist.id_playlist
	AND Titre.id_titre = link_titre_playlist.id_titre
	AND Playlist.nom_playlist = '$nom_playlist';
SQL
);

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	$newmusique = array(
		 "titre" => $row['nom_titre'], "artiste" => $row['nom_artiste'], "album" => $row['nom_album'], "id" => $row['id_titre'], "playlist" => $row['nom_playlist']);
	$newmusiques[] = $newmusique;
}

echo json_encode($newmusiques, JSON_UNESCAPED_UNICODE);


?>


