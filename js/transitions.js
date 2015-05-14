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

function getDetails(path){
	var details = new XMLHttpRequest();

	details.onreadystatechange = function () {
		if(details.readyState == 4 && details.status == 200) {
			document.getElementById("content").innerHTML = details.responseText;
		}
	}

	details.open("GET", "detalji.php?novost=" + path, true);
	details.send();
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
