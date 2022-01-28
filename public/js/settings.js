let settingsPopup = document.querySelectorAll(".popup");
let settingsPopupBtn = document.querySelectorAll(".send-code");
let popupCloseBtn = document.querySelectorAll(".popup-close");
let popupLayout = document.querySelectorAll(".popup_layout");
settingsPopupBtn.forEach(btn => {
	btn.addEventListener("click", popupFunc);
	btn.addEventListener("click", timer);
})
btnVerifyCheck();
popupLayout.forEach(layout => {
	layout.addEventListener('click', closePopup);
})
popupCloseBtn.forEach(btn => {
	btn.addEventListener('click', closePopup);
})
function popupFunc() {
	settingsPopup.forEach(popup => {
		popup.classList.remove('active');
		if(this.dataset.popup == popup.dataset.popup) {
			popup.classList.add('active');
		}
	})
}
function closePopup() {
	settingsPopup.forEach(popup => {
		popup.classList.remove('active')
	})
}
function timer(e) {
	let btn = e.currentTarget;
	let time = 60;
	let btnText = btn.textContent;
	let btnInner = btn.closest(".verify__input_inner");
	btnInner.dataset.verified = "process";
	let interval = setInterval(changeTime, 1000);
	function changeTime() {
		if(time == 0) {
			btn.textContent = btnText;
			btnInner.dataset.verified = "false";
			btnVerifyCheck();
			clearInterval(interval);
		}
		else {
			time--;
			btn.textContent = "новый " + time + " сек";
		}
	}
}
function btnVerifyCheck() {
	settingsPopupBtn.forEach(btn => {
		let btnInner = btn.closest('.verify__input_inner');
		if(btnInner.dataset.verified == "false") {
			btn.textContent = 'отправить код';
		}
		else if (btnInner.dataset.verified = "true") {
			btn.textContent = 'подтвержден';
		}
	})
}