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


//Méthode qui sera appelée sur le click du bouton
function affiche_playerAudio(musique){
	var xhr = getXhr()
	//var nom_titre = document.getElementById('musique1');
	var param = "title="+musique;
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			document.getElementById("control").innerHTML = xhr.responseText;
		}
	}
	xhr.open("GET","ajax.php?"+param,true);
	xhr.send(null);
}


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

//affichage des données
document.ready( () => {
	fetch("./test.php") 
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
				div.onclick=function(){affiche_playerAudio(musique);}

				titre.appendChild(li);
				li.appendChild(input);
				li.appendChild(div);

			});
		})
		.catch(error => { console.log(error) });
});



var checkedValue[]; 
var inputElements = document.getElementsByClassName('inputElements');
for(var i=0; inputElements[i]; ++i){
      if(inputElements[i].checked){
           checkedValue[i] = inputElements[i].value;
           break;
      }
}




let formplaylist = document.getElementById('formplaylist');
formplaylist.onsubmit= function(checkedValue) {

var xhr = getXhr()

	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			document.getElementById("myplaylist_content").innerHTML = xhr.responseText;
		}
	}
	xhr.open("POST","createTheplaylist.php?"+checkedValue,true);
	xhr.send(null);

}






