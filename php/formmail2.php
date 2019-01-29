<?php
/* Remplacer votre_adresse@mail.net par votre adresse mail
   Remplacer www.votre_domaine.net par votre nom de domaine */

$adresse = "contact@cava-cebazat.fr";
$site = "cava-cebazat.fr";

$TO = $adresse;

$head = "From: ".$adresse."\n";
$head .= "X-Sender: <".$adresse.">\n";
$head .= "X-Mailer: PHP\n";
$head .= "Return-Path: <".$adresse.">\n";
$head .= "Content-Type: text/plain; charset=iso-8859-1\n";

$sujet = "Formulaire de contact";

$informations = "
Nom: ".$_POST['realname']." \r\n
Email du formulaire: ".$_POST['email']." \r\n
Sujet du formulaire: ".$_POST['title']."\r\n
Message: ".$_POST['comments']." \r\n
";






// debut mise en place recaptcha

    	
	// Ma clé privée
	$secret = "6Ld9WI0UAAAAAIhjiWBq6dTSaarhexGZVXGBajhz";
	// Paramètre renvoyé par le recaptcha
	$response = $_POST['g-recaptcha-response'];
	// On récupère l'IP de l'utilisateur
	$remoteip = $_SERVER['REMOTE_ADDR'];
	
	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
	
	if ($decode['success'] == true) {
		// C'est un humain
		$res = mail($TO, $sujet ,$informations, $head);
		Header("Location: http://".$site."/html/formail2_ok.html" );
	}
	
	else {
		// C'est un robot ou le code de vérification est incorrecte
		Header("Location: http://".$site."/html/formail2_pasok.html" );
	}
		



//  fin de mise en place recaptcha
?>



