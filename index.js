
/* Intro */

btn_play.onclick = function () {
	hideIntro();
	showMainMenu();
}


/* Main Menu */

lunchQuiz.onclick = function () {
	hideMainMenu();
	initQuiz();
}

function initQuiz() {
	var xhr = new XMLHttpRequest();

	xhr.open("POST", "app/init.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.send();

	xhr.onreadystatechange = function () {
		var xhr = this;

		if (xhr.readyState != xhr.DONE)
			return false;

		if (xhr.status == 200) {
			/* Date.now() force le rechargement du média */
			extrait.src = "app/extrait.php?t=" + Date.now();
			cover.style.backgroundImage = "url('app/cover.php?t=" + Date.now() + "')";
			setResponses(JSON.parse(xhr.response));

			music_menu.pause();
		}
	}
}


/* Quiz */

var timestamp_start = null;
var timeout_decompte = null;

cover.onclick = function () {
	extrait.pause();
	hideQuiz();
	showScore();
}

responseA.onclick = function () {
	if (this.classList.contains('disabled') || this.classList.contains('active'))
		return false;

	submitResponse(this.innerHTML);
	this.classList.replace('disabled', 'active');
}
responseB.onclick = function () {
	if (this.classList.contains('disabled') || this.classList.contains('active'))
		return false;

	submitResponse(this.innerHTML);
	this.classList.replace('disabled', 'active');
}
responseC.onclick = function () {
	if (this.classList.contains('disabled') || this.classList.contains('active'))
		return false;

	submitResponse(this.innerHTML);
	this.classList.replace('disabled', 'active');
}
responseD.onclick = function () {
	if (this.classList.contains('disabled') || this.classList.contains('active'))
		return false;

	submitResponse(this.innerHTML);
	this.classList.replace('disabled', 'active');
}

function disableResponses() {
	responseA.classList.add("disabled");
	responseB.classList.add("disabled");
	responseC.classList.add("disabled");
	responseD.classList.add("disabled");
}

extrait.oncanplaythrough = function () {
	hideScore();
	showQuiz();

	extrait.play();
	lancerChrono();
}

extrait.onended = function () {
	hideQuiz();
	showScore();
}

function lancerChrono() {
	timer.style.display = 'block';
	timer_number.innerHTML = 12;

	timestamp_start = Date.now();

	/* Recursif */
	timeout_decompte = setTimeout(decompte, 1000);
}

function decompte() {
	var s = parseInt(timer_number.innerHTML) - 1;

	if (s !== 0) {
		timer_number.innerHTML = s;
		timeout_decompte = setTimeout(decompte, 1000);
	}
	else {
		/* Aucune réponse sélectionné */
		submitResponse("");
	}
}

function setResponses(tab) {
	var elements = [responseA, responseB, responseC, responseD];

	for (var i = 0; i < elements.length; i++) {
		var e = elements[i];
		e.innerHTML = tab[i];
		e.classList.remove('active', 'disabled');
	}
}

function submitResponse(response) {
	var xhr = new XMLHttpRequest();
	/* Temps de réponse */
	var time = Date.now() - timestamp_start;

	timer.style.display = 'none';
	clearTimeout(timeout_decompte);
	cover.style.display = 'block';
	disableResponses();

	xhr.open("POST", "app/submitResponse.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.send("response=" + response + "&time=" + time);

	xhr.onreadystatechange = function () {
		var xhr = this;

		if (xhr.readyState != xhr.DONE)
			return false;

		if (xhr.status == 200) {
			var data = JSON.parse(xhr.response);

			score_valide.innerHTML = data.valide ? "Bonne réponse! : +1000 points" : "Mauvaise réponse: +0 points";
			score_time.innerHTML = "Temps de réponse : " + (data.time/1000) + " secondes";
			score_time_bonus.innerHTML = "Bonus de temps :  +" + data.time_bonus + " points (" + data.bonus_pourcent + "%)";
		}
		else {
			console.error(xhr.response);
		}
	}
}


/* Score */

function nextMovie() {
	var xhr = new XMLHttpRequest();

	xhr.open("POST", "app/nextMovie.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.send();

	xhr.onreadystatechange = function () {
		var xhr = this;

		if (xhr.readyState != xhr.DONE)
			return false;

		if (xhr.status == 200) {
			if (xhr.response.substring(0,3) !== 'END') {
				var data = JSON.parse(xhr.response);

				setResponses(data);
				extrait.src = "app/extrait.php?t=" + Date.now();
				cover.style.backgroundImage = "url('app/cover.php?t=" + Date.now() + "')";
			}
			else {
				hideScore();
				showMainMenu();
			}
		}
		else {
			console.error(xhr.response);
		}
	}
}

/* Functions */

function hideIntro() {
	intro_message.style.display = "none";
	btn_play.style.display = "none";
};

function showMainMenu() {
	millennials.style.display = "block";
	quiz.style.display = "block";
	vhs.style.display = "block";

	music_menu.currentTime = 0;
	music_menu.play();
};

function hideMainMenu() {
	millennials.style.display = "none";
	quiz.style.display = "none";
	vhs.style.display = "none";
};

function showQuiz() {
	timer.style.display = "block";
	responses_grid.style.display = "grid";
};

function hideQuiz() {
	cover.style.display = "none";
	responses_grid.style.display = "none";
};

function showScore() {
	score_grid.style.display = "grid";
	setTimeout(() => {
		nextMovie();
	}, 4000);
};

function hideScore() {
	score_grid.style.display = "none";
};
