<!DOCTYPE html>
<html>
     <head>
            <meta charset="utf-8">
            <html lang="en">
            <link rel="icon" href="./css/images/icon.png">
			<title>MELE'OHANA</title>
			<link rel="stylesheet" type="text/css" href="css/styles.css">
            <link rel="stylesheet" type="text/css" href="css/style2.css">
			<link rel="stylesheet" type="text/css" href="css/base.css" />
			<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/solid.css'>
			<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css'>
     </head>
     <body id="fun_page">
     	
     	<div id="border">
			<div id="top"></div>
			<div id="bottom"></div>
			<div id="left"></div>
			<div id="right"></div>
		</div>

		<!-- LEFT BAR MENU -->
		<div id="menu_left">
			<div id="content_menu_left">
				<a href="index.php"> 
					<img src="css/images/house.png">
					<p> Accueil </p>
				</a>
			</div>
			<div id="clear_both"></div>
			<div id="content_menu_left">
				<a href="#"> 
					<img src="css/images/magnifying-glass.png">
					<p> Rechercher </p>
				</a>
			</div>
			<div id="clear_both"></div>
			<div id="content_menu_left_bibliotheque">
				<p> BIBLIOTHEQUE </p>
				<p> Artiste </p>
				<p> Album </p>
			</div>
			<div id="content_menu_left_playlist">
				<p> PLAYLIST </p>
			</div>
		</div>

     	<!-- TOP -->
     	<div id="main_content">
			<main>
				<div class="content content_fun">
					<div class="content__img-wrap">
						<div class="content__img"></div>
						<div class="content__img"></div>
						<div class="content__img"></div>
					</div>
					<div class="content__text"><span class="content__text-inner">Funny playlist</span></div>
				</div>
			</main>

	     	<!-- CONTENT -->
	        <div id="content">
	        	<h2>👉 Pick your favorite songs to create your own playlist </h2> 
	        	<div id="criteres">
				<ul>
					<li id="un"> TITRE </li>
					<li id="deux"> ARTISTE </li>
					<li id="trois"> ALBUM </li>
				</ul>
				</div>
				<div id="php_content">
					<form  id="formplaylist" action="">
						<div id="titre">
						
						</div>
						<input id="nom_playlist" placeholder="👉 GIVE A NAME*" type="text" name="nom_playlist">
						<input id="buttonplaylist" type="button" name="submit" value="✅ CREATE YOUR PLAYLIST"></input>
						<!-- <input id="buttonRemove" type="button" name="submit" style="visibility:hidden;" value="🗑 REMOVE SONGS SELECTED"></input> -->
					</form>
				</div>
					</form>
				</div>
			</div>
		</div>

		<!-- FOOTER -->
		<div id="control">
			
		</div>
		<div class="space" style="height: 300px"></div>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|IBM+Plex+Sans:500" rel="stylesheet">
		<script src="js/selection.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
		<script src="js/blotter.min.js"></script>
        <script src="js/materials/liquidDistortMaterial.js"></script>
		<script src="js/imagesloaded.pkgd.min.js"></script>
		<script src="js/demo2.js"></script>
    </body>
</html>


