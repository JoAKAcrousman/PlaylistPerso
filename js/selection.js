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

// permet d'afficher toutes les musiques
document.ready( () => {
	fetch("./api/controller/afficheFunPlaylist.php") 
		.then( response => response.json() )
		.then( data => {
			let titre = document.getElementById('titre');
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
			let titre = document.getElementById('control');
			text.forEach( player => {
				let div = document.createElement("div");
				div.innerHTML = "<img src=" + player.img_titre + " id=image_titre>" + "<span id='nom_titre'>" + player.nom_titre + "</span>" + "<audio controls=controls> <source src=" + player.mp3_titre + "> <type=audio/mp3/>";
				console.log(player);
				titre.appendChild(div);
			});
		})
		.catch(error => {console.log(error)});
};

//permet de savoir quels sont les checkboxs cochées
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
		}
	}
	xhr.open("POST","./api/controller/createTheplaylist.php",true);
	xhr.send(body);
}








