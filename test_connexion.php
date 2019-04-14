<?php
require_once "api/MyPDO.elisaciaks9.include.php";

$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT *
	FROM Titre
	WHERE id_titre=1;
SQL
);

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	echo "<div>{$row['nom_titre']}</div>";
	/*echo "<br/> Image de l'oeuvre : <img src=".$row['img_titre']."> <br/>";
	echo '<audio controls="controls" preload="none">'
                    .'<source src="' . $row['musique'] . '" type="audio/mp3" />'
                    .'Votre navigateur n\'est pas compatible'
                    .'</audio>';
}*/

?>
