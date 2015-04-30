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


document.getElementById("agentiURL").addEventListener("click", function(){ getContent("agenti.html"); }, false);
document.getElementById("logo").addEventListener("click", function(){ getContent("pocetna.html"); }, false);
document.getElementById("m1").addEventListener("click", function(){ getContent("pocetna.html"); }, false);
document.getElementById("m4-1").addEventListener("click", function(){ getContent("agenti.html"); }, false);
document.getElementById("m4-2").addEventListener("click", function(){ getContent("kontakt.html"); }, false);
document.getElementById("m5").addEventListener("click", function(){ getContent("linkovi.html"); }, false);
