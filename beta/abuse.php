<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-type" content="text/html;
charset=utf-8" />
<title>Naruszenie zasad regulaminu</title>
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
$fid=$_GET['plik'];
include 'database.inc.php';
include 'login_status.inc.php';
include 'vars.inc.php';
include 'menu.php';
echo '<div id="content">';
$name = $_POST['name'];
$organization = $_POST['organization'];
$reason = $_POST['reason'];
$email = $_POST['email'];
$filehttp = $_POST['filehttp'];
if ($name && $organization && $reason && $filehttp && $email)
    {
    if ($_GET['plik']=="")
        {
    $fid = substr($_POST['filehttp'], -13, 13);

}
mail("abuse@polskirapid.pl", "Formularz WWW", $name."\n".$organization."\n".$email."\n".$reason."\n".$filehttp);
$query = "SELECT * FROM files WHERE id='".$fid."'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num>0) {
$query = "UPDATE files SET abuse='1' WHERE id='".$fid."'";
mysql_query($query);
echo "Zgłoszenie przyjęte. Dostęp do pliku został zablokowany. Zgłoszenie zostanie zweryfikowane w ciągu 48 godzin, jeśli okaże się zasadne plik zostanie usunięty z naszego serwera.";
mysql_close($mysql_db_link);
}else{
    echo "Wystąpił błąd podczas automatycznego blokowania dostępu do pliku. Mail z twoim zgłoszeniem został wysłany na abuse@polskirapid.pl. Zgłoszenie zostanie rozpatrzone w ciągu 48 godzin.";
}

    }else{
        ?>
   
        <form method="POST" action="abuse.php?plik=<?php echo $fid;?>">
            <table>
                <tr>
                    <td>
                        Imię i nazwisko:
                    </td>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>
                 <tr>
                    <td>
                        Firma/Organizacja:
                    </td>
                    <td>
                        <input type="text" name="organization">
                    </td>
                </tr>
                <tr>
                    <td>
                        Adres e-mail do kontaktu:
                    </td>
                    <td>
                        <input type="text" name="email">
                    </td>
                </tr>
                 <tr>
                    <td>
                        Adres http pliku:
                    </td>
                    <td>
                        <input type="text" name="filehttp" value="<?php if($fid) {echo 'http://'.$domain.'/download.php?plik='.$fid;}?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Powód zgłoszenia:
                    </td>
                    <td>
                        <input type="text" name="reason">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Wyślij zgłoszenie"></td>
                </tr>
            </table>
            Wszystkie pola muszą być uzupełnione, aby zgłoszenie zostało przesłane. Jeśli masz problem z obsługą tego automatycznego formularza, wyślij e-mail na adres abuse@polskirapid.pl. Zgłoszenie zostanie rozpatrzone w ciągu 48 godzin.
        </form>
<?php
    }
?>

