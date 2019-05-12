<!DOCTYPE html>
<html>
     <head>
            <meta charset="utf-8">
            <html lang="en">
            	<link rel="icon" href="./css/images/icon.png">
	<title>MELE'OHANA</title>
            <link rel="stylesheet" type="text/css" href="css/style2.css">
			<link rel="stylesheet" type="text/css" href="css/base.css" />
			<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/solid.css'>
			<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css'>
     </head>
     <body>
     		<div id="border">
		<div id="top"></div>
		<div id="bottom"></div>
		<div id="left"></div>
		<div id="right"></div>
	</div>
     	<!-- TOP -->
		<main>
			<div class="content">
				<div class="content__img-wrap">
					<div class="content__img"></div>
					<div class="content__img"></div>
					<div class="content__img"></div>
				</div>


				<div class="content__text"><span class="content__text-inner">
<?php

if (isset($_GET['nom_playlist'])&&(!empty($_GET['nom_playlist']))){
		
		$nom_playlist = $_GET['nom_playlist'];

}

echo $nom_playlist;

?>

				</span></div>
			</div>
		</main>

<h1>

	
	

</h1>
<div id="content" class="myplaylist-content">
	<div id="criteres">
			<ul>
				<li> TITRE </li>
				<li> ARTISTE </li>
				<li> ALBUM </li>
			</ul>
			</div>
		<?php

// require_once '../classes/class.Playlist.php';

// if (isset($_POST ["submit"])){
//     $playlist = new Playlist();
//     $playlist->setNomPlaylist($_POST["nom_playlist"]);


//     $sql = "INSERT INTO Playlist (nom_playlist) VALUES (?)";

//     $requete = $pdo->prepare($sql);
//     $requete->bindValue(1, $_POST["nom_produit"]);


//     $requete->execute();

//     exit();


// }



require_once "api/MyPDO.elisaciaks9.include.php";
// require_once ("api/classes/class.Titre.php");





if ( isset($_GET['titre'])&& !empty($_GET['titre']) ) {
	

	foreach ($_GET['titre'] as $titre) {
			echo " <div class='myplaylist_row'> ";
			//AFFICHE TITRE
			echo " <div> $titre </div>";


			//REQUETE ARTISTE
			$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT nom_artiste
	FROM  `Artiste`,`Titre`, `link_titre_artiste`
	WHERE Titre.id_titre = link_titre_artiste.id_titre
	AND Artiste.id_artiste = link_titre_artiste.id_artiste
	AND Titre.nom_titre = '$titre'
SQL
);

 $stmt->execute();

	while (($row = $stmt->fetch()) !== false) {
		//AFFICHE ARTISTE
		echo "<div> {$row['nom_artiste']} </div>";

	}

		//REQUETE ALBUM
			$stmt = MyPDO::getInstance()->prepare(<<<SQL
	SELECT nom_album
	FROM `Album`, `Titre`, `link_titre_album` 
	WHERE Titre.id_titre = link_titre_album.id_titre
	AND Album.id_album = link_titre_album.id_album
	AND Titre.nom_titre = '$titre'
SQL
);

 $stmt->execute();

	while (($row = $stmt->fetch()) !== false) {
		//AFFICHE ALBUM
		echo "<div> {$row['nom_album']} </div>";

	}
	echo " </div> ";
	}


		
}

else echo "Aucune musiques choisies :-'(";

?>
</div>
<!-- FOOTER -->
		<div id="control">
			<div id="player_control">
				<ul>
					<li>
						<div class="button" id="play-previous">
							<i class="fas fa-backward"></i>
				        </div>
			    	</li>
					<li>
					    <div class="button" id="play-pause-button">
					        <i class="fas fa-play"></i>
				       </div>
				   </li>
				   <li>
				        <div class="button" id="play-next">
						    <i class="fas fa-forward"></i>
					   </div>
					</li>
				</ul> 
			</div>
		</div>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|IBM+Plex+Sans:500" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
		<script src="js/blotter.min.js"></script>
        <script src="js/materials/liquidDistortMaterial.js"></script>
		<script src="js/imagesloaded.pkgd.min.js"></script>
		<script src="js/demo2.js"></script>
        <script src="js/selection.js"></script>
    </body>
</html>


