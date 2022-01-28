let refInput = document.getElementById('referal-inp');
let copyBtn = document.getElementById('copy-btn');
copyBtn.addEventListener('click', copyValue);
copyBtn.addEventListener('touch', copyValue);
copyBtn.addEventListener('mouseout', outFunc);
function copyValue() {
	refInput.select();
	document.execCommand("copy");
	refInput.selectionStart = refInput.value.length;
	  let tooltip = document.querySelector(".tooltiptext");
  tooltip.innerHTML = "Скопировано";
}
function outFunc() {
  let tooltip = document.querySelector(".tooltiptext");
  tooltip.innerHTML = "Копировать";
}