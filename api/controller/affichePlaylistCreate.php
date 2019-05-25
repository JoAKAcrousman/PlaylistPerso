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

$stmt = MyPDO::getInstance()->prepare(<<<SQL
SELECT DISTINCT *
FROM `Playlist`
WHERE Playlist.nom_playlist != 'elisa'
AND Playlist.nom_playlist != 'sarah'
AND Playlist.nom_playlist != 'oceane'
AND Playlist.nom_playlist != 'andrea'
AND Playlist.nom_playlist != 'johan'
AND Playlist.nom_playlist != 'ProjetSon';
SQL
);


$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	$musique = array(
		"titre_playlist" => $row['nom_playlist'], "id_playlist" => $row['id_playlist']);
	$musiques[] = $musique;
}

echo json_encode($musiques, JSON_UNESCAPED_UNICODE);

?>