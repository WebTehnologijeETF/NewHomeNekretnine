function dobaviStanove(){
	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			var stanovi = JSON.parse(content.responseText);
			var stanoviDiv = document.getElementById("stanovi");
			var prikaz = "";

			var len = stanovi.length;
			for(i = len - 1; i >= 0; i--)
			{
				if(stanovi[i].kategorija == "stan")
					prikaz = prikaz + "<div class='nekretnina'><img class='nekretnina' src='resources/" + stanovi[i].slika +
										"' alt='stan'><h3 class='nekretnina'>" + stanovi[i].naziv +
										"</h3><p class='nekretnina'>" + stanovi[i].opis +
										"<p class='detalji'>" + stanovi[i].cijena +
										"KM <br>Agent: Tarik Demirović<br> ID:" + stanovi[i].id + "</p></div>";
			}
			stanoviDiv.innerHTML = prikaz;
		}
	}

	content.open("GET", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
	content.send();
}

function dodajStan(){
	var forma = document.getElementById("ds");

	var stan = {
		naziv: forma.naziv.value,
		opis: forma.opis.value,
		slika: forma.slika.value,
		cijena: forma.cijena.value,
		kategorija: "stan"
	}

	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			alert("Dodali Ste stan");
			dobaviStanove();
		}
	}

	content.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
	content.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	content.send("akcija=dodavanje" + "&brindexa=16459&proizvod=" + JSON.stringify(stan));
}


function brisiStan(){
	var forma = document.getElementById("ds");

	var stan = {
		id: forma.id_stana.value
	}

	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			alert("Obrisali Ste stan");
			dobaviStanove();
		}
	}

	content.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
	content.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	content.send("akcija=brisanje" + "&brindexa=16459&proizvod=" + JSON.stringify(stan));
}

function editujStan(){
	var forma = document.getElementById("ds");

	var stan = {
		id: forma.id_stana.value,
		naziv: forma.naziv.value,
		opis: forma.opis.value,
		slika: forma.slika.value,
		cijena: forma.cijena.value,
		kategorija: "stan"
	}

	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			alert("Promijenili Ste stan");
			dobaviStanove();
		}
	}

	content.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
	content.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	content.send("akcija=promjena" + "&brindexa=16459&proizvod=" + JSON.stringify(stan));
}

function resetirajUnos2(){
	var eps = document.getElementsByClassName("ep");

	for (var i = 0; i < eps.length; i++) {
		eps[i].style.visibility = "hidden";
	}
}

function validirajFormuDodavanje(){
	var forma = document.getElementById("ds");
	var valid = true;

	resetirajUnos2();

	var textReg = /^[a-zšđčćž0-9\s]+$/i;
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	var telReg = /^\+{0,1}[0-9]+[\/-]{0,1}[0-9-]+$/;
	var urlReg = /^[a-zšđčćž0-9._%+-]+\.[a-z]{1,3}$/i;
	var numReg = /^[1-9]+[0-9]*$/i;

	if (forma.naziv.value != "")
	{
		document.getElementById("ep1").style.visibility = "visible";
		valid = false;
	}

	if (forma.opis.value != "")
	{
		document.getElementById("ep2").style.visibility = "visible";
		valid = false;
	}

	if (!urlReg.test(forma.slika.value))
	{
		document.getElementById("ep3").style.visibility = "visible";
		valid = false;
	}

	if (!numReg.test(forma.cijena.value))
	{
		document.getElementById("ep4").style.visibility = "visible";
		valid = false;
	}

	if(valid)
		dodajStan();
}

function validirajFormuEditovanje(){
	var forma = document.getElementById("ds");
	var valid = true;

	resetirajUnos2();

	var textReg = /^[a-zšđčćž0-9\s]+$/i;
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	var telReg = /^\+{0,1}[0-9]+[\/-]{0,1}[0-9-]+$/;
	var urlReg = /^[a-zšđčćž0-9._%+-]+\.[a-z]{1,3}$/i;
	var numReg = /^[1-9]+[0-9]*$/i;

	if (forma.naziv.value != "")
	{
		document.getElementById("ep1").style.visibility = "visible";
		valid = false;
	}

	if (forma.opis.value != "")
	{
		document.getElementById("ep2").style.visibility = "visible";
		valid = false;
	}

	if (!urlReg.test(forma.slika.value))
	{
		document.getElementById("ep3").style.visibility = "visible";
		valid = false;
	}

	if (!numReg.test(forma.cijena.value))
	{
		document.getElementById("ep4").style.visibility = "visible";
		valid = false;
	}

	if (!numReg.test(forma.id_stana.value))
	{
		document.getElementById("ep5").style.visibility = "visible";
		valid = false;
	}

	if(valid){
		var content = new XMLHttpRequest();

		content.onreadystatechange = function () {
			if(content.readyState == 4 && content.status == 200) {
				var stanovi = JSON.parse(content.responseText);
				var len = stanovi.length;

				var postoji = false;
				for(i = len - 1; i >= 0; i--)
				{
					if(stanovi[i].kategorija == "stan")
						if(stanovi[i].id == forma.id_stana.value)
							postoji = true;
				}
				if(postoji)
					editujStan();
				else
					document.getElementById("ep5").style.visibility = "visible";
			}
		}

		content.open("GET", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
		content.send();
	}
}

function validirajFormuBrisanje(){
	var forma = document.getElementById("ds");
	var valid = true;

	resetirajUnos2();

	var numReg = /^[1-9]+[0-9]*$/i;

	if (!numReg.test(forma.id_stana.value))
	{
		document.getElementById("ep5").style.visibility = "visible";
		valid = false;
	}

	if(valid){
		var content = new XMLHttpRequest();

		content.onreadystatechange = function () {
			if(content.readyState == 4 && content.status == 200) {
				var stanovi = JSON.parse(content.responseText);
				var len = stanovi.length;

				var postoji = false;
				for(i = len - 1; i >= 0; i--)
				{
					if(stanovi[i].kategorija == "stan")
						if(stanovi[i].id == forma.id_stana.value)
							postoji = true;
				}
				if(postoji)
					brisiStan();
				else
					document.getElementById("ep5").style.visibility = "visible";
			}
		}

		content.open("GET", "http://zamger.etf.unsa.ba/wt/proizvodi.php?&brindexa=16459", true);
		content.send();
	}
}