/* Script JS médiathèque */
jQuery(function($){


	//// A VOIR pour GULP : http://www.geekpress.fr/wordcamp-paris-themes-gulp/

	console.log("Mediathèque JS OK");

	// Pour récupérer l'URL de base, pour l'historique, cf header.php
	var rootURL = $('meta[name=identifier-url]').attr('content');
	var nbrEcran;


	if( $("body").hasClass("admin-bar") ){
		$("html").css("height", "calc(100% - 32px)");
	}

	/**
	 * detection des liens internes
	 */
	$.expr[':'].internal = function (obj, index, meta, stack) {
	    // Prepare
	    var
	    $this = $(obj),
	    url = $this.attr('href') || '',
	    isInternalLink;
	    // Check link
	    isInternalLink = /*url.substring(0, rootUrl.length) === rootUrl ||*/ url.indexOf(':') === -1 || obj.hostname == location.hostname;
	    // Ignore or Keep
	    return isInternalLink;
	};


	// var State = History.getState();
	// var rootURL = $('meta[name=identifier-url]').attr('content');
	
	// if ( !History.enabled ) {
	// 	console.log( 'History.js is disabled for this browser.');
	// 	return false;
	// }else{
	// 	console.log('History.js is OK.');
	// }


	// permet de gérer les petites fenetres solo
	var solo = $(".solo").detach();
	solo.appendTo("#overlay");

	$(".close-all").click(function(e){
		$(".solo").remove();
	})

	// colonnes du menu
	$(".col2, .col3").outerHeight( $("ul.menu").height() + 20);
	$(".col2, .col3").hide();
	$(".col2").optiscroll();

	$("header #legende").hide(); 

	
	// action lorsque l'on clique sur un élément du menu
	function bindMenuAction(){
		$("nav a").click(function(event) {
			event.preventDefault();
			// console.log( $(this) );
			
			var submenu = "";

			// console.log("MENU ID", $(this).parent().parent().attr("id"));
			if( $(this).parent().parent().attr("id") == "menu-menu-mediatheque" ){
				// console.log("MAIN MENU");
				
				$("nav a").removeClass('active');
				$(this).addClass('active');

				$(".col2").hide();
				$(".col2").html("");
				submenu = $(this).parent().find('.sub-menu').html();				
			}else{
				// console.log("SUB MENU");
				$(".col2 a").removeClass('active');
				$(this).addClass('active');
			}

			

			// console.log("submenu",submenu);
			if(submenu !== "" && submenu !== undefined){
				$(".col2").scrollTop(0);
				$(".col2").html("<ul>"+submenu+"</ul>");

				$("nav a").unbind("click");

				$(".col2").show();

				$(".col2").optiscroll();
				// $(".col2").optiscroll({ forceScrollbars: true });
			
				bindMenuAction();
			}else{
				// $(".col2").html("");
			}

			$("nav").css("width","auto");
			
			
		});
	}

	bindMenuAction();
	loadContent();


	// activation du drag&drop pour les boites solo (cf ajax-single.php + part/*.php)
	// gestion du scroll
	// gestion de l'afficaheg de la légende au survol des boites .solo
	$( function() {
		$( "nav.draggable" ).draggable({ handle: ".handle", containment: "body", scroll: false  });

		$('#overlay .draggable')
		.draggable({ handle: ".handle", stack: "#overlay .solo" })
		.resizable({ handles: "se"} );

		$(".draggable .handle, .ui-resizable-handle")
		.mouseup(function(){
			$("body").find('iframe').fadeIn('fast');
		}).mousedown(function(){
			$("body").find('iframe').hide();
		});


		$(".solo .scroll-container").optiscroll({ forceScrollbars:  !Optiscroll.G.isTouch  });

	    $(".media-container").fitVids();

	    $(".solo")
		.mouseover(function(e){
			// console.log( $(this).data("legende") );

			$("header #legende .title").text( $(this).data("legende").title );
			$("header #legende .duree").text( $(this).data("legende").duree );
			$("header #legende .date").text( $(this).data("legende").date );
			$("header #legende .cote").text( $(this).data("legende").cote );
			$("header #legende .nom").text( $(this).data("legende").prenom + " " + $(this).data("legende").nom );
			$("header #legende .types").text( $(this).data("legende").types );
			$("header #legende .section").text( $(this).data("legende").section );
			$("header #legende .langue").text( $(this).data("legende").langue );

			$("header #legende").show(); 
		})
		.mouseout(function(e){
			$("header #legende").hide(); 
		});

		$(".close").click(function(e){
			$(this).parent().remove();
		})


	    // $(".draggable").mouseup(function(){
		// 	$(this).find('iframe').fadeIn('fast');
		// }).mousedown(function(){
		// 	$(this).find('iframe').hide();
		// });
	} );


	// j'écoute les clic de tous les liens, sauf de l'admin bar
	// $( document ).on( 'click', 'a[href^="http://localhost:8888/Hear-Mediatheque/"]:not(.ab-item)', do_ajax_request );
	// on fait une requete AJAX pour tous les liens internes sauf les liens admin wordpress et les classes pdf 
	$( document ).on( 'click', 'a:internal:not(.ab-item, .pdf)', do_ajax_request );


	// lors d'un clic, j'exécute une fonction qui prend le lien en paramètre
	function do_ajax_request( e ) {
		// console.log('do_ajax_request',e);

	    e.preventDefault();


	    // history.pushState("test", null, "test");

	    if( $(e.currentTarget).parent().hasClass("menu-item-has-children") !== true ){

	    	var url = $( this ).attr( 'href' );
	    	perform_ajax_request( url, false );

		}
	}



	// je fais une requête ajax vers le lien, en poussant comgraphXMLHttpRequest dans les headers
	function perform_ajax_request( url, is_history ) {
		
	    $.ajax({
	        url    : url,
	        type   : 'POST',
	        param  : { ajax : true },
	        headers: {
	            'X-Requested-With':'comgraphXMLHttpRequest'
	        }
	    }).done( function( data ) {
	        var data = $.parseJSON( data );
	        // console.log("perform_ajax_request data",data);

	        // console.log("relative url", data.relative_url, rootURL, data.relative_url.replace(rootURL, "") );

	        if(data.is_single === true){

	        	// on doit pouvoir faire une fonction avec tout ça
	        	// même chose que la fonction ligne 117

	        	$('#overlay').append(data.content);
	        	$('#overlay .draggable')
	        	.draggable({ handle: ".handle", stack: "#overlay .solo" })
	        	.resizable();

	        	$(".media-container").fitVids();


	        	$(".draggable .handle, .ui-resizable-handle")
				.mouseup(function(){
					$("body").find('iframe').fadeIn('fast'); // this <-> body
				}).mousedown(function(){
					$("body").find('iframe').hide();  // this <-> body
				});

				$(".solo .scroll-container").optiscroll({ forceScrollbars:  !Optiscroll.G.isTouch  });

				$(".solo")
				.mouseover(function(e){
					// console.log( $(this).data("legende") );

					$("header #legende .title").text( $(this).data("legende").title );
					$("header #legende .duree").text( $(this).data("legende").duree );
					$("header #legende .date").text( $(this).data("legende").date );
					$("header #legende .cote").text( $(this).data("legende").cote );
					$("header #legende .nom").text( $(this).data("legende").prenom + " " + $(this).data("legende").nom );
					$("header #legende .types").text( $(this).data("legende").types );
					$("header #legende .section").text( $(this).data("legende").section );
					$("header #legende .langue").text( $(this).data("legende").langue );

					$("header #legende").show(); 
				})
				.mouseout(function(e){
					$("header #legende").hide(); 
				})

				$(".close").click(function(e){
					$(this).parent().remove();
				})

	        }else{

	        	$('#fond').html(data.content);

	        	loadContent();				
	        }

	        $("body").attr("class", data.body_class);

	        document.title = data.title;

	        if(is_history === false){
	        	history.pushState({title:data.title,url:data.relative_url}, null, data.relative_url );
	    	}

	        // switch_content( template_actuel, data );
	    }).error( function(data) {

	    	console.log("404",data);

	    	var data = $.parseJSON( data.responseText );


	    	if(data.is_single === true){

	        	$('#overlay').append(data.content);
	        	$('#overlay .draggable').draggable({ handle: ".handle", stack: "#overlay .solo" });

	        	$(".media-container").fitVids();


	        	$(".draggable")
				.mouseup(function(){
					$("body").find('iframe').fadeIn('fast'); // this <-> body
				}).mousedown(function(){
					$("body").find('iframe').hide();  // this <-> body
				});

	        }else{

	        	$('#fond').html(data.content);

	        	loadContent();				
	        }

	        $("body").attr("class", data.body_class);

	        document.title = data.title;

	     //    if(is_history === false){
	     //    	history.pushState({title:data.title,url:data.relative_url}, null, data.relative_url );
	    	// }

	        // Error
	        // alert( 'Impossible de mettre à jour le contenu' );
	    });

	}


	/**
	 * [description]
	 * !!! https://css-tricks.com/using-the-html5-history-api/
	 * https://developer.mozilla.org/fr/docs/Web/Guide/DOM/Manipuler_historique_du_navigateur/Example
	 * https://github.com/giabao/mdn-ajax-nav-example
	 * https://stackoverflow.com/questions/31528432/how-do-i-use-window-history-in-javascript
	 * @param  {[type]} e) {		var       character [description]
	 * @return {[type]}    [description]
	 */
	window.addEventListener('popstate', function(e) {
		var currentState = e.state;

		// console.log('popstate',e);

		if (currentState == null) {
			// removeCurrentClass();
			// textWrapper.innerHTML = " ";
			// content.innerHTML = " ";
			// document.title = defaultTitle;
		} else {
			// updateText(character);
			// requestContent(character + ".html");
			// addCurrentClass(character);
			// document.title = "Ghostbuster | " + character;

			perform_ajax_request(currentState.url, true);
		}
	});



	function loadContent(){
		// on réactive le champ de suggestion si nécessaire
    	var searchRequest;
		$('.search-autocomplete').autoComplete({
			minChars: 2,
			source: function(term, suggest){
				try { searchRequest.abort(); } catch(e){}
				searchRequest = $.get( global.search_api, { term: term }, function( res ) {
					if ( res !== null ) {
						var results = [];
						console.log("result search", res);
						for(var key in res) {
							results.push(res[key].post_title)
						}

						suggest(results);
					}
				});
			},
			onSelect: function(e, term, item){
				console.log("onselect", term, item);

				// alert(<b>'Item "'</b>+item.data(<b>'langname'</b>)+<b>' ('</b>+item.data(<b>'lang'</b>)+<b>')" selected by '</b>+(e.type == <b>'keydown'</b> ? <b>'pressing enter'</b> : <b>'mouse click'</b>)+<b>'.'</b>);
			}
		});

		// ici gestion du scroll horizontal des colonnes
		// le calcul du décalage manque de précision, il faut l'affiner
		nbrEcran =  Math.ceil( $("section.archives ul").width() / $("body").width() );
		$("section.archives ul").width( nbrEcran * $("body").width() ); 

		$(".next")
		.unbind("click")
		.click(function(event){
			console.log("NEXT");
			var xscrollVal = '+=' + $("body").width();
			$("section.archives").scrollTo({top:'',left: xscrollVal }, 800);
		});

		$(".prev")
		.unbind("click")
		.click(function(event){
			console.log("PREV");
			var xscrollVal = '-=' + $("body").width();
			$("section.archives").scrollTo({top:'',left: xscrollVal }, 800);
		});

		$("section.archives li a")
		.mouseover(function(e){
			console.log( $(this).data("legende") );

			$("header #legende .title").text( $(this).data("legende").title );
			$("header #legende .duree").text( $(this).data("legende").duree );
			$("header #legende .date").text( $(this).data("legende").date );
			$("header #legende .cote").text( $(this).data("legende").cote );
			$("header #legende .nom").text( $(this).data("legende").prenom + " " + $(this).data("legende").nom );
			$("header #legende .types").text( $(this).data("legende").types );
			$("header #legende .section").text( $(this).data("legende").section );
			$("header #legende .langue").text( $(this).data("legende").langue );

			$("header #legende").show(); 
		})
		.mouseout(function(e){
			$("header #legende").hide(); 
		});



	}


	//la fonction pour la bascule des contenus
	// inutilisée, mais faisait partie du tutoriel initial pour les requetes AJAX
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