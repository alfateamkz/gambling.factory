/*															Подсветка ссылки текущей страницы					*/
window.addEventListener("load", currentPageLnk);
function currentPageLnk() {
	let navLinks = document.querySelectorAll(".nav__list-item a");
	let PageFileName = document.location.href;
	navLinks.forEach(link => {
		link.closest('.nav__list-item').classList.remove('active');
		if(link.href == PageFileName) {
			link.closest('.nav__list-item').classList.add('active');
		}
	})
}
let navListItems = document.querySelectorAll(".nav__list-item");
navListItems.forEach(item => {
	item.addEventListener("mouseover", removeCurPageLnk);
	item.addEventListener("mouseout", currentPageLnk);
	// item.addEventListener("touchcancel", currentPageLnk);
})
function removeCurPageLnk() {
	navListItems.forEach(link => {
		link.classList.remove('active')
	})
}
/*															Подсветка ссылки текущей страницы					*/


/*															Сайдбар меню												*/
let menuButton = document.querySelector(".menu-button");
let sidebarMenu = document.querySelector(".sidebar");
menuButton.addEventListener('click', toggleMenu);
function toggleMenu() {
	menuButton.classList.toggle('active');
	sidebarMenu.classList.toggle('active');
	document.addEventListener('click', clickOutMenu);
	document.querySelector("body").classList.toggle('no-scroll');
	setTimeout(()=>{
		document.addEventListener('click', clickOutMenu);	
	},100)
}
function clickOutMenu(e) {
	let clicked = e.target;
	if(!clicked.closest('.sidebar') && !clicked.closest('.menu-button')) {
		closeBurgerMenu();
	}
}
function closeBurgerMenu() {
	menuButton.classList.remove('active');
	sidebarMenu.classList.remove('active');
}
/*															Сайдбар меню												*/