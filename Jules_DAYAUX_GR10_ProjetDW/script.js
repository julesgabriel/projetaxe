+/* livre interactif */

$(window).ready(function () {
    $('#magazine').turn({
        display: 'double',
        acceleration: true,
        gradients: !$.isTouch,
        elevation: 50,
        when: {
            turned: function (e, page) {
                /*console.log('Current view: ', $(this).turn('view'));*/
            }
        }
    });//librairie turlib js permettant de facilement créer un livre

/* livre interactif */
    $(window).bind('keydown', function (e) {

        if (e.keyCode == 37)
            $('#magazine').turn('previous');
        else if (e.keyCode == 39)
            $('#magazine').turn('next');

    });// permet que la corne de l'image qu'on tourne nous permet de voir la page de derriere pour faire l'effet de page qui se tourne


/* menu burger */
    $('#burger').on('click', function () {
        $('#menu').stop().slideToggle('slow');
        $('#navbar').stop().slideToggle('slow');
        $('#navbar').css({
                width: '100%',
                height: '60px',
                color: 'red',
            }
        );
    });
    //permet de faire apparaitre le menu burger
    /*permet de donner les propriétés du menu lors du click*/
    $(window).resize(function () {
        if ($(window).width() < 780) {
            $('#menu').css('display', 'inline-block');
        } else {
            $('#menu').css('display', 'none');
        }
    });

    /* fin menu burger */
    hauteurDocument = $(document).height();
    flag = null;//recupere la hauteur du doc

/* show en slow les images sur l'index 3 images des ennemis de spidemran */
    $(window).scroll(function () {
        if ($(window).scrollTop() > 80) {//lors d'un scroll de 80px par rapport au haut de la page
            $('.antagoniste',).show("slow");
        } else {
            $('.antagoniste').hide("slow");
        }

    });
    $(window).scroll(function () {
        if ($(window).scrollTop() > 850) {// //lors d'un scroll de 850px par rapport au haut de la page
            $('.antagoniste2',).show('slow');
        } else {
            $('.antagoniste2').hide("slow");
        }
    });
/*fin du show en slow les images des 3 ennemis */

    /* faire apparaitre le bouton back to top */
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // lors d'un scroll de 100px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');//ajoute la classe
                } else {
                    $('#back-to-top').removeClass('show');// sinon enleve la classe
                }
            };


        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {// au click du bouton back to top toute la page remontera en 350ms tout en haut
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 350);
        });

        /*fin back to top*/
        /* permet d'animer toutes les ancres du site en ancre douce */
        $('a').click(function () {
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
            return false;

        });
        /* fin ancre douce */
    }

});
/* permet de faire la mosaique La mosaique fonctionne sur des éléments qui apparaissent et qui font disparaitre celle qui passe la où l'élement apparait afin de ne pas avoir de problème, */
/* et de limiter le css */
document.querySelector("#venomimg").onclick = function () {
    if (window.getComputedStyle(document.querySelector('#venomtext')).display == 'none') {
        document.querySelector("#venomtext").style.display = "block";
        document.querySelector("#electrotext").style.display = "none";
        document.querySelector("#bouffonverttext").style.display = "none";
    } else {
        document.querySelector("#venomtext").style.display = "none";
        document.querySelector("#spidermanimage").style.display = "block";
        document.querySelector("#electroimage").style.display = "flex";
        document.querySelector("#bouffonvertimage").style.display = "flex";
    }
};
document.querySelector("#electroimg").onclick = function () {
    if (window.getComputedStyle(document.querySelector('#electrotext')).display == 'none') {
        document.querySelector("#electrotext").style.display = "flex";
        document.querySelector("#spidermanimage").style.display = "none";
        document.querySelector(".bouffonvertimage").style.display = "none";
    } else {
        document.querySelector("#electrotext").style.display = "none";
        document.querySelector("#spidermanimage").style.display = "block";
        document.querySelector(".bouffonvertimage").style.display = "flex";
    }
};
document.querySelector("#bouffonvertimg").onclick = function () {
    if (window.getComputedStyle(document.querySelector('#bouffonverttext')).display == 'none') {
        document.querySelector("#bouffonverttext").style.display = "block";
        document.querySelector("#spidermanimage").style.display = "none";
        document.querySelector("#electroimage").style.display = "none";
    } else {
        document.querySelector("#bouffonverttext").style.display = "none";
        document.querySelector("#spidermanimage").style.display = "block";
        document.querySelector("#electroimage").style.display = "flex";
    }
};
document.querySelector("#octopusimg").onclick = function () {
    if (window.getComputedStyle(document.querySelector('#octopustext')).display == 'none') {
        document.querySelector("#octopustext").style.display = "block";
        document.querySelector("#electrotext").style.display = "none";
        document.querySelector("#bouffonverttext").style.display = "none";

    } else {
        document.querySelector("#octopustext").style.display = "none";
        document.querySelector("#spidermanimage").style.display = "block";
        document.querySelector("#electroimage").style.display = "flex";
        document.querySelector("#bouffonvertimage").style.display = "flex";
    }
};

