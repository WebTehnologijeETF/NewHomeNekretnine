<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>New Home Početna</title>
	<link rel="stylesheet" href="styles.css">
	<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link rel="icon" type="image/png" href="resources/favicon.png">
</head>

<body>
<header>
		<div id="logo">
			<a href="#">
				<img class="logo" src="resources/logo.png" alt="Logo">
			</a>
		</div>
		
		<div id="header">
			<h3 id="logonaslov">New Home Realestate</h3>
		</div>

		<nav>
			<ul id="menu">
				<li><a id="m1" href="#">Početna</a></li>
				<li><a id="m2" href="javascript:void(0);">Nekretnine</a></li>
				<li><a id="m3" href="#">Pretraga</a></li>
				<li><a id="m4" href="javascript:void(0);">Kontakt</a></li>
				<li><a id="m5" href="#">Linkovi</a></li>
			</ul>
		</nav>
</header>

<div class="subMenus">
	<div class="menuList" id="sm1">
		<ul class="subList">
		</ul>
	</div>
	<div class="menuList" id="sm2">
		<ul class="subList">
			<li id="m2-1"><a href="#" class="subItem">Stanovi</a></li>
			<li id="m2-2"><a href="#" class="subItem">Kuće</a></li>
			<li id="m2-3"><a href="#" class="subItem">Poslovni prostori</a></li>
		</ul>
	</div>
	<div class="menuList" id="sm3">
		<ul class="subList">

		</ul>
	</div>
	<div class="menuList" id="sm4">
		<ul class="subList">
			<li id="m4-1"><a href="#" class="subItem">Agenti i poslovnice</a></li>
			<li id="m4-2"><a href="#" class="subItem">Kontakt forma</a></li>
		</ul>
	</div>
	<div class="menuList" id="sm5">
		
	</div>
</div>

<div class="wrapper" id="content">

<div class="content">

<?php
session_start();

function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

$ime = dajUredno($_SESSION['ime']);
$prezime = dajUredno($_SESSION['prezime']);
$mail = dajUredno($_SESSION['mail']);
$telefon = dajUredno($_SESSION['telefon']);
$grad = dajUredno($_SESSION['grad']);
$pbroj = dajUredno($_SESSION['pbroj']);
$poruka = dajUredno($_SESSION['poruka']);
$to = "tdemirovic1@etf.unsa.ba";
$cc = "tdemirovic1@etf.unsa.ba";

$naslov = "Poruka sa kontakt forme - ".$ime." ".$prezime;
$header = "From: ".$mail."\r\n"."Cc: ".$cc."\r\n"."Reply-To: ".$mail."\r\n"."Content-Type: text/html; charset=\"UTF-8\""."\r\n";

$sadrzaj = "Korisnik: ".$ime." ".$prezime."\r\n";
$sadrzaj .= "Grad: ".$grad." ".$pbroj."\r\n";
$sadrzaj .= "Kontakt: ".$mail.", ".$telefon."\r\n"."\r\n";
$sadrzaj .= "Poruka:"."\r\n".$poruka;

mail($to, $naslov, $sadrzaj, $header);
print "<br><h2>Zahvaljujemo se što ste nas kontaktirali</h2><br>";
print "<a href='index.html' id='back'>Vrati se na početnu</a>";
?>

</div>

</div>

<footer>
	<p class="footer">Tarik Demirović</p>
	<p class="footer">demirovict@gmail.com</p>
</footer>

<script src="js/scripts.js"></script>
<script src="js/transitions.js"></script>
<script src="js/nekretnine.js"></script>
<script src="js/validation.js"></script>

</body>

</html>