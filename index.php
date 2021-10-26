<?php
    include "config.php";
    include "app/functions.php";
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

    <!-- Quiz -->
    <div id="timer">
        <div id="timer_number">12</div>
        <div id="timer_rotate"></div>
    </div>
    
    <div id="cover"></div>

    <div id="responses_grid">
        <div id="responseA" class="response">Réponse A</div>
        <div id="responseB" class="response">Réponse B</div>
        <div id="responseC" class="response">Réponse C</div>
        <div id="responseD" class="response">Réponse D</div>
    </div>

    <div id="btn_passer"></div>

    <!-- Score -->
    <div id="score_grid">
        <div id="score_valide"></div>
        <div id="score_time"></div>
        <div id="score_time_bonus"></div>
    </div>
     

    <!-- Audio -->
    <audio id="music_menu" src="contents/music/<?php echo getMainMenuMusic(); ?>"></audio>
    <audio id="extrait" src=""></audio>
<script src="index.js"></script>
</body>
</html>