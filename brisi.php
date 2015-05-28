<?php
session_start();

if(isset($_SESSION['username']) && isset($_POST['username'])){
	$host = "localhost";
	$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");

	$upit = $dbconnection->prepare("DELETE FROM korisnik WHERE username = ?");
	$upit->bindParam(1, $_POST['username']);
	if(!$upit->execute())
		print "Greška!";
	else print "Korisnik je obrisan!";
}
?>