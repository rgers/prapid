<?php
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
$fid=$_GET['plik'];
if ($zalogowany)
{
header( 'Location: http://'.$domain.'/kuptransfer.php?plik='.$fid ) ;
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
?>
    <div style="width:90%; margin-left:auto; margin-right:auto">
    <div style="float:left; witdth:300px">
        <p style="text-align:center">Zaloguj się</p>
        <form method="POST" action="login.php?frompage=sciagajszybko&plik=<?php echo $fid;?>">
            <table>
                <tr>
                    <td>
                        E-mail:
                    </td>
                    <td>
                        <input name="login" type="text" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Hasło:
                    </td>
                    <td>
                        <input name="password" type="password" />
                    </td>
                </tr>
                <tr style="height:30px"><td></td><td></td></tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <input type="submit" value="Zaloguj" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
        <div style="position:relative; left:50px; float:left">
            <h1>ALBO</h1>
        </div>
    <div style="float:right; witdth:300px">
        <p style="text-align:center">Utwórz nowe konto</p>
           <form method="POST" action="newuser.php?frompage=sciagajszybko&plik=<?php echo $fid;?>">
            <table>
                <tr>
                    <td>
                        E-mail:
                    </td>
                    <td>
                        <input name="login" type="text" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        Nick:
                    </td>
                    <td>
                        <input name="nick" type="text" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Hasło:
                    </td>
                    <td>
                        <input name="password" type="password" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <input type="submit" value="Utwórz konto" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
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