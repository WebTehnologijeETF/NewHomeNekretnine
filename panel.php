<?php
session_start();

if(!isset($_SESSION['username']))
	print "<div class='content'><h2>Niste prijavljeni!</h2></div>";
else {
	print "<div class='content'>
	<h2>Korisnici</h2>
	<form name='korisnici' id='korf' action='#' method='POST'>
		Korisničko ime:*<br>
		<input type='text' name='uname' id='unameid'><br><br>
		E-Mail:*<br>
		<input type='text' name='mail' id='mailid'><br><br>
		Šifra:*<br>
		<input type='text' name='sifra' id='sifraid'><br><br>
		<div class='ep' id='ep1_korisnici'><img src='resources/error.png' alt='error'>Jedno od polja nije popunjeno ili je popunjeno neispravno! (Username i šifra smiju da sadrže samo slova, brojeve i znak '_', dok šifra treba biti duga barem 5 znakova)</div>
		<br><br>
		<button id='submit_but' type='button' onclick='dodajKorisnika()'>Dodaj korisnika!</button>
	</form>
</div>";
}
?>
