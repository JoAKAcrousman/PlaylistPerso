<?php
require_once "api/MyPDO.elisaciaks9.include.php";

//REQUETE DIFFERENTE POUR CHAQUE TITRE
$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT *
	FROM `Titre`, `Mood`, `link_titre_mood`
	WHERE Mood.id_mood = link_titre_mood.id_mood
	AND Titre.id_titre = link_titre_mood.id_titre
	AND Mood.nom_mood = 'Fun'
	AND Titre.nom_titre = 'Je m\'voyais déjà'
SQL
);

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	echo "<div id=informations>";
	echo "<div id=affiche_info>";
	echo "<img src=".$row['img_titre'].">";
	echo "<p> {$row['nom_titre']} </p>";
	echo '<audio controls="controls" preload="none">'
                    .'<source src="' . $row['mp3_titre'] . '" type="audio/mp3" />'
                    .'Votre navigateur n\'est pas compatible'
                    .'</audio>';
	echo "</div>";
	echo "</div>";
}

?>