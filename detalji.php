<?php
print "<div class='content'><h2>Popularne nekretnine</h2>";

$path = $_GET['novost'];

function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

$novost = file($path);

$prva = explode(" ",trim($novost[0]));
$datum = dajUredno($prva[0]);
$vrijeme = dajUredno($prva[1]);

//druga linija
$ime = dajUredno($novost[1]);

//treća
$naslov = dajUredno($novost[2]);

//četvrta
$slika = dajUredno($novost[3]);

//peta
$otekst = "";
$j = 4;
if($novost[4] == "")
	return;

while($j < count($novost)){
	$otekst .= $novost[$j];
	$j++;
	if($novost[$j] == "--\n")
		break;
}

$otekst = dajUredno($otekst);

$j++;
$tekst = "";

while($j < count($novost)){
	$tekst .= $novost[$j];
	$j++;
}

$tekst = dajUredno($tekst);

print "<div class='nekretnina'>
		<img class='nekretnina' src='".$slika."' alt='Nekretnina'>
		<h3 class='nekretnina'>".ucfirst(strtolower($naslov))."</h3>
		<p class='nekretnina'>".$tekst." </p>
		<p class='detalji'>Datum objave: ".$datum." ".$vrijeme."<br>Agent: ".$ime."</p>
	</div><br><br><a id='bek' onclick='getNews()' href='#'>Nazad na početnu...</a>";

print "</div>";

if($j == count($novost))
		return;
?>