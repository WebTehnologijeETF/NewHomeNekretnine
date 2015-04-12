function resetirajUnos(){
	var eps = document.getElementsByClassName("ep");

	for (var i = 0; i < eps.length; i++) {
		eps[i].style.visibility = "hidden";
	}
}

function validiraj(evt){
	var forma = document.getElementById("kf");
	var valid = true;

	resetirajUnos();

	var textReg = /^[a-zšđčćž]+$/i;
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	var telReg = /^\+{0,1}[0-9]+[\/-]{0,1}[0-9-]+$/;

	if (!textReg.test(forma.ime.value))
	{
		document.getElementById("ep1").style.visibility = "visible";
		valid = false;
	}

	if (!textReg.test(forma.prezime.value))
	{
		document.getElementById("ep2").style.visibility = "visible";
		valid = false;
	}

	if (!emailReg.test(forma.mail.value))
	{
		document.getElementById("ep3").style.visibility = "visible";
		valid = false;
	}

	if (forma.telefon.value != ""){
		if (!telReg.test(forma.telefon.value))
		{
			document.getElementById("ep4").style.visibility = "visible";
			valid = false;
		}
	}

	if (forma.poruka.value == "")
	{
		document.getElementById("ep6").style.visibility = "visible";
		valid = false;
	}

	if(!valid)
		evt.preventDefault();

	return valid;
}

function validirajMail() {
	var forma = document.getElementById("kf");
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	if (emailReg.test(forma.mail.value))
		forma.maillist.disabled = false;
	else
		forma.maillist.disabled = true;
}

var mailChanged = document.getElementById("mailtb");
mailChanged.addEventListener("change", validirajMail, false);

var sabmitaj = document.getElementById("kf");
sabmitaj.addEventListener("submit", function(evt){ validiraj(evt); }, false);

var resetiraj = document.getElementById("reset");
resetiraj.addEventListener("click", resetirajUnos, false);