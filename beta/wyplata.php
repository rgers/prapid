<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Wypłata</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.0.css" type="text/css" media="screen" />
	 <?php include 'jsfuncs.php'; ?>
</head>
<body>
<?php

include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
?>
   
        <?php
        if(round($sppoints*$przelicznik,2)<10)
        {
            echo "Aby wypłacić pieniądze musisz mieć conajmniej 10PLN na koncie.";
            echo "Aktualnie masz ".round($sppoints*$przelicznik,2)."PLN";
            exit(0);
        }
        ?>
        <div id="wyplata_txt">
            Podaj swój adres e-mail:<br />
            <input type="TEXT" id="emil" value="<?php echo $ulogin;?>" />
        <input type="button" id="wyplata_btn" value="Zgadza się." OnClick="wyplata_clk()"/>
    </div>
</body>
</html>