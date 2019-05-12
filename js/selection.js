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
			let genres = document.getElementById('titre');
			data.forEach( musique => {
				let label = document.createElement("label")
				label.htmlFor = "input-radio-" + musique.toLowerCase();
				label.innerHTML = musique;

				//création du checkbox
				/*let radio = document.createElement("input");
				radio.type = "checkbox";
				radio.name = "genre";
				radio.value = musique;
				radio.id = "input-radio-" + musique.toLowerCase();*/
				
				let li  = document.createElement("li");
				li.onclick=function(){affiche_playerAudio(musique);}

				//li.appendChild(radio);
				li.appendChild(label);
				genres.appendChild(li);

				//compter le nombre de li
				//var lenghtli = document.querySelectorAll("#titre li").length;
			});
		})
		.catch(error => { console.log(error) });
});
