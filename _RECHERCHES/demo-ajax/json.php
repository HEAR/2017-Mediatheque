<?php



$json = new StdClass();

$json->texte = "super j'ai du texte";
$json->titre = "ceci est un titre";
$json->data = ["item 1", "item 2", "item 3"];



echo json_encode( $json );