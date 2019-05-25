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
	SELECT *
    FROM `Album`;
SQL
);

$stmt->execute();

$albums = array();

while (($row = $stmt->fetch()) !== false) {
	$album = array(
		 "id_album" => $row['id_album'], "nom_album" => $row['nom_album'], "img_album" => $row['img_album']);
	$albums[] = $album;
}

echo json_encode($albums, JSON_UNESCAPED_UNICODE);

?>
