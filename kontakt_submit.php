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

<body id="bod">
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

//uredjuje unos (xss protekcija)
function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

$ime = dajUredno($_POST['ime']);
$prezime = dajUredno($_POST['prezime']);
$mail = dajUredno($_POST['mail']);
$telefon = dajUredno($_POST['telefon']);
$grad = dajUredno($_POST['grad']);
$pbroj = dajUredno($_POST['pbroj']);
$poruka = dajUredno($_POST['poruka']);

//regexvarijable
$textReg = "/^[a-zšđčćž]+$/i";
$emailReg = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i";
$telReg = "/^\+{0,1}[0-9]+[\/-]{0,1}[0-9-]+$/";
$numReg = "/^[0-9]+$/i";

//validacija
$validno = true;

if(!preg_match($textReg, $ime))
	$validno = false;

if(!preg_match($textReg, $prezime))
	$validno = false;

if(!preg_match($emailReg, $mail))
	$validno = false;

if($telefon != "")
	if(!preg_match($telReg, $telefon))
		$validno = false;

if(!preg_match($textReg, $grad))
	$validno = false;

if(!preg_match($numReg, $pbroj))
	$validno = false;

if($poruka === "")
	$validno = false;

if(!$validno)
	print "<h2>Unos nije validan!</h2>";
else{
	$_SESSION['ime'] = $ime;
	$_SESSION['prezime'] = $prezime;
	$_SESSION['mail'] = $mail;
	$_SESSION['mlist'] = $_POST['maillist'];
	if($telefon != "") $_SESSION['telefon'] = $telefon;
	$_SESSION['grad'] = $grad;
	$_SESSION['pbroj'] = $pbroj;
	$_SESSION['poruka'] = $poruka;

	print "<h2>Provjerite da li ste ispravno popunili kontakt formu</h2>";
	print "<p>Ime i prezime: <p class='pregled'>".$ime." ".$prezime."</p></p><br>";
	print "<p>E-mail: <p class='pregled'>".$mail."</p></p><br>";
	if($telefon != "")
		print "<p>Broj telefona: <p class='pregled'>".$telefon."</p></p><br>";
	print "<p>Grad i poštanski broj: <p class='pregled'>".$grad.", ".$pbroj."</p></p><br>";
	print "<p>Poruka: <p class='pregled'>".$poruka."</p></p><br>";
	print "<p class='pregled'>Da li ste sigurni da želite poslati ove podatke?</p><br>";
	print "<form method='POST' action='posalji.php'><button name='send' id='send_mail' type='submit'>Siguran sam</button></form><br><br>";

	print "<h2>Ako ste pogrešno popunili formu, možete ispod prepraviti unesene podatke</h2>";
}

//ovdje prepraviti kod za slanje emaila
?>

	<form name="kontaktForma" id="kf" action="kontakt_submit.php" onsubmit="return validiraj();" method="POST">
		Ime:*<br>
		<input type="text" name="ime" id="ime" value=<?=$ime;?>>
<?php
if(!preg_match($textReg, $ime))
	print "<div class='ep' id='ep1' style='visibility:visible'><img src='resources/error.png' alt='error'>Unesite validno ime!</div>";
else print "<div class='ep' id='ep1'><img src='resources/error.png' alt='error'>Unesite validno ime!</div>";
?>
		<br><br>
		Prezime:*<br>
		<input type="text" name="prezime" value=<?=$prezime;?>>
<?php
if(!preg_match($textReg, $prezime))
	print "<div class='ep' id='ep2' style='visibility:visible'><img src='resources/error.png' alt='error'>Unesite validno prezime!</div>";
else print "<div class='ep' id='ep2'><img src='resources/error.png' alt='error'>Unesite validno prezime!</div>";
?>
		<br><br>
		E-mail:*<br>
		<input id="mailtb" type="email" name="mail" onchange="validirajMail()" value=<?=$mail;?>>
<?php
if(!preg_match($emailReg, $mail))
	print "<div class='ep' id='ep3' style='visibility:visible'><img src='resources/error.png' alt='error'>Unesite validnu e-mail adresu!</div>";
else print "<div class='ep' id='ep3'><img src='resources/error.png' alt='error'>Unesite validnu e-mail adresu!</div>";
?>
		<br>
		<input id="cb" type="checkbox" disabled<?php if(preg_match($emailReg, $mail)) print "=false";?> name="maillist">Želim biti na New Home mailing listi i dobijati obavještenja o novim i popularnim nekretninama!
		<br><br>
		Broj telefona:<br>
		<input type="tel" name="telefon" value=<?=$telefon;?>>
<?php
	if($telefon != "")
		if(!preg_match($telReg, $telefon))
			print "<div class='ep' id='ep4' style='visibility:visible'><img src='resources/error.png' alt='error'>Unesite validan broj telefona!</div>";
		else print "<div class='ep' id='ep4'><img src='resources/error.png' alt='error'>Unesite validan broj telefona!</div>";
?>
		<br><br>
		Grad:*<br>
		<input id="gr" list="gradovi" name="grad" onblur="validirajServis()" value=<?=$grad;?>>
			<datalist id="gradovi">
				<option value="">Sarajevo</option>
				<option value="">Banja Luka</option>
				<option value="">Tuzla</option>
				<option value="">Zenica</option>
				<option value="">Mostar</option>
				<option value="">Bihać</option>
				<option value="">Trebinje</option>
			</datalist>
		<br><br>
		Poštanski broj:*<br>
		<input id="pb" type="text" name="pbroj" onblur="validirajServis()" value=<?=$pbroj;?>>
<?php
	if(!preg_match($textReg, $grad))
		if(!preg_match($numReg, $pbroj))
			print "<div class='ep' id='ep5' style='visibility:visible'><img src='resources/error.png' alt='error'>Grad i poštanski broj moraju odgovarati jedan drugom i moraju biti validni!</div>";
		else print "<div class='ep' id='ep5'><img src='resources/error.png' alt='error'>Grad i poštanski broj moraju odgovarati jedan drugom i moraju biti validni!</div>";
?>
		
		<br><br>
		Poruka:*<br>
		<textarea name="poruka" rows="10" cols="70" value=<?=$poruka;?>></textarea>
<?php
if($poruka === "")
	print "<div class='ep' id='ep6' style='visibility:visible'><img src='resources/error.png' alt='error'>Unesite poruku!</div>";
else print "<div class='ep' id='ep6'><img src='resources/error.png' alt='error'>Unesite poruku!</div>";
?>
		<br><br>
		<button id="submit_but" type="submit">Pošalji</button>
		<button id="reset" type="reset">Poništi</button>
	</form>
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