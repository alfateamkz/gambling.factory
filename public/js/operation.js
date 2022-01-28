let copyInput = document.querySelectorAll(".copy-input")
let copyBtn = document.querySelectorAll(".copy-btn");
copyBtn.forEach(btn => {
	btn.addEventListener('click', copyValue);
	btn.addEventListener('touch', copyValue);
	btn.addEventListener('mouseout', outFunc);
})
function copyValue() {
	copyInput.forEach(inp => {
		if(this.dataset.copy == inp.dataset.copy) {
			inp.select();
			document.execCommand("copy");
			inp.selectionStart = inp.value.length;
			let tooltip = this.querySelector(".tooltiptext");
			tooltip.innerHTML = "Скопировано";
		}
	})

}
function outFunc() {
	let tooltip = this.querySelector(".tooltiptext");
	tooltip.innerHTML = "Копировать";
}
/*															timer														*/
if(document.querySelector('#time')) {
function startTimer(duration, display) {
    let timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    let minutes = 60 * 20,
        display = document.querySelector('#time');
    startTimer(minutes, display);
};
}
/*															timer														*/