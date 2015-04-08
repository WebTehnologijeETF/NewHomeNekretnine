function crtajMeni(idClicked, idMeni){
	var meniToShow = document.getElementById(idMeni);
	var clicked = $("#"+idClicked);

	var offset = clicked.offset();


	meniToShow.style.left = offset.left + "px";
	meniToShow.style.display = "block";
}

function brisiMeni(idMeni){
	var meniToHide = document.getElementById(idMeni);

	meniToHide.style.left = "0px";
	meniToHide.style.display = "none";
}

function klikni(clicked){
	clicked.childNodes[0].click();
}