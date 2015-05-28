<?php
session_start();

function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

if(!isset($_SESSION['username']))
	print "Niste prijavljeni!";
else {
	$host = "localhost";
	$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");

	$upit = $dbconnection->prepare("INSERT INTO korisnik (username, mail, password) VALUES (?, ?, MD5(?))");

	$upit->bindParam(1, dajUredno($_POST['username']));
	$upit->bindParam(2, dajUredno($_POST['mail']));
	$upit->bindParam(3, dajUredno($_POST['pw']));

	if(!$upit->execute())
		print "Došlo je do greške! (korisnik već postoji u bazi)";
	else print "Uspješno dodan korisnik!";
}
?>