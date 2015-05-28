<?php
function dajUredno($unos)
{
	$unos = trim($unos);
	$unos = stripslashes($unos);
	$unos = htmlspecialchars($unos);
	return $unos;
}

$idVijesti = $_GET['id'];
$ime = dajUredno($_GET['ime']);
$mail = dajUredno($_GET['mail']);
$komentar = dajUredno($_GET['komentar']);

if ($mail == "") $mail = NULL;

$host="localhost";
$dbconnection = new PDO("mysql:dbname=newhomedb;host=".$host.";charset=utf8", "newhomeuser", "vatoN1");
$upit = $dbconnection->prepare("INSERT INTO komentar (vijest, autor, mail, tekst) VALUES (?, ?, ?, ?)");
$upit->bindParam(1, $idVijesti);
$upit->bindParam(2, $ime);
$upit->bindParam(3, $mail);
$upit->bindParam(4, $komentar);

$upit->execute();
?>