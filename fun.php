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
     	<script src="js/selection.js"></script>
     	<!-- TOP -->
		<main>
			<div class="content"  class="fun_mood">
				<div class="content__img-wrap">
					<div class="content__img__fun"></div>
					<div class="content__img__fun"></div>
					<div class="content__img__fun"></div>
				</div>
				<div class="content__text"><span class="content__text-inner">Funny playlist</span></div>
			</div>
		</main>

     	<!-- CONTENT -->
        <div id="content">
        	<div id="criteres">
			<ul>
				<li> TITRE </li>
				<li> ARTISTE </li>
				<li> ALBUM </li>
			</ul>
			</div>
			<div id="php_content">
				<form method="GET" action="createPlaylist.php">
				<div id="titre">
					<?php
					require('test.php');
					?>
				</div>

				<input id="nom_playlist" placeholder="GIVE A NAME*" type="text" name="nom_playlist">

<button id="buttonplaylist" type="submit"  name="submit" value="Submit">👉CREATE YOUR PLAYLIST👈</button>
				</form>
			</div>

				</form>
			</div>
		</div>

<a id="buttonback" href="index.php">👈 or CHANGE YOUR MOOD</a>

		<!-- FOOTER -->
		<div id="control">
			<!--<div id="player_control">
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
			</div>-->
		</div>
		<div class="space" style="height: 300px"></div>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|IBM+Plex+Sans:500" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
		<script src="js/blotter.min.js"></script>
        <script src="js/materials/liquidDistortMaterial.js"></script>
		<script src="js/imagesloaded.pkgd.min.js"></script>
		<script src="js/demo2.js"></script>
    </body>
</html>


