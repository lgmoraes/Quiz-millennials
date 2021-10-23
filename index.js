
btn_play.onclick = function() {
    hideIntro();
    showMainMenu();
}

lunchQuiz.onclick = function() {
    hideMainMenu();
}

function hideIntro() {
    intro_message.style.display = "none";
    btn_play.style.display = "none";
};

function showMainMenu() {
    millennials.style.display = "block";
    quiz.style.display = "block";
    vhs.style.display = "block";

    music_menu.play();
};

function hideMainMenu() {
    millennials.style.display = "none";
    quiz.style.display = "none";
    vhs.style.display = "none";
};

