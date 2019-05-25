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

function GetUrlParam( paramName )
{
	var oRegex = new RegExp( '[\?&]' + paramName + '=([^&]+)', 'i' ) ;
	var oMatch = oRegex.exec( window.top.location.search ) ;

	if ( oMatch && oMatch.length > 1 )
		return decodeURIComponent( oMatch[1] ) ;
	else
		return ;
}



// permet d'afficher toutes les musiques
document.ready( () => {
	fetch("./api/controller/afficheFunPlaylist.php?mood="+GetUrlParam('mood')) 
	.then( response => response.json() )
	.then( data => {
		let titre = document.getElementById('titre');
			// document.querySelector("#main_content > main > div > div.content__text > canvas").innerHTML='';
			data.forEach( musique => {
				let div = document.createElement("div");
				// div.htmlFor = "input-radio-" + musique.toLowerCase();
				div.innerHTML = "<span id='musique_titre'>" + musique.titre + "</span>" + "<span id='musique_artiste'>" + musique.artiste + "</span>" + "<span id='musique_album'>" + musique.album + "</span>";

				let input = document.createElement("input");
				input.type = "checkbox";
				input.value = musique.id;
				input.name = "titre[]";
				input.className ="inputElements";
				
				let li  = document.createElement("li");
				div.onclick=function(){affichePlayerAudio(musique);}

				titre.appendChild(li);
				li.appendChild(input);
				li.appendChild(div);

			});
		})
	.catch(error => { console.log(error) });
});



// permet d'afficher le player audio lorsque l'on clique sur une musique
function affichePlayerAudio(musique){
	fetch("./api/controller/affichePlayer.php?id="+musique.id) 
	.then( response => response.json() )
	.then( text => {
		document.getElementById('control').innerHTML = "";
		let titre = document.getElementById('control');
		text.forEach( player => {
			let div = document.createElement("div");
			div.innerHTML = "<div class='img_container'><img src=" + player.img_titre + " id=image_titre></div>" + " <div class='playerlayout'><span id='nom_titre'>" + player.nom_titre + "</span>" + "<audio controls=controls> <source src=" + player.mp3_titre + "> <type=audio/mp3/></div>";
			titre.appendChild(div);
		});
	})
	.catch(error => {console.log(error)});
};

//permet de savoir quelles sont les checkboxs cochées
document.getElementById("buttonplaylist").onclick = event => {
	event.preventDefault();
	let params = {}
	var checkedValue = [];
	var inputElements = document.getElementsByClassName('inputElements');
	for(var i=1; inputElements[i]; ++i){
		if(inputElements[i].checked){
			checkedValue.push(inputElements[i].value);
		}
	}
	params['id'] = checkedValue;

	function getXhr(){
		var xhr = null; 
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
		try {
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else { // XMLHttpRequest non supporté par le navigateur 
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
		xhr = false; 
	} 
	return xhr
}


// permet de créer une playlist
const form = document.querySelector('#formplaylist');
if (form.nom_playlist.value) 
	params['nom_playlist'] =  form.nom_playlist.value;
var body = JSON.stringify(params);
var xhr = getXhr()
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			document.getElementById("control").innerHTML = xhr.responseText;
			const lastIDblop = document.getElementById("control").innerHTML;
			var lastID = encodeURIComponent(lastIDblop);

			console.log(lastID);

			fetch("./api/controller/affichePlaylistUser.php?id="+lastID) 
			.then( response => response.json() )
			.then( data => {

				let content_titre = document.querySelector(".content__text");
				content_titre.innerHTML="";

				// let buttonRemove = document.getElementById("buttonRemove");
				// buttonRemove.style.visibility = "visible";

				let container_h1 = document.querySelector(".content");

				document.getElementById('titre').innerHTML = "";

				let h1 = document.createElement("h1");
				h1.innerHTML = params['nom_playlist'];
				h1.id = "new_name";

				document.querySelector("#content > h2").innerHTML ="👉 You've juste created \""+params['nom_playlist']+"\" playlist. Great choices."

				document.getElementById("buttonplaylist").style.display="none";
				document.getElementById("nom_playlist").style.display="none";

				data.forEach( newmusique => {
					let div = document.createElement("div");
					// div.htmlFor = "input-radio-" + newmusique.toLowerCase();
					div.innerHTML = "<span id='musique_titre'>" + newmusique.titre + "</span>" + "<span id='musique_artiste'>" + newmusique.artiste + "</span>" + "<span id='musique_album'>" + newmusique.album + "</span>";

					// let input = document.createElement("input");
					// input.type = "checkbox";
					// input.value = newmusique.id;
					// input.name = "titre[]";
					// input.className ="inputElements";
					
					let li  = document.createElement("li");
					div.onclick=function(){affichePlayerAudio(newmusique);}

					titre.appendChild(li);
					container_h1.appendChild(h1);
					// li.appendChild(input);
					li.appendChild(div);
					// titre.appendChild(buttonRemove);

				});
			})
			.catch(error => { console.log(error) });
		}
	}

	xhr.open("POST","./api/controller/createPlaylist.php",true);
	xhr.send(body);


