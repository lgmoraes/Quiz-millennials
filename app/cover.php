<?php

session_start();
include "../config.php";
include 'DB.php';

$cursor = $_SESSION[APP_NAME]['cursor'];
$movie = $_SESSION[APP_NAME]['movies'][$cursor];

$path = "../contents/" . $movie . ".jpg";

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $movie . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));

readfile($path);
