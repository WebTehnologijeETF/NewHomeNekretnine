function getContent(url){
	var content = new XMLHttpRequest();

	content.onreadystatechange = function () {
		if(content.readyState == 4 && content.status == 200) {
			document.getElementById("content").innerHTML = content.responseText;
			if(url == "stanovi.html")
				dobaviStanove();
		}
	}

	content.open("GET", url, true);
	content.send();
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

document.getElementById("bod").addEventListener("load", getNews(), false);
document.getElementById("logo").addEventListener("click", function(){ getNews(); }, false);
document.getElementById("m1").addEventListener("click", function(){ getNews(); }, false);
document.getElementById("m2-1").addEventListener("click", function(){ getContent("stanovi.html"); }, false);
document.getElementById("m2-2").addEventListener("click", function(){ getContent("stanovi.html"); }, false);
document.getElementById("m2-3").addEventListener("click", function(){ getContent("stanovi.html"); }, false);
document.getElementById("m4-1").addEventListener("click", function(){ getContent("agenti.html"); }, false);
document.getElementById("m4-2").addEventListener("click", function(){ getContent("kontakt.html"); }, false);
document.getElementById("m5").addEventListener("click", function(){ getContent("linkovi.html"); }, false);
