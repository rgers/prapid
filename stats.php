<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-type" content="text/html;
              charset=utf-8" />
        <title>Statystyki</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
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
    </head>
    <body>
<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';
$query = "SELECT * FROM users";
$result = mysql_query($query);
$num = mysql_numrows($result);
echo "Zarejestrowanych ".$num." użytkowników.<br />";
$query = "SELECT * FROM files";
$result = mysql_query($query);
$num = mysql_numrows($result);
echo "Na dyskach ".$num." plików zajmujących ";
$dane =0;
for($a=0;$a<$num;$a++)
{
    $rozpliku = mysql_result($result,$a,"size");
    $dane = $dane + $rozpliku;
}
$dane = ($dane/1024)/1024;

echo round($dane,2)." megabajtów.";
mysql_close($mysql_db_link);
?>
    </body>
</html>
