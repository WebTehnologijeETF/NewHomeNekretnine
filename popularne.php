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
</section><div class='content'><h2>Popularne nekretnine</h2>";

$dir = 'popNekretnine';

foreach (scandir($dir) as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue;

    $path = "popNekretnine/".$file;
    $novost = file($path);

    //regex za validaciju
    $dateReg = "/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}\.$/i";
    $timeReg = "/^[0-9]{2}\:[0-9]{2}\:[0-9]{2}$/i";
    $textReg = "/^[a-zšđčćž ]+$/i";
    $upperReg = "/^[A-ZŠĐČĆŽ ]+$/";

    $valid = true;
    
    //prva linija
    $prva = explode(" ",trim($novost[0]));
    if(!preg_match($dateReg, $prva[0]))
    	continue;

    if(!preg_match($timeReg, $prva[1]))
    	continue;

    $datum = dajUredno($prva[0]);
    $vrijeme = dajUredno($prva[1]);

    //druga linija
    $ime = dajUredno($novost[1]);
    if(!preg_match($textReg, $ime))
    	continue;

    //treća
    $naslov = dajUredno($novost[2]);
    if(!preg_match($upperReg, $naslov))
    	continue;

    //četvrta
    $slika = dajUredno($novost[3]);

    //peta
    $otekst = "";
    $j = 4;
    if($novost[4] == "")
    	continue;

   while($j < count($novost)){
    	$otekst .= $novost[$j];
    	$j++;
    	if($novost[$j] == "--\n")
    		break;
    }

    $otekst = dajUredno($otekst);


    if($j == count($novost)){
		print "<div class='nekretnina'>
		<img class='nekretnina' src='".$slika."' alt='Nekretnina'>
		<h3 class='nekretnina'>".ucfirst(strtolower($naslov))."</h3>
		<p class='nekretnina'>".$otekst."</p>
		<p class='detalji'>Datum objave: ".$datum." ".$vrijeme."<br>Agent: ".$ime."</p>
	</div>";
	continue;
    }
    else{
		print "<div class='nekretnina'>
		<img class='nekretnina' src='".$slika."' alt='Nekretnina'>
		<h3 class='nekretnina'>".ucfirst(strtolower($naslov))."</h3>
		<p class='nekretnina'>".$otekst." <a onclick=\"getDetails('".$path."')\" href='#'>Detalji...</a></p>
		<p class='detalji'>Datum objave: ".$datum." ".$vrijeme."<br>Agent: ".$ime."</p>
	</div>";
    }

	$j++;
	$tekst = "";

	while($j < count($novost)){
    	$tekst .= $novost[$j];
    	$j++;
    }

    $tekst = dajUredno($tekst);

    if($j == count($novost))
    		continue;
}
print "</div>";

?>