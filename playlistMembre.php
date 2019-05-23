<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<html lang="en">
	<link rel="icon" href="./css/images/icon.png">
	<title>MELE'OHANA</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="stylesheet" type="text/css" href="css/playlistMembre.css">
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/solid.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css'>
</head>
<body id="member_page">
	<div id="border">
		<div id="top"></div>
		<div id="bottom"></div>
		<div id="left"></div>
		<div id="right"></div>
	</div>

	<section class="select-mood">

		<h1 id="1">WHO ARE WE?</h1>
		<h2 class="p">👉 Here get your best new songs with a selection of each of us, and discover who we are.</h2>

		<form>

			<div class="playlist_mystere" onclick="affichePlaylistMembre('elisa')">
				<figure class="effect-sadie">
					<img src="css/images/elisa.jpg" alt="img02"/>
					<figcaption>
						<h2>Playlist d'<span>Elisa</span></h2>
						<p>"Toi, quand je t'ai vu, <br>J'me suis dit pourquoi pas."</p>
					</figcaption>            
				</figure>
			</div>
			<div class="playlist_mystere" onclick="affichePlaylistMembre('sarah')">
				<figure class="effect-sadie">
					<img src="css/images/sarah.jpg" alt="img02"/>
					<figcaption>
						<h2>Playlist de <span>Sarah</span></h2>
						<p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
					</figcaption>            
				</figure>
			</div>
			<div class="playlist_mystere" onclick="affichePlaylistMembre('oceane')">
				<figure class="effect-sadie">
					<img src="css/images/oceane.jpg" alt="img02"/>
					<figcaption>
						<h2>Playlist d'<span>Oceane</span></h2>
						<p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
					</figcaption>            
				</figure>
			</div>
			<div class="playlist_mystere" onclick="affichePlaylistMembre('andrea')">
				<figure class="effect-sadie">
					<img src="css/images/andrea.jpg" alt="img02"/>
					<figcaption>
						<h2>Playlist d'<span>Andréa</span></h2>
						<p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
					</figcaption>            
				</figure>
			</div>
			<div class="playlist_mystere" onclick="affichePlaylistMembre('johan')">
				<figure class="effect-sadie">
					<img src="css/images/johan.jpg" alt="img02"/>
					<figcaption>
						<h2>Playlist de <span>Johan</span></h2>
						<p>Sadie never took her eyes off me. <br>She had a dark soul.</p>
					</figcaption>            
				</figure>
			</div>
		</form>
		
	</section>
	
	<div id="content">
		<div id="criteres">
			<ul>
				<li> TITRE </li>
				<li> ARTISTE </li>
				<li> ALBUM </li>
			</ul>
		</div>
		<div id="php_content">
			<div id="titre">
				
			</div>
		</div>
	</div>
	<div id="control"> </div>

	<div class="space" style="height: 300px"></div>
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|IBM+Plex+Sans:500" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
	<script src="js/blotter.min.js"></script>
	<script src="js/imagesloaded.pkgd.min.js"></script>
	<script src="js/test.js"></script>
</body>
</html>


