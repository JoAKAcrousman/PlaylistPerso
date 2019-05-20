

/* ---------- SHOW MEDIA ON HOVER ---------- */

(function(window) {

    'use strict';

    // Closest ancestor element that has a specific class. From: http://stackoverflow.com/a/22119674
    function findAncestor(el, cls) {
        while ((el = el.parentElement) && !el.classList.contains(cls));
        return el;
    }
    // getElementById shorthand function.
    function $(id) { return document.getElementById(id); };
    
    function MediaRevealer(el) {
        this.el = el;
        this.contentEl = findAncestor(this.el, 'content');
        this.mediaEl = this.contentEl.querySelector('.pop-media[data-pop-media="' + this.el.getAttribute('data-pop-media') + '"]');

        // Check if any data-pop-width and data-pop-height values were passed.
        var w = 0, h = 0;
        if( this.mediaEl.getAttribute('data-pop-width') != undefined ) {
            w = this.mediaEl.getAttribute('data-pop-width') + 'px';
        }
        if( this.mediaEl.getAttribute('data-pop-height') != undefined ) {
            h = this.mediaEl.getAttribute('data-pop-height') + 'px';
        }

        
    }

    MediaRevealer.prototype.positionMedia = function() {
        var elOffset = this.el.getBoundingClientRect(), 
            contentOffset = this.contentEl.getBoundingClientRect();

        this.mediaEl.style.top = parseFloat((elOffset.top + this.el.offsetHeight/2) - contentOffset.top - this.mediaEl.offsetHeight/2) + 'px';
        this.mediaEl.style.left = parseFloat((elOffset.left + this.el.offsetWidth/2) - contentOffset.left - this.mediaEl.offsetWidth/2) + 'px';
    };

    MediaRevealer.prototype.resetMedia = function() {
        this.mediaEl.style.WebkitTransform = this.mediaEl.style.transform = 'none';
        this.mediaEl.style.opacity = 0;
    };

    function init() {
        // Preload all images.
        imagesLoaded(document.querySelector('.content'), { background: true }, function() {
            document.body.classList.remove('loading');
            initEvents();
        });
    }

    function initEvents() {

        var t1 = new MediaRevealer($('trigger-happy'));
        t1.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t1.positionMedia();
                t1.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t1.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t1.resetMedia();
        });

        var t2 = new MediaRevealer($('trigger-sad'));
        t2.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t2.positionMedia();
                t2.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t2.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t2.resetMedia();
        });

        var t3 = new MediaRevealer($('trigger-fun'));
        t3.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t3.positionMedia();
                t3.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t3.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t3.resetMedia();
        });

        var t4 = new MediaRevealer($('trigger-chill'));
        t4.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t4.positionMedia();
                t4.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t4.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t4.resetMedia();
        });

        var t5 = new MediaRevealer($('trigger-angry'));
        t5.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t5.positionMedia();
                t5.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t5.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t5.resetMedia();
        });

        var t6 = new MediaRevealer($('trigger-nostalgic'));
        t6.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t6.positionMedia();
                t6.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t6.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t6.resetMedia();
        });

        var t7 = new MediaRevealer($('trigger-creator'));
        t7.el.addEventListener('mouseenter', function(ev) {
            clearTimeout(triggertimeout);
            triggertimeout = setTimeout(function() {
                t7.positionMedia();
                t7.mediaEl.style.opacity = 1;
            }, triggerdelay);
        });
        t7.el.addEventListener('mouseleave', function(ev) {
            clearTimeout(triggertimeout);
            t7.resetMedia();
        });


    }

    // setTimeouts 
    var triggertimeout, triggerdelay = 50;

    init();

})(window);

//affiche les playlists mystères
document.onkeypress=function(e){
    e=e||window.event;
    var key=e.which?e.which:event.keyCode;
    if (key==63){
        fetch("./api/controller/afficheProjetSon.php") 
        .then( response => response.json() )
        .then( text => {
            document.getElementById('trigger-mystery').innerHTML = "";
            let titre = document.getElementById('trigger-mystery');
            text.forEach( player => {
                let div = document.createElement("div");
                div.innerHTML = "<span id='nom_titre'>" + player.nom_titre + "</span>" + "<audio controls=controls> <source src=" + player.mp3_titre + "> <type=audio/mp3/>";
                titre.appendChild(div);
            });
        })
        .catch(error => {console.log(error)});  
    } 
    else alert('Frappe de la touche de code '+key)
}














