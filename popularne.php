<?php
function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

print "<section>
	<h2>O nama</h2>
	<p>Agencija za nekretnine <i>New Home</i> specijalizirana je za posredovanje kod kupoprodaje i iznajmljivanje svih
	 vrsta nekretnina. Agencija djeluje na području cijele BiH. Zaposleni agenti su stručnjaci
	 sa položenim ispitom za agente u posredovanju i prometu nekretninama. Naši glavni cilj je da Vi uz našu pomoć 
	 nađete Vaš Novi Dom!</p>
</section><div class='content'><h2>Nove nekretnine</h2>";
$host = "localhost";
$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");

$upit = $dbconnection->prepare("SELECT id, grad, adresa, naslov, opis, tekst, agent, slika, UNIX_TIMESTAMP(vrijeme) vr FROM nekretnina ORDER BY vrijeme DESC");

if(!$upit->execute())
    print "<h3>".$upit->errorInfo()."</h3>";

$nekretnine = $upit->fetchAll();

$upit2 = $dbconnection->prepare("SELECT COUNT(*) as broj FROM komentar WHERE vijest=?");

foreach ($nekretnine as $nove) {
    $upit2->bindParam(1, $nove['id']);
    if(!$upit2->execute())
        print "<h3>".$upit->errorInfo()."</h3>";
    $broj_komentara = $upit2->fetchColumn();
   
    print "<div class='nekretnina'>
    <img class='nekretnina' src='".$nove['slika']."' alt='Nekretnina'>
    <h3 class='nekretnina'>".ucfirst(strtolower($nove['naslov']))."</h3>
    <p class='detalji'>Grad: ".$nove['grad']."<br>Adresa: ".$nove['adresa']."</p>
    <p class='nekretnina'>".$nove['opis'];
    if(!is_null($nove['tekst'])) print "<br> <a onclick=\"getDetails('".$nove['id']."')\" href='#'>Detalji...</a>";
    print "<br> <a onclick=\"getDetails('".$nove['id']."')\" href='#'>Pitanja (".$broj_komentara.")</a></p>";
    print "<p class='detalji'>Datum objave: ".date("d.m.Y. (h:i)", $nove['vr'])."<br>Agent: ".$nove['agent']."</p>
    </div>";
}

print "</div>";

?>