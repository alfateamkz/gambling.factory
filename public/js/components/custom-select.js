/*																													custom select 												*/
let selectInner = document.querySelectorAll('.select-inner');
let select = document.querySelectorAll('.select');
let selectHeader = document.querySelectorAll('.select-header');
let selectCurrent = document.querySelectorAll('.select-current');
let selectWrapper = document.querySelectorAll('.select-wrapper');
let selectBody = document.querySelectorAll('.select-body');
let selectItem = document.querySelectorAll('.select-item');
select.forEach(item => {
	item.style.height = item.querySelector('.select-header').clientHeight + "px";
	item.addEventListener('click', selectClick);
})
selectItem.forEach(item => {
	item.addEventListener('click', optionChoose);
})
window.onload = function () {
	selectCurrent.forEach(select => {
		blockChoosenOption(select);
	})
}
window.addEventListener('resize', calcSelectHeight);
window.addEventListener('resize', selectClose);
selectWrapper.forEach(item => {
	item.style.height = "0px";
})
let status = "closed";
function selectClick() {
	let currentSelectWrapper = this.querySelector(".select-wrapper");
	let currentSelectBody = this.querySelector(".select-body");
	let currentSelectHeader = this.querySelector(".select-header");
	this.style.height = this.querySelector('.select-header').offsetHeight + "px";
	if(currentSelectWrapper.offsetHeight == "0") {
		selectClose();
		select.forEach(item => {
			item.style.zIndex = "20";
		})
		this.style.zIndex = "100";
		currentSelectWrapper.classList.add('active')
		this.classList.add('active');
		currentSelectWrapper.style.height = currentSelectBody.scrollHeight + "px";
	}

	else {
		selectClose();
	}
	document.addEventListener('click', function clickOut(e) {
		let clicked = e.target;
		if(!(clicked.className == ('select') || clicked.closest('.select'))) {
			selectClose();
			document.removeEventListener('click', clickOut);
		}
	})
}
function calcSelectHeight() {
	select.forEach(item => {
		item.style.height = item.querySelector('.select-header').scrollHeight + "px";
	})
}
function selectClose() {
	selectWrapper.forEach(item => {
		item.style.height = "0px";
		item.classList.remove('active')
	})
	select.forEach(item => {
		item.classList.remove("active");
	})
}
function optionChoose(e) {
	let selected = e.currentTarget;
	let currentText;
	currentOption = selected.closest('.select-item').innerHTML;
currentText = selected.closest('.select-item').innerText.replace(/\s{2,}/g, ' ');
selected.closest('.select').querySelector('.select-current').innerHTML = currentOption;
selected.closest('.select').querySelector('input').value = currentText;
	blockChoosenOption(selected);
}
function blockChoosenOption(selected) {
	let current = selected.textContent.trim();
	selected.closest('.select').querySelectorAll('.select-item').forEach(item=>{
		item.style.removeProperty('pointer-events');
		item.classList.remove('choosen');
		if(item.textContent.includes(current)) {
			item.style.pointerEvents = "none";
			item.classList.add('choosen');
		}
	})
}

/*																													custom select 												*/