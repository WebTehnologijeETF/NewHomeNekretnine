<?php

session_start();

print "<div class='content'>";

if(isset($_SESSION['username'])){
	print "<h2>Već ste prijavljeni (".$_SESSION['username'].")</h2>";
	print "<button id='submit_but' type='button' onclick='logout()'>Odjava</button>";
}
else {
	print "<h2>Unesite login podatke</h2>
		<form name='loginforma' id='lf' action='#'' method='POST'>
			Korisničko ime:<br>
			<input type='text' name='uname' id='unameid'>
			<br><br>
			Šifra:<br>
			<input type='text' name='sifra' id='sifraid'>
			<div class='ep' id='ep2_login'><img src='resources/error.png' alt='error'>Pogrešno korisničko ime ili šifra!</div>
			<br><br>
			<button id='submit_but' type='button' onclick='login()''>Login</button>
			<br><br>
		</form>
	</div>";
}
?>