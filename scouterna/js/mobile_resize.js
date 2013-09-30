function init() {
	document.getElementById('wp-admin-bar-mobile-switch').setAttribute('onClick', 'newwindow()');

}
function resizeme() {
	//alert('hello');
	resizeTo(480,0);
}

function newwindow() {
	//alert('hello');
	window.open(window.location.href,"","width=400, scrollbars=yes")
}
window.onload = init;

