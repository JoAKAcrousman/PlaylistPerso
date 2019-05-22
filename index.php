<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="./css/images/icon.png">
		<title>MELE'OHANA</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>

	<body>
		
		<div class="content content--blended">
			<!-- HAPPY MEDIA -->
			<div data-pop-media="happy" class="pop-media" style="background-image: url(css/images/happy.gif);">
				<div class="pop-media__overlay"></div>
			</div>
			<!-- SAD MEDIA -->
			<div data-pop-media="sad" class="pop-media" style="background-image: url(css/images/sad.gif);">
				<div class="pop-media__overlay"></div>
			</div>
			<!-- FUN MEDIA -->
			<div data-pop-media="fun" class="pop-media pop-media--circle" style="background-image: url(css/images/fun.gif);">
				<div class="pop-media__overlay"></div>
			</div>
			<!-- CHILL MEDIA -->
			<div data-pop-media="chill" class="pop-media" style="background-image: url(css/images/chill.gif);">
				<div class="pop-media__overlay"></div>
			</div>
			<!-- ANGRY MEDIA -->
			<div data-pop-media="angry" class="pop-media" style="background-image: url(css/images/angry.gif);">
				<div class="pop-media__overlay"></div>
			</div>
			<!-- NOSTALGIC MEDIA -->
			<div data-pop-media="nostalgic" class="pop-media" style="background-image: url(css/images/nostalgic.gif);">
				<div class="pop-media__overlay"></div>
			</div>

			<div data-pop-media="creator" class="pop-media" style="background-image: url(css/images/mysterious.gif);">
				<div class="pop-media__overlay"></div>
			</div>

		<div id="border">
			<div id="top"></div>
			<div id="bottom"></div>
			<div id="left"></div>
			<div id="right"></div>
		</div>

		<h2 class="fixed-title">MELE'<br>OHANA</h2>

		<section class="one-page">
			<h1 class="title">ME<span>LE'OHA</span>NA</h1>
			<img class="gif-bg" src="css/images/gifback.gif" width="450" alt="">
			<div class="wrapper">
			<p class="intro"> a playlist generator from mood</p>
			<!-- <a data-scroll href="#1">ancre</a> --> 
		</section>

		<section class="one-page select-mood">
			<h1 id="1">WHAT'S YOUR MOOD?</h1>
			<h2>👉 Select your mood and we will give you the playlist you need</h2>
			<form action="">
				<button id="trigger-happy" class="pop-text" data-pop-media="happy" type="submit" value="happy">HAPPY</button>

				<button id="trigger-sad" class="pop-text" data-pop-media="sad" type="submit" value="sad">SAD</button>

				<button id="trigger-fun" class="pop-text" data-pop-media="fun" type="submit" value="fun" formaction="fun.php"> FUN </button>

				<button id="trigger-chill" class="pop-text" data-pop-media="chill" type="submit" value="chill"> CHILL </button>

				<button id="trigger-angry" class="pop-text" data-pop-media="angry" type="submit" value="angry">ANGRY</button>

				<button id="trigger-nostalgic" class="pop-text" data-pop-media="nostalgic" type="submit" value="nostalgic"> NOSTALGIC</button>

			</form>

			

			<form>
				
				<h2>👉 Moooore </h2>
			
				<button id="trigger-creator" class="pop-text" data-pop-media="creator" type="submit" value="creator" formaction="playlistMembre.php"> PLAYLISTS DES CREATEURS</button>
			
				<button disabled id="trigger-mystery" class="pop-text" data-pop-media="mystery" type="submit" value="mystery"> TRY "?" TO DISCOVER <br/> SOMETHING</button>

			</form>
		</section>

		<script type='text/javascript' src="js/imagesloaded.pkgd.min.js"></script>
		<script type='text/javascript' src='js/script.js'></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/14.2.1/smooth-scroll.min.js"></script>
		<script>var scroll = new SmoothScroll('a[href*="#"]');</script>
		
	</body>
</html>