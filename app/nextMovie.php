<?php

session_start();
include "../config.php";
include 'DB.php';
include 'Movie.php';
include 'MoviesManager.php';


if (!isset($_SESSION[APP_NAME])) {
    http_response_code(400);
    echo 'ERROR: NOT INITIALIZED';
    exit();
}

$cursor = ++$_SESSION[APP_NAME]['cursor'];

if ($cursor < NB_QUESTIONS) {
    $movie = MoviesManager::getMovieByNameId($_SESSION[APP_NAME]['movies'][$cursor]);
    echo json_encode(MoviesManager::getResponses($movie));
} else {
    echo 'END:' . $_SESSION[APP_NAME]['points'];
}
