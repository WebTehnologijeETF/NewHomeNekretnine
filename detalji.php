<?php
print "<div class='content'><h2>Popularne nekretnine</h2>";

function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

$id = dajUredno($_GET['novost']);

$host = "localhost";
$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");
$upit = $dbconnection->prepare("SELECT id, grad, adresa, naslov, opis, tekst, agent, slika, UNIX_TIMESTAMP(vrijeme) vr FROM nekretnina WHERE id=?");
$upit->bindParam(1, $id);

if(!$upit->execute())
    print "<h3>".$upit->errorInfo()."</h3>";

$nekretnine = $upit->fetchAll();
$nove = $nekretnine[0];

print "<div class='nekretnina'>
<img class='nekretnina' src='".$nove['slika']."' alt='Nekretnina'>
<h3 class='nekretnina'>".ucfirst(strtolower($nove['naslov']))."</h3>
<p class='detalji'>Grad: ".$nove['grad']."<br>Adresa: ".$nove['adresa']."</p>";
if(is_null($nove['tekst'])) print "<p class='nekretnina'>".$nove['opis']."</p>";
else print "<p class='nekretnina'>".$nove['tekst']."</p>";
print "<p class='detalji'>Datum objave: ".date("d.m.Y. (h:i)", $nove['vr'])."<br>Agent: ".$nove['agent']."</p>
</div>";

$upit2 = $dbconnection->prepare("SELECT id, vijest, autor, mail, tekst, UNIX_TIMESTAMP(vrijeme) vr FROM komentar WHERE vijest=?");
$upit2->bindParam(1, $id);

if(!$upit2->execute())
    print "<h3>".$upit2->errorInfo()."</h3>";

$komentari = $upit2->fetchAll();

foreach ($komentari as $komentar) {
	print "<div class='komentar1'>
	<h3 class='nekretnina'>".$komentar['autor']."</h3>";
	if(!is_null($komentar['mail'])) print "<p class='detalji'><a href='mailto:".$komentar['mail']."'>".$komentar['mail']."</a></p>";
	print "<p class='detalji'>".$komentar['tekst']."</p>
	<p class='detalji'>".date("d.m.Y. (h:i)", $komentar['vr'])."</p>
	</div>";
}

print "<div class='komentar2'>
		<h3 class='nekretnina'>Postavite pitanje ^-^</h3>
		<form name='komentarforma' id='komf'>
			<br>Ime:*<br>
			<input type='text' name='ime' id='ime_kom'>
			<div class='ep' id='ep1_kom'><img src='resources/error.png' alt='error'>Unesite validno ime!</div><br><br>
			E-mail:<br>
			<input id='mailtb_kom' type='email' name='mail'>
			<div class='ep' id='ep3_kom'><img src='resources/error.png' alt='error'>Unesite validan mail!</div><br><br>
			Poruka:*<br>
			<textarea id='kom' name='poruka' rows='3' cols='30'></textarea>
			<div class='ep' id='ep6_kom'><img src='resources/error.png' alt='error'>Unesite poruku!</div><br><br>
			<button id='koment' type='button' onclick=\"sendComment('".$id."')\">Pošalji</button>
		</form>
	</div>"

?>