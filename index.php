<?php
    include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo APP_NAME; ?></title>
</head>
<body>
    <!-- Intro -->
    <div id="intro_message"></div>
    <div id="btn_play" class="hoverScale"></div>

    <!-- Ecran Titre -->
    <div id="millennials"></div>
    <div id="quiz"></div>

    <div id="bottom">
        <div id="vhs">
            <div id="lunchQuiz" class="hoverScale"></div>
        </div>
    </div>

    <!-- Audio -->
    <audio id="music_menu" src="contents/music/<?php echo getMainMenuMusic(); ?>"></audio>
    <audio id="extrait" src=""></audio>
<script src="index.js"></script>
</body>
</html>