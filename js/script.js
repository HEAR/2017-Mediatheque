/* Script JS médiathèque */
jQuery(function($){


	console.log("Mediathèque JS OK");

	$('.col2, .col3').outerHeight( $("ul.menu").height() + 20);

	$("nav a").click(function(event) {
		event.preventDefault();

		$(".col2").html("");
		var submenu = $(this).parent().find('.sub-menu').html();


			console.log(submenu);

		if(submenu != undefined){
			$(".col2").html(submenu);
		}else{
			$(".col2").html("");
		}

		$("nav").css("width","auto");

		

	})


	$( function() {
		$( "nav" ).draggable({ handle: ".handle" });
	} );


	// j'écoute les clic de tous les liens, sauf de l'admin bar
	// $( document ).on( 'click', 'a[href^="http://localhost:8888/Hear-Mediatheque/"]:not(.ab-item)', do_ajax_request );

	// lors d'un clic, j'exécute une fonction qui prend le lien en paramètre
	function do_ajax_request( e ) {
		console.log('AJAX');


	    e.preventDefault();
	    var url = $( this ).attr( 'href' );
	    perform_ajax_request( url );
	}



	// je fais une requête ajax vers le lien, en poussant comgraphXMLHttpRequest dans les headers
	function perform_ajax_request( url ) {
		
	    $.ajax({
	        url    : url,
	        type   : 'POST',
	        param  : { ajax : true },
	        headers: {
	            'X-Requested-With':'comgraphXMLHttpRequest'
	        }
	    }).done( function( data ) {
	        // var data = $.parseJSON( data );
	        console.log(data);

	        $('#main').html(data);

	        // switch_content( template_actuel, data );
	    }).error( function() {
	        // Error
	        alert( 'Impossible de mettre à jour le contenu' );
	    });
	}


	//la fonction pour la bascule des contenus
	// switch_content( template_actuel, data ) {
	//     switch( template_actuel ) {
	//         case 'detail':
	//             $( '.detail' ).remove();
	//             break;
	//         case 'liste':
	//             $( '.intro, .liste' ).remove();
	//             break;
	//         default :
	//     }

	//     switch( data.template ) {
	//         case 'detail':
	//             $('body').append($(data.detail));
	//             break;
	//         case 'liste':
	//             $('body').append($(data.intro + data.liste ));
	//             break;
	//         default :
	//     }

	//     // mise à jour du template
	//     template_actuel = data.template;

	//     // changement du nom de l'onglet
	//     window.document.title = data.title;
	// }


});