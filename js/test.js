// document ready in ES6
Document.prototype.ready = callback => {
	if(callback && typeof callback === 'function') {
		document.addEventListener("DOMContentLoaded", () =>  {
			if(document.readyState === "interactive" || document.readyState === "complete") {
				return callback();
			}
		});
	}
};

// permet d'afficher le player audio lorsque l'on clique sur une musique
function affichePlayerAudio(player){
	fetch("./api/controller/affichePlayer.php?id="+player.id_titre) 
	.then( response => response.json() )
	.then( text => {
		document.getElementById('control').innerHTML = "";
		text.forEach( player => {
			let div = document.createElement("div");
			div.innerHTML = "<div class='img_container'><img src=" + player.img_titre + " id=image_titre></div>" + " <div class='playerlayout'><span id='nom_titre'>" + player.nom_titre + "</span>" + "<audio controls=controls> <source src=" + player.mp3_titre + "> <type=audio/mp3/></div>";
			console.log(player);
			control.appendChild(div);
		});
	})
	.catch(error => {console.log(error)});
};
à

// permet d'afficher les playlists mystères de chacun des membres du groupe
function affichePlaylistMembre(nom){
	fetch("./api/controller/affichePlaylistMembre.php?nom="+nom) 
	.then( response => response.json() )
	.then( text => {
		document.getElementById('titre').innerHTML = "";
		text.forEach( player => {
			let div = document.createElement("div");
			div.innerHTML = "<span id='musique_titre'>" + player.nom_titre + "</span>" + "<span id='musique_artiste'>" + player.nom_artiste + "</span>" + "<span id='musique_album'>" + player.nom_album + "</span>";
			let li  = document.createElement("li");
			div.onclick=function(){affichePlayerAudio(player);}
			titre.appendChild(li);
			li.appendChild(div);
			console.log(player.id_titre);
		});
	})
	.catch(error => {console.log(error)});
};




