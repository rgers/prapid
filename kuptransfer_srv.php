<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$fid=$_GET['plik'];
if (!$zalogowany)
{
header( 'Location: http://'.$domain.'/sciagajszybko.php?plik='.$fid ) ;
}
if ($_GET['typ']=="przelew")
    {
    header('Location: http://ssl.dotpay.pl/?id=22550&kwota='.$_GET['koszt'].'&opis=TransferPremium&kanal=1&URL="http://'.$domain.'/potwierdzeniezaplaty.php?plik='.$fid.'"&type=3&txtguzik="Powrót do PolskiRapid"&email='.$ulogin);
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Transfer Premium</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		 table td {
			width: 250px;
			white-space: nowrap;
			padding-right: 0px;
		}
		 table tr:nth-child(2n+1) {
			background-color: #EEEEEE;
		}
		 table td:first-child {
			font-weight: bold;
		}

table td:nth-child(2) {
			font-weight: bold;
}
		 table td:nth-child(3) {
			text-align: right;
			font-family: monospaced;
		}

	</style>
</head>
<body>
    <?php
include 'menu.php';
if(isset($_POST['kod']))
    {
    echo "<div style='width:800; margin-left:auto; margin-right:auto; text-align:center'>";
    $kod = $_POST['kod'];
    $koszt = $_POST['koszt'];
    switch ($koszt)
    {
        case 1:
        $query = "SELECT * FROM kody1 WHERE kod='$kod'";
        break;
    case 2:
        $query = "SELECT * FROM kody2 WHERE kod='$kod'";
        break;
    case 3:
        $query = "SELECT * FROM kody3 WHERE kod='$kod'";
        break;
    case 9:
        $query = "SELECT * FROM kody9 WHERE kod='$kod'";
        break;
    }
    $result = mysql_query($query);
    $num = mysql_numrows($result);
    if ($num>0)
        {
        $czas = mysql_result($result,0,'czas');
        if($czas>0)
            {
            echo "Ten kod już został użyty ".date("d-m-Y",$czas)." o godzinie ".date("H:i",$czas);
            echo "</div>";
            exit();
        }
        
switch ($koszt)
        {
    case 1:
        $query = "UPDATE users SET bandwidth='".($bw+1024)."' WHERE uid='$uid'";
        break;
    case 2:
        $query = "UPDATE users SET bandwidth='".($bw+2048)."' WHERE uid='$uid'";
      break;
    case 3:
        $query = "UPDATE users SET bandwidth='".($bw+3072)."' WHERE uid='$uid'";
        break;
    case 9:
        $query = "UPDATE users SET bandwidth='".($bw+15360)."' WHERE uid='$uid'";
        break;
        }
        mysql_query($query);
        $query = "UPDATE kody".$koszt." SET czas='".time()."' WHERE kod='$kod'";
        mysql_query($query);
        echo "Transfer premium został dodany do Twojego konta.<br />";
        if($fid)
            {
        $query = "SELECT * FROM files WHERE id='$fid'";
        $result = mysql_query($query);
        
        echo "<a href='http://".$domain."/download.php?plik=".$fid."'>Kliknij tutaj aby ściągnąć plik ".mysql_result($result,0,'name');
            }
    }else{
        echo "Kod błędny.";
        
    }
    echo "</div>";

}
if ($_GET['typ']=="sms")
    {
?>
    <div style="width:750px; margin-left:auto; margin-right:auto">
    <h1>Aby otrzymać kod dostępu wyślij SMS na numer 7<?php echo $_GET['koszt'];?>068 o treści AP.PRAPID<?php
    if($_GET['koszt']==2)
        {
        echo "2";
    }elseif($_GET['koszt']==3)
        {
        echo "3";
    }elseif($_GET['koszt']==9)
        {
        echo "15";
    }
    ?>
    </h1>
<br />
W ciągu paru sekund otrzymasz SMSa zwrotnego ze specjalnym kodem aktywującym dodatkowy transfer Premium.
Wystarczy, że wpiszesz ten kod poniżej i klikniesz na przycisk a zakupiony transfer zostanie dodany do Twojego konta.
<form method="POST" action="kuptransfer_srv.php?plik=<?php echo $fid;?>">
    <input type="hidden" name="koszt" value="<?php echo $_GET['koszt']?>">
<input type="text" name="kod">
<input type="submit" value="Zamień kod na transfer!">
</form>
Usługa działa w sieciach operatorów:
Plus GSM, Era, Orange, Play. Właściciel serwisu: kontakt@polskirapid.pl. Serwis SMS obsługuje Dotpay.pl. Koszt
przesłania wiadomości <?php echo ($_GET['koszt']*1.22);?> brutto. <a href=http://www.dotpay.pl/regulaminsms> Regulamin</a>.
    </div>
<?php
     } //end if
    ?>