/* fin mosaique */


/* carousel */
mesSlides = $('.slide');
nbSlides = mesSlides.length;
reglette = $('.reglette');

// POUR IE //

reglette.css('width', nbSlides * 960 + 'px');//decalage de la reglette


function reorder() {
    for (k = 0; k < nbSlides; k++) {
        mesSlides.eq(k).css('order', k);
    }

}

reorder();

compteurSlide = 0;

function carrousel(vitesse) {
    if (!vitesse) vitesse = 2000;//en 2000ms la slide passera a la suivante, elle aura finit son mouvement
    reglette.animate({'left': '-100%'}, vitesse, function () {//il s'animera a 100% de la taille de sa slide
        reglette.css('left', 0);
        mesSlides.eq(compteurSlide).css('order', compteurSlide + nbSlides);
        compteurSlide++;
    });
    if (compteurSlide == nbSlides) {
        compteurSlide = 0;
        reorder();
    }
}

/* fin fonctionnement du carousel */

/* interagir avec le carousel */
timer = setInterval(carrousel, 4000);//4000 ms avant de changer de slide


$('#slide1')
    .mouseenter(function () {// lorsque l'utilisateur entre sa souris dans la slide1
        document.querySelector("#afficher1").style.opacity = "1";// l'opacité du premier bouton passe de 0 à 1
        clearInterval(timer); // remet le compteur tu timer à 0
    })
    .mouseleave(function () {
        document.querySelector("#afficher1").style.opacity = "0";// lorsqu'il sort de la slide 1 cela reviens à 0
        clearInterval(timer); // remet le compteur du timer à 0
    });

$('#afficher1')
    .click(function () { // au click sur afficher 1
        document.querySelector('#Arcs').style.display = "block"; // fait apparaitre le contenu
        document.querySelector('.cross').style.display = "block"; // et sa croix
    });

$('.cross').click(function () { //au click de la croix
    document.querySelector('#Arcs').style.display = "none"; // fait disparaitre le contenu
    document.querySelector('.cross').style.display = "none"; // et la croix
});

$('#slide2')
    .mouseenter(function () {
        document.querySelector("#afficher2").style.opacity = "1";
        clearInterval(timer);
    })
    .mouseleave(function () {
        document.querySelector("#afficher2").style.opacity = "0";
        clearInterval(timer);
    });

$('#afficher2').click(function () {
        document.querySelector('#Arcs2').style.display = "block";
        document.querySelector('.cross2').style.display = "block";
    });

$('.cross2').click(function () {
    document.querySelector('#Arcs2').style.display = "none";
    document.querySelector('.cross2').style.display = "none";
});


$('#slide3')
    .mouseenter(function () {
        document.querySelector("#afficher3").style.opacity = "1";
        clearInterval(timer);
    })
    .mouseleave(function () {
        document.querySelector("#afficher3").style.opacity = "0";
        clearInterval(timer);
    });

$('#afficher3').click(function () {
    document.querySelector('#Arcs3').style.display = "block";
    document.querySelector('.cross3').style.display = "block";
});

$('.cross3').click(function () {
    document.querySelector('#Arcs3').style.display = "none";
    document.querySelector('.cross3').style.display = "none";
});

// flèches //

$('.right').on('click', function () {
    clearInterval(timer);
    carrousel();
    // timer = setInterval(carrousel, 4000)
});

function carrouselInverse(vitesse) {
    if (!vitesse) vitesse = 1000;
    lastOrder = compteurSlide + nbSlides - 1;
    // je cherche qui est passé en dernier

    for (k = 0; k < nbSlides; k++) {
        if (mesSlides.eq(k).css('order') == lastOrder) {
            mesSlides.eq(k).css('order', lastOrder - nbSlides);
        }
    }


    compteurSlide--;
    reglette.css('left', '-1000px');
    reglette.animate({'left': 0}, vitesse);
}

$('.left').on('click', function () {
    clearInterval(timer);
    carrouselInverse();


});