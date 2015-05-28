<?php
session_start();

if(!isset($_SESSION['username']))
	print "<div class='content'><h2>Niste prijavljeni!</h2></div>";
else {
	print "<div class='content'>
	<h2>Dobro došli ".$_SESSION['username'].".</h2>
	<h2>Dodavanje novog korisnika</h2>
	<form name='korisnici' id='korf' action='#' method='POST'>
		Korisničko ime:*<br>
		<input type='text' name='uname' id='unameid'><br><br>
		E-Mail:*<br>
		<input type='password' name='mail' id='mailid'><br><br>
		Šifra:*<br>
		<input type='text' name='sifra' id='sifraid'><br>
		<div class='ep' id='ep1_korisnici'><img src='resources/error.png' alt='error'>Jedno od polja nije popunjeno ili je popunjeno neispravno! (Username i šifra smiju da sadrže samo slova, brojeve i znak '_', dok šifra treba biti duga barem 5 znakova)</div>
		<br>
		<button id='submit_but' type='button' onclick='dodajKorisnika()'>Dodaj korisnika!</button>
	</form><br><br>";

	$host = "localhost";
	$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");

	$upit = $dbconnection->prepare("SELECT * FROM korisnik");
	$upit->execute();

	$korisnici = $upit->fetchAll();

	print "<h2>Uređivanje korisnika</h2>
		<form name='korisnici_edit' id='kor_edit' action='#' method='POST'>
		Odaberite korisnika:
		<select name='korisnik' id='select'>";
			foreach ($korisnici as $korisnik) {
				if($korisnik['username'] == $_SESSION['username']) continue;
				print "<option value='".$korisnik['username']."'>".$korisnik['username']."</option>";
			}
	print "</select><br><br>
		Korisničko ime:*<br>
		<input type='text' name='uname' id='unameid'><br><br>
		E-Mail:*<br>
		<input type='text' name='mail' id='mailid'><br><br>
		Šifra:*<br>
		<input type='password' name='sifra' id='sifraid'><br>
		<div class='ep' id='ep1_korisnici'><img src='resources/error.png' alt='error'>Jedno od polja nije popunjeno ili je popunjeno neispravno! (Username i šifra smiju da sadrže samo slova, brojeve i znak '_', dok šifra treba biti duga barem 5 znakova)</div>
		<br>
		<button id='submit_but' type='button' onclick='azurirajKorisnika()'>Ažuriraj korisnika!</button>
		<button id='submit_but' type='button' onclick='obrisiKorisnika()'>Obriši korisnika!</button>
	</form><br><br>";
	print "</div>";

	//azuriranje korisnika
	//azuriranje vlastitih podataka
	//brisanje komentara
	//dodavanje, editovanje, brisanje nekretnina
}
?>
