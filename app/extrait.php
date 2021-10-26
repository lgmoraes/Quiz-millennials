<?php

session_start();
include "../config.php";
include 'DB.php';

$cursor = $_SESSION[APP_NAME]['cursor'];
$movie = $_SESSION[APP_NAME]['movies'][$cursor];

$nbClips = count(glob("../contents/" . $movie . "_*.ogg"));

$path = "../contents/" . $movie . "_" . random_int(1, $nbClips) . ".ogg";

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $movie . '.ogg"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));

readfile($path);
