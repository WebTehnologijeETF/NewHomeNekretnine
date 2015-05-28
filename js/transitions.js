function getContent(url){
	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			document.getElementById("content").innerHTML = content.responseText;
		}
	}

	content.open("GET", url, true);
	content.send();
}

function getNekretnine(vrsta) {
	var nekretnine = new XMLHttpRequest();

	nekretnine.onreadystatechange = function () {
		if(nekretnine.readyState == 4 && nekretnine.status == 200) {
			document.getElementById("content").innerHTML = nekretnine.responseText;
		}
	}

	nekretnine.open("GET", "nekretnine.php?vrsta=" + vrsta, true);
	nekretnine.send();
}

function getNews(){
	var news = new XMLHttpRequest();

	news.onreadystatechange = function () {
		if(news.readyState == 4 && news.status == 200) {
			document.getElementById("content").innerHTML = news.responseText;
		}
	}

	news.open("GET", "popularne.php", true);
	news.send();
}

function getDetails(id){
	var details = new XMLHttpRequest();

	details.onreadystatechange = function () {
		if(details.readyState == 4 && details.status == 200) {
			document.getElementById("content").innerHTML = details.responseText;
		}
	}

	details.open("GET", "detalji.php?novost=" + id, true);
	details.send();
}

function sendComment(id){
	var forma = document.getElementById("komf");

	var ime = forma.ime.value;
	var mail = forma.mail.value;
	var komentar = forma.poruka.value;

	var textReg = /^[a-zšđčćž ]+$/i;
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;

	var valid = true;

	document.getElementById("ep1_kom").style.visibility = "hidden";
	document.getElementById("ep3_kom").style.visibility = "hidden";
	document.getElementById("ep6_kom").style.visibility = "hidden";

	if (!textReg.test(ime))
	{
		document.getElementById("ep1_kom").style.visibility = "visible";
		valid = false;
	}

	if (mail != "")
		if (!emailReg.test(mail))
		{
			document.getElementById("ep3_kom").style.visibility = "visible";
			valid = false;
		}

	if (komentar == "")
	{
		document.getElementById("ep6_kom").style.visibility = "visible";
		valid = false;
	}

	if(valid){
		var komentarisi = new XMLHttpRequest();
		komentarisi.onreadystatechange = function () {
			if(komentarisi.readyState == 4 && komentarisi.status == 200) {
				getDetails(id);
			}
		}

		komentarisi.open("GET", "komentar.php?ime=" + ime + "&mail=" + mail + "&komentar=" + komentar + "&id=" + id, true);
		komentarisi.send();
	}
}

function login(){
	var forma = document.getElementById('lf');

	var user = forma.uname.value;
	var pw = forma.sifra.value;

	var loginReq = new XMLHttpRequest();

	loginReq.onreadystatechange = function () {
		if(loginReq.readyState == 4 && loginReq.status == 200) {
			if(loginReq.responseText == "Greška!")
				document.getElementById('ep2_login').style.visibility = "visible";
				else {
					if(loginReq.responseText != "Već ste prijavljeni - odjavite se ili nastavite ka Admin-panelu")
						getContent("panel.php");
					alert(loginReq.responseText);
				}
		}
	}

	loginReq.open("POST", "login.php", true);
	loginReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	loginReq.send("username=" + user + "&pw=" + pw);
}

function logout(){
	var loginReq = new XMLHttpRequest();

	loginReq.onreadystatechange = function () {
		if(loginReq.readyState == 4 && loginReq.status == 200) {
			alert('Uspješno ste odjavljeni!');
			getNews();
		}
	}

	loginReq.open("POST", "logout.php", true);
	loginReq.send();
}

function dodajKorisnika() {
	var forma = document.getElementById("korf");

	var userReg = /^[a-zšđčćž_0-9]+$/i;
	var emailReg = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
	var pwReg = /^[a-zšđčćž_0-9]{5,}$/i;
	var valid = true;
	document.getElementById("ep1_korisnici").style.visibility = "hidden";

	if (!userReg.test(forma.uname.value))
	{
		document.getElementById("ep1_korisnici").style.visibility = "visible";
		valid = false;
	}

	if (!emailReg.test(forma.mail.value) || forma.mail.value == "")
	{
		document.getElementById("ep1_korisnici").style.visibility = "visible";
		valid = false;
	}

	if (!pwReg.test(forma.sifra.value) || forma.sifra.value == "")
	{
		document.getElementById("ep1_korisnici").style.visibility = "visible";
		valid = false;
	}

	if(valid)
	{
		user = forma.uname.value;
		pw = forma.sifra.value;
		mail = forma.mail.value;
		var dodaj = new XMLHttpRequest();

		dodaj.onreadystatechange = function () {
			if(dodaj.readyState == 4 && dodaj.status == 200) {
				alert(dodaj.responseText);
			}
		}

		dodaj.open("POST", "novi_korisnik.php", true);
		dodaj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		dodaj.send("username=" + user + "&pw=" + pw + "&mail=" + mail);
	}
}

function obrisiKorisnika(){
	var forma = document.getElementById('kor_edit');
	var username = forma.korisnik.value;

	var brisi = new XMLHttpRequest();

		brisi.onreadystatechange = function () {
			if(brisi.readyState == 4 && brisi.status == 200) {
				alert(brisi.responseText);
			}
		}

		brisi.open("POST", "brisi.php", true);
		brisi.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		brisi.send("username=" + username);
	}

}

document.getElementById("bod").addEventListener("load", getNews(), false);
document.getElementById("logo").addEventListener("click", function(){ getNews(); }, false);
document.getElementById("m1").addEventListener("click", function(){ getNews(); }, false);
document.getElementById("m2-1").addEventListener("click", function(){ getNekretnine("stan"); }, false);
document.getElementById("m2-2").addEventListener("click", function(){ getNekretnine("kuca"); }, false);
document.getElementById("m2-3").addEventListener("click", function(){ getNekretnine("poslovni"); }, false);
document.getElementById("m4-1").addEventListener("click", function(){ getContent("agenti.html"); }, false);
document.getElementById("m4-2").addEventListener("click", function(){ getContent("kontakt.html"); }, false);
document.getElementById("m5").addEventListener("click", function(){ getContent("linkovi.html"); }, false);
document.getElementById("m6").addEventListener("click", function(){ getContent("login_form.php"); }, false);
document.getElementById("m7").addEventListener("click", function(){ getContent("panel.php"); }, false);
