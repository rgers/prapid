<?php
include 'vars.inc.php';
setcookie("polskirapid","", time()-3600,"/",".polskirapid.pl");
header( 'Location: http://'.$domain.'/up.php' );
?>
