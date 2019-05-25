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
    FROM `Artiste`;
SQL
);

$stmt->execute();

$artistes = array();

while (($row = $stmt->fetch()) !== false) {
	$artiste = array(
		 "id_artiste" => $row['id_artiste'], "nom_artiste" => $row['nom_artiste'], "img_artiste" => $row['img_artiste']);
	$artistes[] = $artiste;
}

echo json_encode($artistes, JSON_UNESCAPED_UNICODE);

?>
