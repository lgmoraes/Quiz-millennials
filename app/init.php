<?php

session_start();
include "../config.php";
include 'DB.php';
include 'Movie.php';
include 'MoviesManager.php';


/* Réinitialise la SESSION de l'appli */
$_SESSION[APP_NAME] = [];
$_SESSION[APP_NAME]['cursor'] = 0;
$_SESSION[APP_NAME]['movies'] = MoviesManager::getRandomMovieIds();
$_SESSION[APP_NAME]['points'] = 0;

$movie = MoviesManager::getMovieByNameId($_SESSION[APP_NAME]['movies'][0]);

echo json_encode(MoviesManager::getResponses($movie));
