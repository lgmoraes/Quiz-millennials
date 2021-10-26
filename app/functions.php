<?php

/**
 * Envoi aléatoirement l'url d'un des fichiers musique pour l'écran titre
 * 
 * @return string Nom du fichier choisi aléatoirement
 */
function getMainMenuMusic()
{
    $files = scandir("contents/music");
    $musics = [];

    foreach ($files as $file) {
        if (!is_dir($file) and getExtension($file) === "ogg")
            array_push($musics, $file);
    }

    return $musics[random_int(0, count($musics) - 1)];
}

/**
 * Retourne l'extention
 * 
 * @param string
 * @return string Extension extraite de la chaine
 */
function getExtension($str)
{
    return strtolower(substr(strrchr($str, '.'), 1));
}
