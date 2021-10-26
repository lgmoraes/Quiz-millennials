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
if (!isset($_POST['response'])) {
    http_response_code(400);
    echo 'ERROR: NO RESPONSE';
    exit();
}
if (!isset($_POST['time'])) {
    http_response_code(400);
    echo 'ERROR: NO TIME';
    exit();
}

$cursor = $_SESSION[APP_NAME]['cursor'];
$movie = MoviesManager::getMovieByNameId($_SESSION[APP_NAME]['movies'][$cursor]);

$valide = $_POST['response'] === $movie->name();
$time = $_POST['time'];
$time_bonus = 0;
$bonus_pourcent = 0;

if ($valide) {
    if ($_POST['time'] <= 2000) {
        $time_bonus = 1000;
        $bonus_pourcent = 100;
    } else if ($_POST['time'] >= 12000) {
        $time = 12000;
        $time_bonus = 0;
        $bonus_pourcent = 0;
    } else {
        $bonus_pourcent = (10000 - ($_POST['time'] - 2000)) / 100;
        $bonus_ratio = $bonus_pourcent / 100;
        $time_bonus = round(1000 * $bonus_ratio);
    }

    $_SESSION[APP_NAME]['points'] += 1000 + $time_bonus;
}


echo json_encode(
    array(
        'valide' => $valide,
        'time' => round($time, 2),
        'time_bonus' => round($time_bonus, 2),
        'bonus_pourcent' => round($bonus_pourcent, 2)
    )
);
