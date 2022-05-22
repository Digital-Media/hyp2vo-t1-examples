<?php

require "../src/Hypermedia2/Vl11/FavoriteMTDSubject.php";

use Hypermedia2\Vl11\FavoriteMTDSubject;

// Shout the favorite subject
$favoriteSubject = new FavoriteMTDSubject("Hypermedia 2");
echo $favoriteSubject->say();

// Simply retrieve the favorit subject
echo $favoriteSubject->getFavoriteSubject();

// Disagree with another statement
$otherSubject1 = new FavoriteMTDSubject("Media Technology 2");
try {
    echo $favoriteSubject->respondTo($otherSubject1->say());
} catch (Exception $e) {
    echo $e->getMessage();
}

// Agree with another statement
$otherSubject2 = new FavoriteMTDSubject("Hypermedia 2");
try {
    echo $favoriteSubject->respondTo($otherSubject2->say());
} catch (Exception $e) {
    echo $e->getMessage();
}
