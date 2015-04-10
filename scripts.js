function crtajMeni(clicked){
	var id;
	var id2;
	if(clicked.id.charAt(0)==="s")
	{
		id = clicked.id;
		id2 = clicked.id.charAt(1) + clicked.id.charAt(2);
	}

	if(clicked.id.charAt(0)==="m")
	{
		id = "s" + clicked.id;
		id2 = clicked.id;
	}

	var meniToShow = document.getElementById(id);

	var offset = document.getElementById(id2).getBoundingClientRect();

	meniToShow.style.left = offset.left + "px";
	meniToShow.style.display = "block";
}

function brisiMeni(meniToHide){
	var id;
	if(meniToHide.id.charAt(0)==="s")
	{
		id = meniToHide.id;
	}

	if(meniToHide.id.charAt(0)==="m")
	{
		id = "s" + meniToHide.id;
	}

	var sMeni = document.getElementById(id);
	sMeni.style.left = "0px";
	sMeni.style.display = "none";
}

function klikni(clicked){
	clicked.childNodes[0].click();
}

var obj1 = document.getElementById("m2");
obj1.addEventListener("click", function(){ crtajMeni(this); }, false);
obj1.addEventListener("mouseleave", function(){ brisiMeni(this); }, false);

var obj2 = document.getElementById("m4");
obj2.addEventListener("click", function(){ crtajMeni(this); }, false);
obj2.addEventListener("mouseleave", function(){ brisiMeni(this); }, false);

var obj3 = document.getElementById("sm2");
obj3.addEventListener("mouseenter", function(){ crtajMeni(this); }, false);
obj3.addEventListener("mouseleave", function(){ brisiMeni(this); }, false);

var obj4 = document.getElementById("sm4");
obj4.addEventListener("mouseenter", function(){ crtajMeni(this); }, false);
obj4.addEventListener("mouseleave", function(){ brisiMeni(this); }, false);