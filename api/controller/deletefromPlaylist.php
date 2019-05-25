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

$nom_playlist = $_GET['name'];
//echo $nom_playlist;	

$id_titre = $_GET['id'];
//echo $id_titre;	


$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT id_playlist 
	FROM Playlist 
	WHERE Playlist.nom_playlist = '$nom_playlist'
SQL
);
	$stmt->execute();
	//$resp = array("id_playlist" => $id_playlist);
	//echo $id_playlist;

	while (($row = $stmt->fetch()) !== false) {
		$id_playlist = $row['id_playlist'];
	}

$stmt2 = MyPDO::getInstance()->prepare(<<<SQL
	DELETE FROM link_titre_playlist 
	WHERE link_titre_playlist.id_titre = '$id_titre'
	AND link_titre_playlist.id_playlist = '$id_playlist';
SQL
);
	
	$stmt2->execute();



////////SUPPRIME UNE MUSIQUE, MAINTENANT IL FAUT SUPPRIMER TOUTES LES MUSIQUES, PASSER UN TABLEAU DANS LA REQUETE SQL//

$musiques = array();

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT DISTINCT nom_titre, Titre.id_titre, nom_artiste, nom_album
	FROM `Titre`, `Playlist`, `link_titre_playlist`, `Artiste`, `link_titre_artiste`,`Album`,`link_titre_album`
	WHERE Titre.id_titre = link_titre_album.id_titre
	AND Album.id_album = link_titre_album.id_album
	AND Titre.id_titre = link_titre_artiste.id_titre
	AND Artiste.id_artiste = link_titre_artiste.id_artiste
	AND Playlist.id_playlist = link_titre_playlist.id_playlist
	AND Titre.id_titre = link_titre_playlist.id_titre
	AND Playlist.id_playlist = '$id_playlist'
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
