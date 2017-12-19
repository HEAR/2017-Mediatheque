# 2017-Mediatheque
Template wordpress du fond de la médiathèque de la Haute école des arts du Rhin


## Outils + librairies + tutoriaux

- API JSON : 
  - https://code.tutsplus.com/tutorials/introducing-the-wp-rest-api--cms-24533
  - https://www.sitepoint.com/wp-api/
  - https://www.technosailor.com/2012/02/08/tutorial-using-wordpress-ajax-api/
  - https://premium.wpmudev.org/blog/using-ajax-with-wordpress/
  - https://tommcfarlin.com/wordpress-ajax-api-example/
  - https://developer.wordpress.org/rest-api/reference/posts/#example-request
  - https://developer.wordpress.org/rest-api/using-the-rest-api/pagination/
- AJAX :
  - http://api.jquery.com/jQuery.ajax/
  - https://stackoverflow.com/questions/4245231/how-do-i-filter-the-returned-data-from-jquery-ajax#4245323
- MOTEUR DE RECHERCHE :
  - https://fr.wordpress.org/plugins/relevanssi/#description
  - https://gist.github.com/jaredatch/27c42dfdf02b20256cf7b160ab6e55db
- AJAX NAVIGATION (et préservation de l'historique) :
  - https://github.com/browserstate/history.js
  - http://browserstate.github.io/history.js/demo/


----


## références :
- lastbutnotliste.com
- lineto.com => console de navigation
 - back office => système visuel
- e-k.fr


## Menu :
- annuaire
- type de document
- date de création
- thèmes
- cycle de conférence ?


## Structure

### Catégories

- annuaire
  - a
  - b
  - c
  - d
  - etc.
- type de document
  - photos
  - vidéos
  - conférences
    - conférencier 
    - graphisme technè
    - ex natura
    - …
  - mémoires
  - publication
- thèmes
  - art
  - art objet
  - design
  - communication
  - scénographie
 
### Pages

- contenu
  - à propos
  - mentions légales
- les archives les plus récentes
- recherche

### Archive (article)

- titre
- date de publication (= date de l'archive ?)
- texte
- medias (images, pdf, audio, vidéo)
- public / privé (controle d'accès par office 365)
- champs additionnels 
  - côte
- taxonomies
  - groupe / atelier
  - categories
  - mots clefs
  - auteur (2 champs : titre = nom / + prénom)
  
  ----
  HTML
> langage de structure
> balises

<h1>ceci est un titre</h1> (h1, H -> heading)

JAVASCRIPT
> langage de programmation (logique)
> avant côté client (client/serveur)
> depuis 4/5 ans client et serveur (serveur nodeJS)

PHP

CSS



Site archives médiathèque
- archives audio, vidéo, photos, certains documents
- début de numérisation
	• fond photo
	• cassettes audio + minidisks (depuis début 1980)
- problème des droits de diffusion
- dorénavant, tout conférencier est invité à signer une autorisation d'enregistrement et de diffusion
- photographies, vérifier la législation (70 ans ?), question public/privé
- mise en place d'une médiathèque numérique/en ligne
- mise en valeur du fond de la réserve d'art (livres d'art et éditions limitées)
- créer un site internet qui permette de rassembler ces collections (actuellement stockage one drive + serveur site de l'école)

Quel nom ? -> 1er projet nommé médiathèque numérique, mais le nom est trompeur
-> plutôt un fond d'archive

----

###Les CMS :

CMS -> content management system (systeme de gestion de contenu)
Framework


KIRBY
INDEXHIBIT
JOOMLA
WORDPRESS
DRUPAL
KOKEN
SPIP

WEB 50% CMS

APACHE (logiciel) -> LANGAGE (PHP / JS / CSS) -> FRAMEWORK (SYMPHONY ) -> CMS
