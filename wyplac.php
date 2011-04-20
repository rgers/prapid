<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
echo round($sppoints*$przelicznik,2)."PLN zostanie wypłacone za pośrednictwem PayPal w ciągu najbliższych 48 godzin.\n";
echo $sppoints." punktów SuperPremium zostanie odjętych z Twojego konta w chwili wypłaty pieniędzy";
mail("wyplata@polskirapid.pl","Wyplata - ".$ulogin, round($sppoints*$przelicznik,2)."PLN\n".$sppoints."SPP\nE-Mail: ".$_POST["emil"]);
?>