//affiche le nom de la playlist créé dans le menu à gauche
let nom_playlist = document.getElementById('content_menu_left_playlist');
let affiche_nom_playlist = document.createElement("div");
affiche_nom_playlist.innerHTML = "<p>" + params.nom_playlist + "</p>";

let li_nomplaylist  = document.createElement("li");
li_nomplaylist.className = "li_nomplaylist";
nom_playlist.appendChild(li_nomplaylist);
li_nomplaylist.appendChild(affiche_nom_playlist);

}

//affiche les playlists créées par les utilisateurs
function affichePlaylistCreateByOthers(musique){
	var param = encodeURIComponent(musique.titre_playlist);

	


	//var params = JSON.stringify(param);
	//params = JSON.parse(param);
	console.log(param);
	fetch("./api/controller/affichePlaylistCreateByOthers.php?nom="+param) 
	.then( response => response.json() )
	.then( data => {

		if (document.getElementById("new_name")){
			document.getElementById("new_name").innerHTML="";
			document.getElementById("new_name").innerHTML=param;

		}
		else {

			let container_h1 = document.querySelector(".content")
			let h1 = document.createElement("h1");
			h1.innerHTML = param;
			h1.id = "new_name";

			container_h1.appendChild(h1);

		}

		document.getElementById('titre').innerHTML = "";
		let titre = document.getElementById('titre');
		let content_titre = document.querySelector(".content__text");
		content_titre.innerHTML="";

		document.querySelector("#content > h2").innerHTML ="👉 This is \""+param+"\" playlist. Enjoy."

		var imgtitlepage = document.getElementById('content_img_title');
		imgtitlepage.classList.add('content_user'); 

		data.forEach( musique => {


			console.log(musique.titre);
			let div = document.createElement("div");
			document.getElementById("nom_playlist").style.display="none";
			document.getElementById("buttonplaylist").style.display="none";
			div.innerHTML = "<span id='musique_titre'>" + musique.titre + "</span>" + "<span id='musique_artiste'>" + musique.artiste + "</span>" + "<span id='musique_album'>" + musique.album + "</span>";
			let li  = document.createElement("li");
			div.onclick=function(){affichePlayerAudio(musique);}

			titre.appendChild(li);
			li.appendChild(div);

		});
	})
	.catch(error => { console.log(error) });
}

//permet d'afficher toutes les playlists déjà créées
document.ready( () => {
	fetch("./api/controller/affichePlaylistCreate.php") 
	.then( response => response.json() )
	.then( data => {
		let nom_playlist = document.getElementById('content_menu_left_playlist');
		data.forEach( musique => {
			let affiche_nom_playlist = document.createElement("div");
			affiche_nom_playlist.innerHTML = "<p>" + musique.titre_playlist + "</p>";

			let li_nomplaylist  = document.createElement("li");
			li_nomplaylist.className = "li_nomplaylist";
			nom_playlist.appendChild(li_nomplaylist);
			li_nomplaylist.appendChild(affiche_nom_playlist);

			li_nomplaylist.onclick=function(){affichePlaylistCreateByOthers(musique);}

		});
	})
	.catch(error => { console.log(error) });
});








// buttonRemove.onclick = event => {
// 	event.preventDefault();
// 	let params = {}
// 	var checkedValue = [];
// 	var removeElements = document.getElementsByClassName('inputElements');
// 	//permet de savoir quels sont les checkboxs cochées
// 	for(var i=1; removeElements[i]; ++i){
//       	if(removeElements[i].checked){
//            checkedValue.push(removeElements[i].value);
//     	}
// 	}

// 	params['id'] = checkedValue;

// 	// permet de créer une playlist
// 	let newName = document.getElementById('new_name');
// 	params['nom_playlist'] =  newName.innerHTML;


// 		var body = JSON.stringify(params);
// 		var xhr = getXhr()
// 		// On défini ce qu'on va faire quand on aura la réponse
// 		xhr.onreadystatechange = function(){
// 			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
// 			if(xhr.readyState == 4 && xhr.status == 200){
	
// 			fetch("./api/controller/deletefromPlaylist.php?name="+params['nom_playlist']) 
// 				.then( response => response.json() )
// 				.then( data => {

// 					document.getElementById('titre').innerHTML = "";
// 					data.forEach( newplaylist => {
// 						let div = document.createElement("div");
// 						div.innerHTML = "<span id='musique_titre'>" + newplaylist.titre + "</span>" + "<span id='musique_artiste'>" + newplaylist.artiste + "</span>" + "<span id='musique_album'>" + newplaylist.album + "</span>";

// 						let input = document.createElement("input");
// 						input.type = "checkbox";
// 						input.value = newplaylist.id;
// 						input.name = "titre[]";
// 						input.className ="inputElements";

// 						let li  = document.createElement("li");
// 						div.onclick=function(){affichePlayerAudio(newplaylist);}

// 						li.appendChild(input);
// 						li.appendChild(div);

// 					});
// 				})
// 				.catch(error => { console.log(error) });
// 				}
// 		}

// 		xhr.open("GET","./api/controller/affichePlaylistUser.php?id=161",true);
// 		xhr.send(body);

// }





