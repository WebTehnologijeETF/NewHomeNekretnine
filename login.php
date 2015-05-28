<?php
session_start();

function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	print "Već ste prijavljeni - odjavite se ili nastavite ka Admin-panelu";
}
else if (isset($_POST['username'])) {
	$username = dajUredno($_POST['username']);
	$password = dajUredno($_POST['pw']);
	$host = "localhost";
	$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");
	$upit = $dbconnection->prepare("SELECT username, password FROM korisnik WHERE (username=? AND password=md5(?))");
	$upit->bindParam(1, $username);
	$upit->bindParam(2, $password);
	$upit->execute();

	$user = $upit->fetchAll();
	if($user[0]['username'] == $username){
		print "Dobrodošli!";
		$_SESSION['username'] = $username;
	}
	else print "Greška!";
}
?>