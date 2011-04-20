<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-type" content="text/html;
              charset=utf-8" />
        <title>Prześlij Pliki</title>
        <!-- <link href="css/default.css" rel="stylesheet" type="text/css" /> -->
        <link href="css/uploadify.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.0.css" type="text/css" media="screen" />
     <style type="text/css">
            table table td {
                width: 250px;
                white-space: nowrap;
                padding-right: 5px;
            }
            table table tr:nth-child(2n+1) {
                background-color: #EEEEEE;
            }
            table table td:first-child {
                font-weight: bold;
            }

            table table td:nth-child(2) {
                text-align: right;
                font-family: monospaced;
            }

        </style>
    <?php include 'jsfuncs.php'; ?>
</head>

    <body>
        <?php
        include 'database.inc.php';
        include 'login_status.inc.php';
        include 'menu.php';?>
              <div style="width:1200px; margin-left: auto; margin-right: auto; border: thin solid; height: 800px;">
        <div id="content" style="float:left; text-align: center; width: 40%; margin-left: auto; margin-right: auto">

            <h2>Prześlij Pliki</h2>
	Zalogowany jako: <?php
            if ($zalogowany) {
                echo $ulogin;
            }else {
                echo "<a id='logup' href='zaloguj.php'>NIE ZALOGOWANY</a>";
}
mysql_close($mysql_db_link)
?>
        
          
                <p>Wybierz pliki do przesłania na serwer. Możesz wybrać wiele plików za jednym razem przytrzymując shift lub ctrl. Maksymalny rozmiar pliku to 1GB. Wysyłając pliki akceptujesz <a href="rules.php">regulamin serwisu</a>.</p>
<form id="form1" action="#" enctype="multipart/form-data" method="post">
                <div id="fileQueue"></div>
              <input type="file" name="uploadify" id="uploadify" />
<a href="javascript:jQuery('#uploadify').uploadifyClearQueue()">Anuluj wszystkie pliki</a>
</form>
<span id="response"></span>

        </div><div style="float:right; width: 59%; height: 150px; margin-left: auto; margin-right: auto; margin-top: auto; margin-bottom: auto; font-size: large; text-align: center;"><img src="images/zarobek.gif" style="float: right;" /><span style="float: left; top: 40px;">Umieszczaj pliki, dziel się nimi i zarabiaj!<br />Dostaniesz pieniądze
        za każdy megabajt ściągnięty z Twojego konta korzystając z transferu premium. Jeśli ktoś ściągnie 1GB (np. 1 film) dostaniesz za to 20gr. Jeśli ściągnie go 100 osób
        dostaniesz za to aż 20zł!<img src="images/kasa150px.gif" style="float: right;" /></span></div>
                   <div style="float:right; width: 40%; margin-left: auto; margin-right: 15%; margin-top: 20px;"> <div style="font-size:18px; with:800px; margin-left:auto; margin-right:auto; text-align:left">Co miesiąc najaktywniejsi użytkownicy dostają od nas nagrody. W tym miesiącu do wygrania:<ul><li>Odtwarzacz MP3 <b style="color:red">Apple iPod Nano 8GB</b> (miejsce 1.),</li>
    <li><b style="color:red">Pendrive Kingston Datatraveler DT100 8GB</b> (miejsce 2.)</li><li>oraz pakiety transferu premium <b style="color:red">200GB</b> (miejsce 3.),</li><li><b style="color:red">100GB</b> (miejsce 4.),</li><li><b style="color:red">50GB</b> (miejsce 5.),</li><li><b style="color:red">10GB</b> (miejsce 6.)</li><li>i <b style="color:red">5GB</b> (miejsce 7.)</li></ul> Nagrody są przyznawane o północy ostatniego dnia każdego miesiąca.<br /><br />
    Co zrobić, aby wygrać?<br />
    Wystarczy się zarejestrować (rejestracja jest darmowa) i aktywnie korzystać z serwisu polskirapid.pl. Za każdy wysłany megabajt dostajesz 1Pp (punkt premium). Jeśli ktoś ściąga za darmo plik wysłany przez Ciebie to za każdy ściągnięty megabajt również
    dostajesz 1Pp. Jeśli ktoś ściąga Twoje dane używając płatnego transferu premium to za każdy ściągnięty megabajt dostajesz 2Pp. Jeśli sam ściągasz korzystając z transferu
    premium to również dostajesz 2Pp za każdy megabajt. To takie proste. Nagrody są rozdawane wg klasyfikacji dokładnie o północy
    ostatniego dnia każdego miesiąca. Wtedy też punkty zostają wyzerowana, aby w każdym miesiącu każdy miał równe szanse. <a href="rules.php#konkurs">Regulamin konkursu</a>.
</div></div>
            </div>
        
      
        <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-329354-6");
pageTracker._trackPageview();
} catch(err) {}</script>
    </body>
</html>
